<?php
/**
 * Iframe Access Control Plugin
 *
 * @package wp-site-designer-mu-plugins
 */

namespace GoDaddy\WordPress\Plugins\SiteDesigner\Plugins;

use GoDaddy\WordPress\Plugins\SiteDesigner\Constants;
use function add_action;
use function add_filter;
use function header;
use function header_remove;
use function headers_sent;
use function implode;
use function is_array;
use function remove_action;

/**
 * Controls iframe embedding access through CSP frame-ancestors
 *
 * This plugin manages iframe embedding security by removing WordPress's default
 * X-Frame-Options header and replacing it with a Content-Security-Policy header
 * that explicitly allows embedding only from whitelisted origins.
 */
class IframeAccessControl {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->setupHooks();
	}

	/**
	 * Setup hooks to control frame options at multiple points
	 */
	private function setupHooks() {
		// Control frame options at multiple points in the request lifecycle.
		add_action( 'send_headers', array( $this, 'setFrameAncestorsPolicy' ), 999 );
		add_action( 'admin_init', array( $this, 'setFrameAncestorsPolicy' ), 999 );
		add_action( 'login_init', array( $this, 'setFrameAncestorsPolicy' ), 999 );
		add_action( 'shutdown', array( $this, 'setFrameAncestorsPolicy' ), 999 );

		// Filter the headers array.
		add_filter( 'wp_headers', array( $this, 'filterFrameHeaders' ), 999 );
	}

	/**
	 * Remove X-Frame-Options and set CSP frame-ancestors policy
	 */
	public function setFrameAncestorsPolicy() {
		if ( ! headers_sent() ) {
			header_remove( 'X-Frame-Options' );

			// Also remove the WordPress core hooks that send X-Frame-Options.
			remove_action( 'admin_init', 'send_frame_options_header' );
			remove_action( 'login_init', 'send_frame_options_header' );

			// Set Content-Security-Policy frame-ancestors with environment-specific origins.
			$allowed_origins = Constants::getActiveOrigins();
			$csp_value       = 'frame-ancestors ' . implode( ' ', $allowed_origins );
			header( 'Content-Security-Policy: ' . $csp_value, false );
		}
	}

	/**
	 * Filter frame-related headers and add CSP policy
	 *
	 * @param array $headers The headers array.
	 * @return array Modified headers array.
	 */
	public function filterFrameHeaders( $headers ) {
		if ( is_array( $headers ) ) {
			// Remove X-Frame-Options.
			if ( isset( $headers['X-Frame-Options'] ) ) {
				unset( $headers['X-Frame-Options'] );
			}

			// Add Content-Security-Policy with environment-specific frame-ancestors.
			$allowed_origins                    = Constants::getActiveOrigins();
			$csp_value                          = 'frame-ancestors ' . implode( ' ', $allowed_origins );
			$headers['Content-Security-Policy'] = $csp_value;
		}
		return $headers;
	}
}

