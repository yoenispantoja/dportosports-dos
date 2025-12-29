<?php
/**
 * Admin Bar Hider Plugin
 *
 * @package wp-site-designer-mu-plugins
 */

namespace GoDaddy\WordPress\Plugins\SiteDesigner\Plugins;

use GoDaddy\WordPress\Plugins\SiteDesigner\Utilities\IframeContextDetector;

use function add_action;
use function show_admin_bar;

/**
 * Hides the WordPress admin bar when Site Designer requests are detected
 */
class AdminBarHider {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'hideAdminBar' ), 1 );
		add_action( 'admin_init', array( $this, 'hideAdminBar' ), 1 );
	}

	/**
	 * Hide the admin bar for Site Designer requests
	 */
	public function hideAdminBar() {
		if ( IframeContextDetector::isValidSiteDesignerRequest() ) {
			show_admin_bar( false );
		}
	}
}
