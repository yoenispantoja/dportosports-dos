<?php
/**
 * Simplified test case for MCP_Adapter_Initializer class
 * 
 * These tests verify the basic functionality of the plugin without
 * trying to instantiate the full class (which has side effects).
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
 * Test MCP_Adapter_Initializer basic functionality
 */
class McpAdapterInitializerSimpleTest extends TestCase {
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
	}

	/**
	 * Tear down the test case
	 */
	protected function tearDown(): void {
		Monkey\tearDown();
		parent::tearDown();
	}

	/**
	 * Test plugin constants are defined
	 */
	public function test_plugin_constants_defined() {
		$this->assertTrue( defined( 'MCP_ADAPTER_INITIALIZER_VERSION' ) );
		$this->assertEquals( '0.1.10', MCP_ADAPTER_INITIALIZER_VERSION );
		
		$this->assertTrue( defined( 'MCP_ADAPTER_INITIALIZER_PLUGIN_FILE' ) );
		$this->assertTrue( defined( 'MCP_ADAPTER_INITIALIZER_PLUGIN_DIR' ) );
		$this->assertTrue( defined( 'MCP_ADAPTER_INITIALIZER_PLUGIN_URL' ) );
	}

	/**
	 * Test ABSPATH is defined for WordPress environment
	 */
	public function test_abspath_defined() {
		$this->assertTrue( defined( 'ABSPATH' ) );
	}

	/**
	 * Test WP_CONTENT_DIR is defined
	 */
	public function test_wp_content_dir_defined() {
		$this->assertTrue( defined( 'WP_CONTENT_DIR' ) );
	}

	/**
	 * Test WPMU_PLUGIN_DIR is defined
	 */
	public function test_wpmu_plugin_dir_defined() {
		$this->assertTrue( defined( 'WPMU_PLUGIN_DIR' ) );
	}

	/**
	 * Test that MCP_WooCommerce mock class exists
	 */
	public function test_mcp_woo_commerce_class_exists() {
		$this->assertTrue( class_exists( 'MCP_WooCommerce' ) );
		
		$instance = \MCP_WooCommerce::get_instance();
		$this->assertInstanceOf( 'MCP_WooCommerce', $instance );
	}

	/**
	 * Test that MCP_JWT_Authenticator mock class exists
	 */
	public function test_mcp_jwt_authenticator_class_exists() {
		$this->assertTrue( class_exists( 'MCP_JWT_Authenticator' ) );
		
		$authenticator = new \MCP_JWT_Authenticator();
		$this->assertInstanceOf( 'MCP_JWT_Authenticator', $authenticator );
	}

	/**
	 * Test JWT authenticator returns false with empty credentials
	 */
	public function test_jwt_authenticator_empty_credentials() {
		$authenticator = new \MCP_JWT_Authenticator();
		
		$result = $authenticator->authenticate_request( '', '' );
		$this->assertFalse( $result );
		
		$result = $authenticator->authenticate_request( 'token', '' );
		$this->assertFalse( $result );
		
		$result = $authenticator->authenticate_request( '', 'site_id' );
		$this->assertFalse( $result );
	}

	/**
	 * Test JWT authenticator returns true with valid credentials
	 */
	public function test_jwt_authenticator_valid_credentials() {
		$authenticator = new \MCP_JWT_Authenticator();
		
		// Set environment to dev for offline validation
		putenv( 'SERVER_ENV=dev' );

		// Define constants for validation
		if ( ! defined( 'configData' ) ) {
			define(
				'configData',
				json_encode(
					array(
						'GD_CUSTOMER_ID' => '123456',
						'GD_ACCOUNT_UID' => 'valid_site_id',
					)
				)
			);
		}

		// Create a valid JWT token
		$header  = array( 'alg' => 'RS256' );
		$payload = array(
			'cid'        => '123456',
			'shopperId'  => '123456',
			'plid'       => 'platform_123',
			'plt'        => '1',
			'shard'      => '1234',
			'typ'        => 'idp',
		);

		$jwt = $this->createValidJwt( $header, $payload );
		
		$result = $authenticator->authenticate_request( $jwt, 'valid_site_id' );
		$this->assertTrue( $result );

		// Clean up
		putenv( 'SERVER_ENV' );
	}

	/**
	 * Helper: Create a valid JWT for testing
	 *
	 * @param array $header JWT header.
	 * @param array $payload JWT payload.
	 * @return string JWT token.
	 */
	private function createValidJwt( $header, $payload ) {
		$header_encoded  = $this->base64url_encode( json_encode( $header ) );
		$payload_encoded = $this->base64url_encode( json_encode( $payload ) );
		
		// Create a valid-looking signature (40+ chars)
		$signature = $this->base64url_encode( str_repeat( 'a', 64 ) );

		return "$header_encoded.$payload_encoded.$signature";
	}

	/**
	 * Helper: Base64 URL encode
	 *
	 * @param string $data Data to encode.
	 * @return string Base64 URL encoded string.
	 */
	private function base64url_encode( $data ) {
		return rtrim( strtr( base64_encode( $data ), '+/', '-_' ), '=' );
	}

	/**
	 * Test MCP_WooCommerce singleton pattern
	 */
	public function test_mcp_woo_commerce_singleton() {
		$instance1 = \MCP_WooCommerce::get_instance();
		$instance2 = \MCP_WooCommerce::get_instance();
		
		$this->assertSame( $instance1, $instance2 );
	}

	/**
	 * Test MCP_WooCommerce methods exist
	 */
	public function test_mcp_woo_commerce_methods_exist() {
		$instance = \MCP_WooCommerce::get_instance();
		
		$this->assertTrue( method_exists( $instance, 'register_abilities' ) );
		$this->assertTrue( method_exists( $instance, 'disable_validation' ) );
		$this->assertTrue( method_exists( $instance, 'enable_validation' ) );
		$this->assertTrue( method_exists( $instance, 'get_exposed_abilities' ) );
	}

	/**
	 * Test MCP_WooCommerce get_exposed_abilities returns array
	 */
	public function test_mcp_woo_commerce_get_exposed_abilities() {
		$instance = \MCP_WooCommerce::get_instance();
		$abilities = $instance->get_exposed_abilities();
		
		$this->assertIsArray( $abilities );
	}

	/**
	 * Test WordPress add_action can be mocked
	 */
	public function test_wordpress_add_action_mock() {
		Actions\expectAdded( 'init' )
			->once()
			->with( \Mockery::type( 'callable' ) );
		
		// Simulate adding an action
		do_action( 'add_action', 'init', function() {} );
		add_action( 'init', function() {} );
	}

	/**
	 * Test WordPress add_filter can be mocked
	 */
	public function test_wordpress_add_filter_mock() {
		Filters\expectAdded( 'the_content' )
			->once()
			->with( \Mockery::type( 'callable' ) );
		
		// Simulate adding a filter
		add_filter( 'the_content', function( $content ) {
			return $content;
		} );
	}
}

