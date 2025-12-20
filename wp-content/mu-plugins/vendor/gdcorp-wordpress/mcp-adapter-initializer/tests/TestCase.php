<?php
/**
 * Base test case for MCP Adapter Initializer tests
 *
 * @package mcp-adapter-initializer
 */

namespace GD\MCP\Tests;

use Brain\Monkey;
use Brain\Monkey\Functions;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

/**
 * Base test case with common setup
 */
abstract class TestCase extends PHPUnitTestCase {
	use MockeryPHPUnitIntegration;

	/**
	 * Set up the test case
	 */
	protected function setUp(): void {
		parent::setUp();
		Monkey\setUp();

		// Mock common WordPress functions.
		$this->mockCommonWordPressFunctions();
	}

	/**
	 * Tear down the test case
	 */
	protected function tearDown(): void {
		Monkey\tearDown();
		parent::tearDown();
	}

	/**
	 * Mock common WordPress functions
	 */
	protected function mockCommonWordPressFunctions(): void {
		Functions\when( 'plugin_dir_path' )->returnArg();
		Functions\when( 'plugin_dir_url' )->returnArg();
		Functions\when( '__' )->returnArg();
		Functions\when( 'esc_html__' )->returnArg();
		Functions\when( 'esc_html' )->returnArg();
		Functions\when( 'esc_attr' )->returnArg();
		Functions\when( 'esc_url' )->returnArg();
		Functions\when( 'sanitize_text_field' )->returnArg();
		Functions\when( 'sanitize_key' )->returnArg();
		Functions\when( 'wp_unslash' )->returnArg();
		Functions\when( 'wp_slash' )->returnArg();
		Functions\when( 'absint' )->returnArg();
	}

	/**
	 * Mock WordPress error class
	 *
	 * @param string $code Error code.
	 * @param string $message Error message.
	 * @return \Mockery\MockInterface
	 */
	protected function mockWpError( $code = 'error', $message = 'Error message' ) {
		$mock = \Mockery::mock( 'WP_Error' );
		$mock->shouldReceive( 'get_error_code' )->andReturn( $code );
		$mock->shouldReceive( 'get_error_message' )->andReturn( $message );
		$mock->shouldReceive( 'has_errors' )->andReturn( true );
		
		return $mock;
	}

	/**
	 * Mock WordPress post object
	 *
	 * @param int $id Post ID.
	 * @param array $args Additional post arguments.
	 * @return \Mockery\MockInterface
	 */
	protected function mockWpPost( $id = 1, $args = array() ) {
		$defaults = array(
			'ID' => $id,
			'post_title' => 'Test Post',
			'post_content' => 'Test content',
			'post_status' => 'publish',
			'post_type' => 'post',
			'post_author' => 1,
		);

		$post_data = array_merge( $defaults, $args );
		$mock = \Mockery::mock( 'WP_Post' );

		foreach ( $post_data as $key => $value ) {
			$mock->{$key} = $value;
		}

		return $mock;
	}

	/**
	 * Mock WordPress user object
	 *
	 * @param int $id User ID.
	 * @param array $args Additional user arguments.
	 * @return \Mockery\MockInterface
	 */
	protected function mockWpUser( $id = 1, $args = array() ) {
		$defaults = array(
			'ID' => $id,
			'user_login' => 'testuser',
			'user_email' => 'test@example.com',
			'user_pass' => 'testpass',
			'display_name' => 'Test User',
		);

		$user_data = array_merge( $defaults, $args );
		$mock = \Mockery::mock( 'WP_User' );

		foreach ( $user_data as $key => $value ) {
			$mock->{$key} = $value;
		}

		$mock->shouldReceive( 'has_cap' )->andReturn( true );

		return $mock;
	}

	/**
	 * Create a mock REST request
	 *
	 * @param array $params Request parameters.
	 * @param array $headers Request headers.
	 * @return \Mockery\MockInterface
	 */
	protected function mockRestRequest( $params = array(), $headers = array() ) {
		$mock = \Mockery::mock( 'WP_REST_Request' );
		$mock->shouldReceive( 'get_params' )->andReturn( $params );
		$mock->shouldReceive( 'get_param' )->andReturnUsing(
			function ( $key ) use ( $params ) {
				return $params[ $key ] ?? null;
			}
		);
		$mock->shouldReceive( 'get_headers' )->andReturn( $headers );
		$mock->shouldReceive( 'get_header' )->andReturnUsing(
			function ( $key ) use ( $headers ) {
				return $headers[ $key ] ?? null;
			}
		);

		return $mock;
	}

	/**
	 * Create a mock REST response
	 *
	 * @param mixed $data Response data.
	 * @param int $status HTTP status code.
	 * @return \Mockery\MockInterface
	 */
	protected function mockRestResponse( $data = array(), $status = 200 ) {
		$mock = \Mockery::mock( 'WP_REST_Response' );
		$mock->shouldReceive( 'get_data' )->andReturn( $data );
		$mock->shouldReceive( 'get_status' )->andReturn( $status );

		return $mock;
	}

	/**
	 * Assert that an action was added
	 *
	 * @param string $hook Hook name.
	 * @param callable $callback Callback function.
	 * @param int $priority Hook priority.
	 * @param int $accepted_args Number of accepted arguments.
	 */
	protected function assertActionAdded( $hook, $callback = null, $priority = 10, $accepted_args = 1 ) {
		if ( $callback ) {
			Functions\expect( 'add_action' )
				->once()
				->with( $hook, $callback, $priority, $accepted_args );
		} else {
			Functions\expect( 'add_action' )
				->once()
				->with( $hook, \Mockery::type( 'callable' ), $priority, $accepted_args );
		}
	}

	/**
	 * Assert that a filter was added
	 *
	 * @param string $hook Hook name.
	 * @param callable $callback Callback function.
	 * @param int $priority Hook priority.
	 * @param int $accepted_args Number of accepted arguments.
	 */
	protected function assertFilterAdded( $hook, $callback = null, $priority = 10, $accepted_args = 1 ) {
		if ( $callback ) {
			Functions\expect( 'add_filter' )
				->once()
				->with( $hook, $callback, $priority, $accepted_args );
		} else {
			Functions\expect( 'add_filter' )
				->once()
				->with( $hook, \Mockery::type( 'callable' ), $priority, $accepted_args );
		}
	}
}

