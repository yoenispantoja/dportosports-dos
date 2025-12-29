<?php
/**
 * MCP Adapter Initializer
 *
 * @package     mcp-adapter-initializer
 * @author      GoDaddy
 * @copyright   2025 GoDaddy
 * @license     GPL-2.0-or-later
 *
 * Plugin Name:       MCP Adapter Initializer
 * Plugin URI:        https://github.com/WordPress/mcp-adapter
 * Description:       Initialize a custom MCP server with custom tools and authentication.
 * Requires at least: 6.8
 * Version:           0.2.0
 * Requires PHP:      7.4
 * Author:            GoDaddy
 * Author URI:        https://www.godaddy.com
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain:       mcp-adapter-initializer
 */

// Prevent direct access
use WP\MCP\Core\McpAdapter;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$autoloader = __DIR__ . '/vendor/autoload.php';

if ( file_exists( $autoloader ) ) {
	require $autoloader;
}

// Define plugin constants
define( 'MCP_ADAPTER_INITIALIZER_VERSION', '0.2.0' );
define( 'MCP_ADAPTER_INITIALIZER_PLUGIN_FILE', __FILE__ );
define( 'MCP_ADAPTER_INITIALIZER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MCP_ADAPTER_INITIALIZER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Main plugin class for MCP Adapter Initializer
 */
class MCP_Adapter_Initializer {

	/**
	 * Plugin instance
	 *
	 * @var MCP_Adapter_Initializer|null
	 */
	private static $instance = null;

	/**
	 * Server ID
	 *
	 * @var string
	 */
	private $server_id = 'gd-mcp';

	/**
	 * API namespace
	 *
	 * @var string
	 */
	private $api_namespace = 'gd-mcp/v1';

	/**
	 * API route
	 *
	 * @var string
	 */
	private $api_route = 'mcp';

	/**
	 * Plugin constructor
	 */
	private function __construct() {
		$this->init();
	}

	/**
	 * Get singleton instance
	 *
	 * @return MCP_Adapter_Initializer
	 */
	public static function get_instance(): MCP_Adapter_Initializer {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * MCP WooCommerce instance
	 *
	 * @var MCP_WooCommerce
	 */
	private $mcp_woo_commerce;

	/**
	 * Available tools
	 *
	 * @var array
	 */
	private $tools = array();

	/**
	 * Initialize the plugin
	 */
	private function init(): void {
		// Check if the MCP Adapter class isn't already loaded by another plugin
		if ( ! class_exists( 'WP\\MCP\\Core\\McpAdapter' ) ) {
			$this->load_mcp_adapter_dependencies();
		}

		// Trigger MCP Adapter initialization
		McpAdapter::instance();

		// Load dependencies
		$this->load_dependencies();

		// WooCommerce MCP
		$this->mcp_woo_commerce = MCP_WooCommerce::get_instance();

		// Initialize tools
		$this->init_tools();

		// Hook into WordPress
		add_action( 'abilities_api_init', array( $this, 'register_abilities' ) );
		add_action( 'mcp_adapter_init', array( $this, 'initialize_mcp_server' ) );

		add_filter( 'gdl_unrestricted_rest_endpoints', array( $this, 'add_unrestricted_endpoints' ) );
	}

	/**
	 * Load MCP Adapter dependencies if not already loaded
	 */
	private function load_mcp_adapter_dependencies(): void {
		// Try to load from standalone plugin first.
		$wp_content_adapter = WP_CONTENT_DIR . '/plugins/mcp-adapter/mcp-adapter.php';
		if ( file_exists( $wp_content_adapter ) ) {
			require_once $wp_content_adapter;

			return;
		}

		// Fallback: load from mu-plugins/gd-system-plugin/vendor/wordpress/mcp-adapter/mcp-adapter.php
		$mu_vendor_adapter = WPMU_PLUGIN_DIR . '/gd-system-plugin/vendor/wordpress/mcp-adapter/mcp-adapter.php';
		if ( file_exists( $mu_vendor_adapter ) ) {
			require_once $mu_vendor_adapter;
		}
	}

	/**
	 * Load required dependencies
	 */
	private function load_dependencies(): void {
		// Load tool classes
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-site-info-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-get-post-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-update-post-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-create-post-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-delete-post-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-list-posts-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-list-page-revisions-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-get-page-revision-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-delete-page-revision-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-list-navigations-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-create-navigation-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-get-navigation-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-update-navigation-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-delete-navigation-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-list-navigation-revisions-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-upload-image-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-update-site-options-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-activate-plugin-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-deactivate-plugin-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-list-plugins-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-get-plugin-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-get-block-types-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-get-block-patterns-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-get-themes-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-activate-theme-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-switch-theme-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-get-global-styles-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-list-global-styles-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-get-all-media-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-get-media-by-id-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-update-media-meta-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-delete-media-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-update-template-part-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-update-global-styles-tool.php';
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/tools/class-update-template-tool.php';

		// WooCommerce MCP
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/class-mcp-woo-commerce.php';

		// JWT Authenticator
		require_once MCP_ADAPTER_INITIALIZER_PLUGIN_DIR . 'includes/class-mcp-jwt-authenticator.php';
	}

	/**
	 * Initialize tools
	 */
	private function init_tools(): void {
		$this->tools['site_info']                 = \GD\MCP\Tools\Site_Info_Tool::get_instance();
		$this->tools['get_post']                  = \GD\MCP\Tools\Get_Post_Tool::get_instance();
		$this->tools['update_post']               = \GD\MCP\Tools\Update_Post_Tool::get_instance();
		$this->tools['create_post']               = \GD\MCP\Tools\Create_Post_Tool::get_instance();
		$this->tools['upload_image']              = \GD\MCP\Tools\Upload_Image_Tool::get_instance();
		$this->tools['update_site_options']       = \GD\MCP\Tools\Update_Site_Options_Tool::get_instance();
		$this->tools['activate_plugin']           = \GD\MCP\Tools\Activate_Plugin_Tool::get_instance();
		$this->tools['deactivate_plugin']         = \GD\MCP\Tools\Deactivate_Plugin_Tool::get_instance();
		$this->tools['list_plugins']              = \GD\MCP\Tools\List_Plugins_Tool::get_instance();
		$this->tools['get_plugin']                = \GD\MCP\Tools\Get_Plugin_Tool::get_instance();
		$this->tools['get_block_types']           = \GD\MCP\Tools\Get_Block_Types_Tool::get_instance();
		$this->tools['get_block_patterns']        = \GD\MCP\Tools\Get_Block_Patterns_Tool::get_instance();
		$this->tools['get_themes']                = \GD\MCP\Tools\Get_Themes_Tool::get_instance();
		$this->tools['activate_theme']            = \GD\MCP\Tools\Activate_Theme_Tool::get_instance();
		$this->tools['switch_theme']              = \GD\MCP\Tools\Switch_Theme_Tool::get_instance();
		$this->tools['get_global_styles']         = \GD\MCP\Tools\Get_Global_Styles_Tool::get_instance();
		$this->tools['list_global_styles']        = \GD\MCP\Tools\List_Global_Styles_Tool::get_instance();
		$this->tools['get_all_media']             = \GD\MCP\Tools\Get_All_Media_Tool::get_instance();
		$this->tools['get_media_by_id']           = \GD\MCP\Tools\Get_Media_By_Id_Tool::get_instance();
		$this->tools['update_media_meta']         = \GD\MCP\Tools\Update_Media_Meta_Tool::get_instance();
		$this->tools['delete_media']              = \GD\MCP\Tools\Delete_Media_Tool::get_instance();
		$this->tools['delete_post']               = \GD\MCP\Tools\Delete_Post_Tool::get_instance();
		$this->tools['list_posts']                = \GD\MCP\Tools\List_Posts_Tool::get_instance();
		$this->tools['list_page_revisions']       = \GD\MCP\Tools\List_Page_Revisions_Tool::get_instance();
		$this->tools['get_page_revision']         = \GD\MCP\Tools\Get_Page_Revision_Tool::get_instance();
		$this->tools['delete_page_revision']      = \GD\MCP\Tools\Delete_Page_Revision_Tool::get_instance();
		$this->tools['list_navigations']          = \GD\MCP\Tools\List_Navigations_Tool::get_instance();
		$this->tools['create_navigation']         = \GD\MCP\Tools\Create_Navigation_Tool::get_instance();
		$this->tools['get_navigation']            = \GD\MCP\Tools\Get_Navigation_Tool::get_instance();
		$this->tools['update_navigation']         = \GD\MCP\Tools\Update_Navigation_Tool::get_instance();
		$this->tools['delete_navigation']         = \GD\MCP\Tools\Delete_Navigation_Tool::get_instance();
		$this->tools['list_navigation_revisions'] = \GD\MCP\Tools\List_Navigation_Revisions_Tool::get_instance();
		$this->tools['update_template_part']      = \GD\MCP\Tools\Update_Template_Part_Tool::get_instance();
		$this->tools['update_global_styles']      = \GD\MCP\Tools\Update_Global_Styles_Tool::get_instance();
		$this->tools['update_template']           = \GD\MCP\Tools\Update_Template_Tool::get_instance();
	}

	/**
	 * Register plugin abilities
	 */
	public function register_abilities(): void {
		// Register all tools
		foreach ( $this->tools as $tool ) {
			if ( method_exists( $tool, 'register' ) ) {
				$tool->register();
			}
		}
		// Register woo tools
		$this->mcp_woo_commerce->register_abilities();
	}

	/**
	 * Initialize MCP server
	 *
	 * @param McpAdapter $adapter MCP adapter instance
	 */
	public function initialize_mcp_server( $adapter ): void {
		// Check if server already exists to prevent duplicate registration
		if ( $adapter->get_server( $this->server_id ) ) {
			return;
		}

		$this->mcp_woo_commerce->disable_validation();

		$adapter->create_server(
			$this->server_id,
			$this->api_namespace,
			$this->api_route,
			__( 'MCP Server', 'mcp-adapter-initializer' ),
			__( 'An MCP server for executing tools.', 'mcp-adapter-initializer' ),
			MCP_ADAPTER_INITIALIZER_VERSION,
			$this->get_transport_methods(),
			$this->get_error_handler(),
			null,
			$this->get_exposed_abilities(),
			array(), // Resources
			array(), // Prompts
			array( $this, 'authenticate_request' )
		);

		// Re-enable MCP validation immediately after server creation.
		$this->mcp_woo_commerce->enable_validation();
	}

	/**
	 * Add unrestricted endpoints for MCP
	 *
	 * @param array $endpoints Existing unrestricted endpoints
	 *
	 * @return array Modified endpoints
	 */
	public function add_unrestricted_endpoints( $endpoints ) {
		$endpoints[] = '/gd-mcp/v1';

		return $endpoints;
	}

	/**
	 * Get transport methods
	 *
	 * @return array
	 */
	private function get_transport_methods(): array {
		return array(
			\WP\MCP\Transport\Http\StreamableTransport::class,
		);
	}

	/**
	 * Get error handler class
	 *
	 * @return string
	 */
	private function get_error_handler(): string {
		return \WP\MCP\Infrastructure\ErrorHandling\ErrorLogMcpErrorHandler::class;
	}

	/**
	 * Get abilities to expose as tools
	 *
	 * @return array
	 */
	private function get_exposed_abilities(): array {
		$abilities = array();

		// Get tool IDs from all registered tools
		foreach ( $this->tools as $tool ) {
			if ( method_exists( $tool, 'get_tool_id' ) ) {
				$abilities[] = $tool->get_tool_id();
			}
		}

		// Woo abilities
		$woo_abilities = $this->mcp_woo_commerce->get_exposed_abilities();
		$abilities     = array_merge( $abilities, $woo_abilities );

		return $abilities;
	}

	/**
	 * Authenticate MCP requests with a JWT in the X-GD-JWT header
	 *
	 * @return bool Whether request is authenticated
	 */
	public function authenticate_request(): bool {
		// Get the custom JWT header from the request
		$jwt     = isset( $_SERVER['HTTP_X_GD_JWT'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_X_GD_JWT'] ) ) : null;
		$site_id = isset( $_SERVER['HTTP_X_GD_SITE_ID'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_X_GD_SITE_ID'] ) ) : null;

		$authenticator = new MCP_JWT_Authenticator();

		return $authenticator->authenticate_request( $jwt, $site_id );
	}

	/**
	 * Prevent cloning
	 */
	private function __clone() {
	}

	/**
	 * Prevent unserialization
	 */
	public function __wakeup() {
		throw new \Exception( 'Cannot unserialize singleton' );
	}
}

// Initialize the plugin
MCP_Adapter_Initializer::get_instance();
