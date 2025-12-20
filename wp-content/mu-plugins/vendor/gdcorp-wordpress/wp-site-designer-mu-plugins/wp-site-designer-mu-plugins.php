<?php
/**
 * Plugin Name: WordPress Site Designer MU-Plugins
 * Description: MU-Plugins for WordPress Site Designer integration
 * Version: 0.4.3
 * Author: GoDaddy
 * Requires PHP: 8.0
 *
 * @package wp-site-designer-mu-plugins
 */

namespace GoDaddy\WordPress\Plugins\SiteDesigner;

use GoDaddy\WordPress\Plugins\SiteDesigner\API\ActivationEndpoint;
use GoDaddy\WordPress\Plugins\SiteDesigner\Plugins\AdminBarHider;
use GoDaddy\WordPress\Plugins\SiteDesigner\Plugins\IframeAccessControl;
use GoDaddy\WordPress\Plugins\SiteDesigner\Plugins\IframeCookieHandler;
use GoDaddy\WordPress\Plugins\SiteDesigner\Plugins\MediaUpload;
use GoDaddy\WordPress\Plugins\SiteDesigner\Plugins\NavigationBridge;
use GoDaddy\WordPress\Plugins\SiteDesigner\Plugins\CookieStatusBridge;
use GoDaddy\WordPress\Plugins\SiteDesigner\Plugins\EditorWelcomeMessageDisabler;
use GoDaddy\WordPress\Plugins\SiteDesigner\Plugins\ViewportBridge;
use GoDaddy\WordPress\Plugins\SiteDesigner\Utilities\IframeContextDetector;
use GoDaddy\WordPress\Plugins\SiteDesigner\WooCommerce\Setup as WooCommerceSetup;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Avoid running during AJAX or Cron requests
if ( defined( 'DOING_AJAX' ) || defined( 'DOING_CRON' ) ) {
	return;
}

$wp_site_designer_autoloader = __DIR__ . '/vendor/autoload.php';

if ( file_exists( $wp_site_designer_autoloader ) ) {
	require_once $wp_site_designer_autoloader;
}

define( 'WP_SITE_DESIGNER_MU_PLUGINS_VERSION', '0.4.3' );

$wp_site_designer_activation_endpoint = new ActivationEndpoint();
$wp_site_designer_activation_endpoint->register();

add_action(
	'plugins_loaded',
	function () {
		IframeContextDetector::init();

		if ( IframeContextDetector::isValidSiteDesignerRequest() ) {
			new IframeAccessControl();
			new IframeCookieHandler();
			new AdminBarHider();
			new NavigationBridge();
			new CookieStatusBridge();
			new EditorWelcomeMessageDisabler();
			new ViewportBridge();
			MediaUpload::init();
			WooCommerceSetup::init();
		}
	},
	0
);

