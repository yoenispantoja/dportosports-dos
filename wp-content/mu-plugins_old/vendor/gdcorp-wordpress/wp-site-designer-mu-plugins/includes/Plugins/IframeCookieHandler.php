<?php
/**
 * Iframe Cookie Handler Plugin
 *
 * @package wp-site-designer-mu-plugins
 */

namespace GoDaddy\WordPress\Plugins\SiteDesigner\Plugins;

/**
 * Handles cookie modifications for iframe contexts to ensure proper SameSite attributes
 */
class IframeCookieHandler {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->configureSession();
		$this->setupHooks();
	}

	/**
	 * Setup WordPress hooks
	 */
	private function setupHooks() {
		// Register shutdown function to modify all Set-Cookie headers.
		if ( ! headers_sent() ) {
			register_shutdown_function( array( $this, 'modifyAllCookieHeaders' ) );
		}

		// Hook into WordPress cookie setting actions.
		add_action( 'set_auth_cookie', array( $this, 'handleAuthCookie' ), 10, 6 );
		add_action( 'set_logged_in_cookie', array( $this, 'handleLoggedInCookie' ), 10, 6 );

		// Handle user settings cookies.
		add_action( 'update_user_option_user-settings', array( $this, 'handleUserSettingsUpdate' ), 10, 3 );
		add_action( 'profile_update', array( $this, 'handleProfileUpdate' ) );

		// Handle locale changes.
		add_filter( 'locale', array( $this, 'handleLocale' ) );

		// Handle test cookie on login/admin pages.
		$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
		if ( false !== strpos( $request_uri, 'wp-login.php' ) ||
			false !== strpos( $request_uri, 'wp-admin' ) ) {
			$this->setTestCookie();
		}
	}

	/**
	 * Configure session cookie settings
	 */
	private function configureSession() {
		if ( ! headers_sent() ) {
			// Use session_set_cookie_params() instead of ini_set() for session cookies.
			// This is the proper way to configure session cookie attributes.
			session_set_cookie_params(
				array(
					'lifetime' => 0,
					'path'     => '/',
					'domain'   => '',
					'secure'   => true,
					'httponly' => true,
					'samesite' => 'None',
				)
			);
		}
	}

	/**
	 * Modify all Set-Cookie headers at shutdown to add SameSite=None; Secure; Partitioned
	 */
	public function modifyAllCookieHeaders() {
		$headers  = headers_list();
		$modified = false;

		// Check if any WordPress cookies need modification.
		foreach ( $headers as $header ) {
			if ( 0 === stripos( $header, 'Set-Cookie:' ) ) {
				$cookie_value = substr( $header, 12 );

				if ( $this->isWordPressCookie( $cookie_value ) &&
					false === strpos( $cookie_value, 'SameSite=' ) ) {
					$modified = true;
					break;
				}
			}
		}

		// Rebuild all Set-Cookie headers if modification needed.
		if ( $modified ) {
			header_remove( 'Set-Cookie' );

			foreach ( $headers as $header ) {
				if ( 0 === stripos( $header, 'Set-Cookie:' ) ) {
					$cookie_value = substr( $header, 12 );

					if ( $this->isWordPressCookie( $cookie_value ) &&
						false === strpos( $cookie_value, 'SameSite=' ) ) {
						$cookie_value .= '; SameSite=None; Secure; Partitioned';
					}

					header( 'Set-Cookie: ' . $cookie_value, false );
				}
			}
		}
	}

	/**
	 * Check if cookie is a WordPress cookie
	 *
	 * @param string $cookie_value Cookie value.
	 * @return bool
	 */
	private function isWordPressCookie( $cookie_value ) {
		return (bool) preg_match( '/^(wordpress_[^=]+|wp-settings-[^=]+|wp_lang|comment_[^=]+)=/', $cookie_value );
	}

	/**
	 * Set a cookie with SameSite=None and Partitioned attributes
	 *
	 * @param string $name Cookie name.
	 * @param string $value Cookie value.
	 * @param int    $expire Expiration timestamp.
	 * @param string $path Cookie path.
	 * @param string $domain Cookie domain.
	 * @param bool   $secure Whether cookie is secure.
	 * @param bool   $httponly Whether cookie is HTTP only.
	 * @return bool
	 */
	private function setCookie( $name, $value, $expire = 0, $path = '/', $domain = '', $secure = true, $httponly = false ) {
		if ( headers_sent() ) {
			return false;
		}

		$cookie_string = $name . '=' . rawurlencode( $value );

		if ( $expire > 0 ) {
			$cookie_string .= '; expires=' . gmdate( 'D, d-M-Y H:i:s T', $expire );
		}

		$cookie_string .= '; path=' . $path;

		if ( ! empty( $domain ) ) {
			$cookie_string .= '; domain=' . $domain;
		}

		if ( $secure ) {
			$cookie_string .= '; Secure';
		}

		if ( $httponly ) {
			$cookie_string .= '; HttpOnly';
		}

		$cookie_string .= '; SameSite=None; Partitioned';

		header( 'Set-Cookie: ' . $cookie_string, false );
		return true;
	}

	/**
	 * Handle auth cookie setting
	 *
	 * @param string $auth_cookie Auth cookie value.
	 * @param int    $expire Expiration timestamp.
	 * @param int    $expiration Expiration timestamp.
	 * @param int    $user_id User ID.
	 * @param string $scheme Cookie scheme.
	 * @param string $token Token.
	 */
	public function handleAuthCookie( $auth_cookie, $expire, $expiration, $user_id, $scheme, $token ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter -- WordPress hook callback requires specific signature.
		if ( ! $this->areConstantsDefined() ) {
			return;
		}

		$cookie_name = 'secure_auth' === $scheme
			? 'wordpress_sec_' . COOKIEHASH
			: 'wordpress_' . COOKIEHASH;

		$paths = array(
			ADMIN_COOKIE_PATH,
			PLUGINS_COOKIE_PATH,
			COOKIEPATH,
			SITECOOKIEPATH,
		);

		foreach ( $paths as $path ) {
			$this->setCookie( $cookie_name, $auth_cookie, $expire, $path, COOKIE_DOMAIN, true, false );
		}
	}

	/**
	 * Handle logged-in cookie setting
	 *
	 * @param string $logged_in_cookie Logged in cookie value.
	 * @param int    $expire Expiration timestamp.
	 * @param int    $expiration Expiration timestamp.
	 * @param int    $user_id User ID.
	 * @param string $scheme Cookie scheme.
	 * @param string $token Token.
	 */
	public function handleLoggedInCookie( $logged_in_cookie, $expire, $expiration, $user_id, $scheme, $token ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter -- WordPress hook callback requires specific signature.
		if ( ! $this->areConstantsDefined() ) {
			return;
		}

		$cookie_name = 'wordpress_logged_in_' . COOKIEHASH;
		$paths       = array( COOKIEPATH, SITECOOKIEPATH );

		foreach ( $paths as $path ) {
			$this->setCookie( $cookie_name, $logged_in_cookie, $expire, $path, COOKIE_DOMAIN, true, false );
		}
	}

	/**
	 * Handle test cookie
	 */
	private function setTestCookie() {
		if ( ! $this->areConstantsDefined() ) {
			return;
		}

		$this->setCookie( 'wordpress_test_cookie', 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN, true, false );
	}

	/**
	 * Handle user settings update
	 *
	 * @param mixed $old_value Old value.
	 * @param mixed $value New value.
	 * @param int   $user_id User ID.
	 */
	public function handleUserSettingsUpdate( $old_value, $value, $user_id ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter -- WordPress hook callback requires specific signature.
		$this->setUserSettingsCookies( $user_id, $value );
	}

	/**
	 * Handle profile update
	 *
	 * @param int $user_id User ID.
	 */
	public function handleProfileUpdate( $user_id ) {
		$settings = get_user_option( 'user-settings', $user_id );
		$this->setUserSettingsCookies( $user_id, $settings ?? '' );
	}

	/**
	 * Set wp-settings cookies
	 *
	 * @param int    $user_id User ID.
	 * @param string $settings Settings value.
	 */
	private function setUserSettingsCookies( $user_id, $settings ) {
		if ( ! defined( 'SITECOOKIEPATH' ) || ! defined( 'COOKIE_DOMAIN' ) ) {
			return;
		}

		$expiry = time() + YEAR_IN_SECONDS;

		$this->setCookie( 'wp-settings-' . $user_id, $settings, $expiry, SITECOOKIEPATH, COOKIE_DOMAIN, true, false );
		$this->setCookie( 'wp-settings-time-' . $user_id, time(), $expiry, SITECOOKIEPATH, COOKIE_DOMAIN, true, false );
	}

	/**
	 * Handle locale changes
	 *
	 * @param string $locale Locale string.
	 * @return string
	 */
	public function handleLocale( $locale ) {
		static $locale_set = false;

		if ( ! $locale_set && defined( 'COOKIEPATH' ) && defined( 'COOKIE_DOMAIN' ) ) {
			$this->setCookie( 'wp_lang', $locale, 0, COOKIEPATH, COOKIE_DOMAIN, true, false );
			$locale_set = true;
		}

		return $locale;
	}

	/**
	 * Check if required WordPress constants are defined
	 */
	private function areConstantsDefined() {
		// phpcs:disable WordPress.WhiteSpace.PrecisionAlignment -- Aligned for readability.
		return defined( 'COOKIEHASH' ) &&
			   defined( 'ADMIN_COOKIE_PATH' ) &&
			   defined( 'PLUGINS_COOKIE_PATH' ) &&
			   defined( 'COOKIEPATH' ) &&
			   defined( 'SITECOOKIEPATH' ) &&
			   defined( 'COOKIE_DOMAIN' );
		// phpcs:enable
	}
}

