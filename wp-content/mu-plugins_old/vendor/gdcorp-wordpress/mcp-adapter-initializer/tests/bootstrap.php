<?php
/**
 * PHPUnit bootstrap file for MCP Adapter Initializer tests
 *
 * @package mcp-adapter-initializer
 */

// Load Composer autoloader.
require_once dirname( __DIR__ ) . '/vendor/autoload.php';

// Define WordPress constants that are needed for the plugin.
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __DIR__ ) . '/wordpress/' );
}

if ( ! defined( 'WP_CONTENT_DIR' ) ) {
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
}

if ( ! defined( 'WPMU_PLUGIN_DIR' ) ) {
	define( 'WPMU_PLUGIN_DIR', WP_CONTENT_DIR . '/mu-plugins' );
}

// Define plugin constants for testing.
if ( ! defined( 'MCP_ADAPTER_INITIALIZER_VERSION' ) ) {
	define( 'MCP_ADAPTER_INITIALIZER_VERSION', '0.1.10' );
}

if ( ! defined( 'MCP_ADAPTER_INITIALIZER_PLUGIN_FILE' ) ) {
	define( 'MCP_ADAPTER_INITIALIZER_PLUGIN_FILE', dirname( __DIR__ ) . '/mcp-adapter-initializer.php' );
}

if ( ! defined( 'MCP_ADAPTER_INITIALIZER_PLUGIN_DIR' ) ) {
	define( 'MCP_ADAPTER_INITIALIZER_PLUGIN_DIR', dirname( __DIR__ ) . '/' );
}

if ( ! defined( 'MCP_ADAPTER_INITIALIZER_PLUGIN_URL' ) ) {
	define( 'MCP_ADAPTER_INITIALIZER_PLUGIN_URL', 'http://example.org/wp-content/plugins/mcp-adapter-initializer/' );
}

// Bootstrap Brain Monkey.
// This must be called before loading WordPress functions.
\Brain\Monkey\setUp();

// TestCase class is now autoloaded via PSR-4 (see composer.json autoload-dev)

// Load required classes for testing
// These are needed before the main plugin file is loaded

// Mock the MCP_WooCommerce class
if ( ! class_exists( 'MCP_WooCommerce' ) ) {
	class MCP_WooCommerce {
		private static $instance = null;
		
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		
		public function register_abilities() {}
		public function disable_validation() {}
		public function enable_validation() {}
		public function get_exposed_abilities() {
			return array();
		}
	}
}

// Load the real MCP_JWT_Authenticator class if it exists
// The mock is only needed if the real class isn't available
$jwt_authenticator_path = dirname( __DIR__ ) . '/includes/class-mcp-jwt-authenticator.php';
if ( file_exists( $jwt_authenticator_path ) ) {
	require_once $jwt_authenticator_path;
} elseif ( ! class_exists( 'MCP_JWT_Authenticator' ) ) {
	// Fallback mock if the real class isn't available
	class MCP_JWT_Authenticator {
		public function authenticate_request( $jwt, $site_id ) {
			return ! empty( $jwt ) && ! empty( $site_id );
		}
	}
}

