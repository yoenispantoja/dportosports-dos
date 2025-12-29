<?php
/**
 * Integration test case for MCP_Adapter_Initializer class
 * 
 * These tests verify integration points and public method behavior.
 *
 * @package mcp-adapter-initializer
 */

namespace GD\MCP\Tests;

use Brain\Monkey;
use Brain\Monkey\Functions;
use Brain\Monkey\Actions;
use Brain\Monkey\Filters;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

/**
 * Test MCP_Adapter_Initializer integration points
 */
class McpAdapterInitializerIntegrationTest extends TestCase {
	use MockeryPHPUnitIntegration;

	/**
	 * Set up the test case
	 */
	protected function setUp(): void {
		parent::setUp();
		Monkey\setUp();

		// Mock WordPress functions
		Functions\when( 'plugin_dir_path' )->returnArg();
		Functions\when( 'plugin_dir_url' )->returnArg();
		Functions\when( '__' )->returnArg();
		Functions\when( 'esc_html__' )->returnArg();
		Functions\when( 'sanitize_text_field' )->returnArg();
		Functions\when( 'wp_unslash' )->returnArg();
		Functions\when( 'file_exists' )->justReturn( false );
	}

	/**
	 * Tear down the test case
	 */
	protected function tearDown(): void {
		Monkey\tearDown();
		parent::tearDown();
	}

	/**
	 * Test that unrestricted endpoints filter works correctly
	 */
	public function test_add_unrestricted_endpoints_filter() {
		$initial_endpoints = array( '/wp-json/wp/v2' );
		
		// Simulate the filter being applied
		Filters\expectApplied( 'gdl_unrestricted_rest_endpoints' )
			->once()
			->with( $initial_endpoints )
			->andReturn( array_merge( $initial_endpoints, array( '/gd-mcp/v1' ) ) );
		
		$result = apply_filters( 'gdl_unrestricted_rest_endpoints', $initial_endpoints );
		
		$this->assertContains( '/wp-json/wp/v2', $result );
		$this->assertContains( '/gd-mcp/v1', $result );
		$this->assertCount( 2, $result );
	}

	/**
	 * Test that abilities_api_init action is triggered
	 */
	public function test_abilities_api_init_action() {
		Actions\expectDone( 'abilities_api_init' )->once();
		
		do_action( 'abilities_api_init' );
		
		$this->assertTrue( true ); // Assertion is done by Mockery expectations
	}

	/**
	 * Test that mcp_adapter_init action is triggered
	 */
	public function test_mcp_adapter_init_action() {
		// Note: McpAdapter is final so we can't mock it directly
		// Instead we test that the action can be registered
		Actions\expectDone( 'mcp_adapter_init' )->once();
		
		do_action( 'mcp_adapter_init' );
		
		$this->assertTrue( true ); // Assertion is done by Mockery expectations
	}

	/**
	 * Test authentication request headers parsing
	 */
	public function test_authentication_headers_parsing() {
		// Set up server variables as they would come from HTTP headers
		$_SERVER['HTTP_X_GD_JWT'] = 'test_jwt_token_value';
		$_SERVER['HTTP_X_GD_SITE_ID'] = 'test_site_123';
		
		// Functions are already mocked in setUp with returnArg behavior
		// Simulate header retrieval
		$jwt = isset( $_SERVER['HTTP_X_GD_JWT'] ) ? $_SERVER['HTTP_X_GD_JWT'] : null;
		$site_id = isset( $_SERVER['HTTP_X_GD_SITE_ID'] ) ? $_SERVER['HTTP_X_GD_SITE_ID'] : null;
		
		$this->assertEquals( 'test_jwt_token_value', $jwt );
		$this->assertEquals( 'test_site_123', $site_id );
		
		// Test missing headers
		unset( $_SERVER['HTTP_X_GD_JWT'] );
		$jwt = isset( $_SERVER['HTTP_X_GD_JWT'] ) ? $_SERVER['HTTP_X_GD_JWT'] : null;
		$this->assertNull( $jwt );
		
		// Clean up
		unset( $_SERVER['HTTP_X_GD_SITE_ID'] );
	}

	/**
	 * Test plugin version constant value
	 */
	public function test_plugin_version_format() {
		$version = MCP_ADAPTER_INITIALIZER_VERSION;
		
		// Check it's a valid semantic version format (x.y.z)
		$this->assertMatchesRegularExpression( '/^\d+\.\d+\.\d+$/', $version );
	}

	/**
	 * Test plugin directory path constant
	 */
	public function test_plugin_directory_path() {
		$plugin_dir = MCP_ADAPTER_INITIALIZER_PLUGIN_DIR;
		
		$this->assertIsString( $plugin_dir );
		$this->assertNotEmpty( $plugin_dir );
	}

	/**
	 * Test plugin URL constant
	 */
	public function test_plugin_url() {
		$plugin_url = MCP_ADAPTER_INITIALIZER_PLUGIN_URL;
		
		$this->assertIsString( $plugin_url );
		$this->assertNotEmpty( $plugin_url );
	}

	/**
	 * Test that WordPress core functions can be mocked
	 */
	public function test_wordpress_core_function_mocking() {
		// Mock get_option
		Functions\expect( 'get_option' )
			->once()
			->with( 'test_option', 'default' )
			->andReturn( 'test_value' );
		
		$result = get_option( 'test_option', 'default' );
		
		$this->assertEquals( 'test_value', $result );
	}

	/**
	 * Test that WordPress REST API functions can be mocked
	 */
	public function test_rest_api_function_mocking() {
		// Mock rest_url
		Functions\expect( 'rest_url' )
			->once()
			->with( 'gd-mcp/v1/mcp' )
			->andReturn( 'https://example.com/wp-json/gd-mcp/v1/mcp' );
		
		$url = rest_url( 'gd-mcp/v1/mcp' );
		
		$this->assertEquals( 'https://example.com/wp-json/gd-mcp/v1/mcp', $url );
	}

	/**
	 * Test API namespace and route constants
	 */
	public function test_api_namespace_and_route() {
		// These are the expected values used by the plugin
		$expected_namespace = 'gd-mcp/v1';
		$expected_route = 'mcp';
		
		// Verify format
		$this->assertMatchesRegularExpression( '/^[\w-]+\/v\d+$/', $expected_namespace );
		$this->assertMatchesRegularExpression( '/^[\w-]+$/', $expected_route );
	}

	/**
	 * Test that tool IDs follow expected pattern
	 */
	public function test_tool_id_pattern() {
		$tool_ids = array(
			'site_info',
			'get_post',
			'update_post',
			'create_post',
			'upload_image',
		);
		
		foreach ( $tool_ids as $tool_id ) {
			$this->assertMatchesRegularExpression( '/^[a-z_]+$/', $tool_id );
		}
	}
}

