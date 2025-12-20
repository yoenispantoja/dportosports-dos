<?php
/**
 * Iframe Context Detector Utility
 *
 * @package wp-site-designer-mu-plugins
 */

namespace GoDaddy\WordPress\Plugins\SiteDesigner\Utilities;

use GoDaddy\WordPress\Plugins\SiteDesigner\Constants;

/**
 * Detects if the current request is from Site Designer iframe
 */
class IframeContextDetector {

	/**
	 * Singleton instance
	 *
	 * @var self|null
	 */
	private static $instance = null;

	/**
	 * Cached validation result
	 *
	 * @var bool|null
	 */
	private $is_valid = null;

	/**
	 * Initialize singleton instance
	 *
	 * @return self
	 */
	public static function init() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Check if current request is a valid Site Designer request
	 *
	 * @return bool
	 */
	public static function isValidSiteDesignerRequest() {
		$instance = self::init();

		if ( null !== $instance->is_valid ) {
			return $instance->is_valid;
		}

		$instance->is_valid = $instance->validateRequest();

		return $instance->is_valid;
	}

	/**
	 * Validate if request is from Site Designer iframe
	 *
	 * @return bool
	 */
	private function validateRequest() {
		if ( ! $this->isPluginActivated() ) {
			return false;
		}

		$dev_header = isset( $_SERVER['HTTP_X_GD_SITE_DESIGNER'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_X_GD_SITE_DESIGNER'] ) ) : '';
		if ( '1' === $dev_header &&  $this->isNonProdEnv()) {
			return true;
		}

		/**
		 * Seems like this is leftover from different logic.
		 * If we want to allow cookie editing when we hit domain.com/?GD_COMMAND=SSO_LOGIN&SSO_HASH=4hash&wp_site_designer=1
		 * this check will always return false, and cookies would never be affected.
		 *
		 * $request_uri = $_SERVER['REQUEST_URI'] ?? '';
		 * if (strpos($request_uri, '/wp-json/') !== false ||
		 *     strpos($request_uri, 'rest_route=') !== false ||
		 *     strpos($request_uri, '/wp/v2/wpmcp') !== false) {
		 *     return false;
		 * }
		 */

		// Allow same-origin requests (WP making requests to itself).
		$origin = isset( $_SERVER['HTTP_ORIGIN'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_ORIGIN'] ) ) : ( isset( $_SERVER['HTTP_REFERER'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_REFERER'] ) ) : '' );
		if ( $this->isSameOrigin( $origin ) ) {
			return true;
		}

		$sec_fetch_dest = isset( $_SERVER['HTTP_SEC_FETCH_DEST'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_SEC_FETCH_DEST'] ) ) : '';
		if ( 'iframe' !== $sec_fetch_dest ) {
			return false;
		}

		if ( ! $this->isAllowedOrigin() ) {
			return false;
		}

		return true;
	}

	/**
	 * Check if plugin is activated
	 *
	 * @return bool
	 */
	private function isPluginActivated() {
		return (bool) get_option( 'wp_site_designer_activated', false );
	}

	/**
	 * Check if origin is allowed
	 *
	 * @return bool
	 */
	private function isAllowedOrigin() {
		$origin = isset( $_SERVER['HTTP_ORIGIN'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_ORIGIN'] ) ) : ( isset( $_SERVER['HTTP_REFERER'] ) ? sanitize_text_field( wp_unslash( $_SERVER['HTTP_REFERER'] ) ) : '' );

		$origin_parts = RequestValidator::parseOrigin( $origin );
		if ( null === $origin_parts ) {
			return false;
		}

		$allowed_origins = apply_filters( 'wp_site_designer_allowed_origins', Constants::getActiveOrigins() );

		foreach ( $allowed_origins as $allowed ) {
			$allowed_parts = RequestValidator::parseOrigin( $allowed );
			if ( null === $allowed_parts ) {
				continue;
			}

			if ( RequestValidator::originsMatch( $origin_parts, $allowed_parts ) ) {
				return true;
			}

			if ( $origin_parts['scheme'] === $allowed_parts['scheme'] &&
			     $origin_parts['port'] === $allowed_parts['port'] &&
			     $this->matchesWildcard( $allowed_parts['host'], $origin_parts['host'] ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Match wildcard pattern against subject
	 *
	 * @param string $pattern Pattern with wildcards.
	 * @param string $subject Subject to match.
	 *
	 * @return bool
	 */
	private function matchesWildcard( $pattern, $subject ) {
		$pattern = str_replace( array( '*', '.' ), array( '.*', '\.' ), $pattern );

		return 1 === preg_match( '/^' . $pattern . '$/i', $subject );
	}

	/**
	 * Check if origin matches site origin
	 *
	 * @param string $origin Origin to check.
	 *
	 * @return bool
	 */
	private function isSameOrigin( $origin ) {
		$origin_parts = RequestValidator::parseOrigin( $origin );
		if ( null === $origin_parts ) {
			return false;
		}

		$site_url   = get_site_url();
		$site_parts = RequestValidator::parseOrigin( $site_url );
		if ( null === $site_parts ) {
			return false;
		}

		return RequestValidator::originsMatch( $origin_parts, $site_parts );
	}

	/**
	 * Check if current environment is non-production
	 *
	 * @return bool
	 */
	public function isNonProdEnv(): bool {
		return Constants::getEnvironment() !== 'prod';
	}
}
