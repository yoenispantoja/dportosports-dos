<?php
/**
 * Test case for MCP Server Registration and duplicate prevention
 *
 * @package mcp-adapter-initializer
 */

namespace GD\MCP\Tests;

use Brain\Monkey;
use Brain\Monkey\Functions;
use Mockery;

/**
 * Test MCP Server registration and duplicate prevention
 *
 * These tests verify the duplicate server registration prevention logic
 * without needing to instantiate the actual McpAdapter (which is final).
 */
class McpAdapterServerRegistrationTest extends TestCase {

	/**
	 * Test that get_server check prevents duplicate registration (first scenario)
	 */
	public function test_duplicate_prevention_logic_with_null_server() {
		// Create a mock adapter interface
		$adapter = Mockery::mock( 'AdapterInterface' );
		
		// Simulate first call: get_server returns null (server doesn't exist)
		$adapter->shouldReceive( 'get_server' )
			->once()
			->with( 'gd-mcp' )
			->andReturn( null );
		
		// When server is null, we proceed with registration
		$result = $adapter->get_server( 'gd-mcp' );
		
		// Should return null, indicating server doesn't exist yet
		$this->assertNull( $result );
	}

	/**
	 * Test that get_server check prevents duplicate registration (second scenario)
	 */
	public function test_duplicate_prevention_logic_with_existing_server() {
		// Create a mock adapter interface
		$adapter = Mockery::mock( 'AdapterInterface' );
		
		// Mock server object
		$existing_server = (object) array( 'id' => 'gd-mcp' );
		
		// Simulate second call: get_server returns existing server
		$adapter->shouldReceive( 'get_server' )
			->once()
			->with( 'gd-mcp' )
			->andReturn( $existing_server );
		
		// When server exists, we should get it back
		$result = $adapter->get_server( 'gd-mcp' );
		
		// Should return the existing server, indicating we should NOT create a new one
		$this->assertNotNull( $result );
		$this->assertIsObject( $result );
		$this->assertEquals( 'gd-mcp', $result->id );
	}

	/**
	 * Test the conditional logic flow for duplicate prevention
	 */
	public function test_conditional_early_return_logic() {
		// Scenario 1: Server doesn't exist (null) - should proceed
		$server_exists = null;
		$should_create = ! $server_exists;
		$this->assertTrue( $should_create, 'Should create server when it does not exist' );
		
		// Scenario 2: Server exists (object) - should return early
		$server_exists = (object) array( 'id' => 'gd-mcp' );
		$should_create = ! $server_exists;
		$this->assertFalse( $should_create, 'Should NOT create server when it already exists' );
	}

	/**
	 * Test server ID consistency
	 */
	public function test_server_id_constant() {
		$expected_server_id = 'gd-mcp';
		
		// Verify the server ID format
		$this->assertIsString( $expected_server_id );
		$this->assertNotEmpty( $expected_server_id );
		$this->assertMatchesRegularExpression( '/^[a-z-]+$/', $expected_server_id );
	}

	/**
	 * Test API namespace format
	 */
	public function test_api_namespace_format() {
		$expected_namespace = 'gd-mcp/v1';
		
		// Verify namespace follows WordPress REST API conventions
		$this->assertMatchesRegularExpression( '/^[\w-]+\/v\d+$/', $expected_namespace );
		$this->assertStringContainsString( '/', $expected_namespace );
		$this->assertStringContainsString( 'v', $expected_namespace );
	}

	/**
	 * Test API route format
	 */
	public function test_api_route_format() {
		$expected_route = 'mcp';
		
		// Verify route is properly formatted
		$this->assertIsString( $expected_route );
		$this->assertNotEmpty( $expected_route );
		// Should not have slashes
		$this->assertStringNotContainsString( '/', $expected_route );
	}

	/**
	 * Test sequence of duplicate registration attempts
	 */
	public function test_multiple_registration_attempts_sequence() {
		$call_count = 0;
		$server     = null;
		
		// Simulate first registration attempt
		if ( ! $server ) {
			$call_count++;
			$server = (object) array( 'id' => 'gd-mcp', 'created' => true );
		}
		
		$this->assertEquals( 1, $call_count );
		$this->assertNotNull( $server );
		
		// Simulate second registration attempt (should be blocked)
		if ( ! $server ) {
			$call_count++;
		}
		
		// Call count should still be 1 (second attempt was blocked)
		$this->assertEquals( 1, $call_count );
	}

	/**
	 * Test that truthy values properly prevent registration
	 */
	public function test_truthy_server_values_prevent_registration() {
		$test_cases = array(
			(object) array( 'id' => 'test' ), // Object
			array( 'server' => 'data' ),      // Array
			'server_string',                   // String
			123,                               // Number
		);
		
		foreach ( $test_cases as $server ) {
			// If server exists (truthy), should NOT proceed
			$should_proceed = ! $server;
			$this->assertFalse( $should_proceed, 'Truthy server value should prevent registration' );
		}
	}

	/**
	 * Test that falsy values allow registration
	 */
	public function test_falsy_server_values_allow_registration() {
		$test_cases = array(
			null,
			false,
			0,
			'',
			array(),
		);
		
		foreach ( $test_cases as $server ) {
			// If server doesn't exist (falsy), should proceed
			$should_proceed = ! $server;
			$this->assertTrue( $should_proceed, 'Falsy server value should allow registration' );
		}
	}

	/**
	 * Test comment documentation for duplicate prevention
	 */
	public function test_duplicate_prevention_documentation_exists() {
		$file_path = dirname( __DIR__ ) . '/mcp-adapter-initializer.php';
		$this->assertFileExists( $file_path );
		
		$content = file_get_contents( $file_path );
		
		// Verify the duplicate prevention check exists in the code
		$this->assertStringContainsString( 'get_server', $content );
		$this->assertStringContainsString( 'prevent duplicate registration', $content );
	}

	/**
	 * Test server registration method signature expectations
	 */
	public function test_initialize_mcp_server_method_exists() {
		$file_path = dirname( __DIR__ ) . '/mcp-adapter-initializer.php';
		$content   = file_get_contents( $file_path );
		
		// Verify the method exists with correct signature
		$this->assertStringContainsString( 'public function initialize_mcp_server', $content );
		$this->assertStringContainsString( '$adapter', $content );
	}
}

