<?php
/**
 * Media Upload Plugin
 *
 * @package wp-site-designer-mu-plugins
 */

namespace GoDaddy\WordPress\Plugins\SiteDesigner\Plugins;

use GoDaddy\WordPress\Plugins\SiteDesigner\Constants;

/**
 * Manages WordPress media library integration for Site Designer iframe contexts
 *
 * This plugin provides a secure interface for uploading and selecting media
 * within iframe contexts, handling proper script enqueuing, configuration,
 * and cross-origin communication for the Site Designer application.
 */
class MediaUpload {

	/**
	 * Plugin URL base
	 */
	private static $plugin_url;

	/**
	 * Plugin directory path
	 */
	private static $plugin_dir;

	/**
	 * Initialize the plugin
	 */
	public static function init() {
		self::setupPaths();
		self::setupHooks();
	}

	/**
	 * Setup plugin paths
	 */
	private static function setupPaths() {
		self::$plugin_dir = dirname( dirname( __DIR__ ) ); // Go up to plugin root.
		self::$plugin_url = plugins_url( '', self::$plugin_dir . '/wp-site-designer-mu-plugins.php' );
	}

	/**
	 * Setup WordPress hooks
	 */
	private static function setupHooks() {
		// Enqueue hooks.
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_media_admin' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_media_frontend' ) );

		// Config hooks.
		add_action( 'wp_footer', array( __CLASS__, 'add_media_config' ), 999 );
		add_action( 'admin_footer', array( __CLASS__, 'add_media_config' ), 999 );
	}

	/**
	 * Enqueue media library in admin context
	 */
	public static function enqueue_media_admin() {
		if ( ! is_user_logged_in() || ! current_user_can( 'upload_files' ) ) {
			return;
		}

		wp_enqueue_media();
		self::enqueue_media_script();
	}

	/**
	 * Enqueue media library on frontend (for iframe contexts)
	 */
	public static function enqueue_media_frontend() {
		// Only load for logged-in users with upload capability.
		if ( ! is_user_logged_in() || ! current_user_can( 'upload_files' ) ) {
			return;
		}

		wp_enqueue_media();
		self::enqueue_media_script();
	}

	/**
	 * Enqueue the media upload JavaScript
	 */
	private static function enqueue_media_script() {
		// Prevent double-loading.
		if ( wp_script_is( 'site-designer-media-upload', 'enqueued' ) ) {
			return;
		}

		$script_url  = self::$plugin_url . '/assets/js/media-upload.js';
		$script_path = self::$plugin_dir . '/assets/js/media-upload.js';

		// Verify file exists.
		if ( ! file_exists( $script_path ) ) {
			if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
				error_log( 'Site Designer Media Upload: JavaScript file not found' ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
				error_log( '  Expected path: ' . $script_path ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
				error_log( '  Expected URL: ' . $script_url ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
				error_log( '  Plugin dir: ' . self::$plugin_dir ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
				error_log( '  Plugin URL: ' . self::$plugin_url ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
			}
			return;
		}

		wp_enqueue_script(
			'site-designer-media-upload',
			$script_url,
			array( 'media-editor', 'media-views', 'media-models' ),
			filemtime( $script_path ), // Cache busting.
			true
		);
	}

	/**
	 * Add configuration object for frontend JavaScript
	 */
	public static function add_media_config() {
		// Only output config for logged-in users with upload capability.
		if ( ! is_user_logged_in() || ! current_user_can( 'upload_files' ) ) {
			return;
		}

		$allowed_origins = Constants::getActiveOrigins();;
		?>
		<script>
		window.siteDesignerMedia = window.siteDesignerMedia || {};
		Object.assign(window.siteDesignerMedia, {
			ready: !!(window.wp && window.wp.media),
			config: {
				allowedOrigins: <?php echo wp_json_encode( $allowed_origins ); ?>
			}
		});
		</script>
		<?php
	}
}
