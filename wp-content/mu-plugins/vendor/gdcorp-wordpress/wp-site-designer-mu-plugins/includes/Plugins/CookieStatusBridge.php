<?php
/**
 * Cookie Status Bridge Plugin
 *
 * @package wp-site-designer-mu-plugins
 */

namespace GoDaddy\WordPress\Plugins\SiteDesigner\Plugins;

use GoDaddy\WordPress\Plugins\SiteDesigner\Constants;
use GoDaddy\WordPress\Plugins\SiteDesigner\Utilities\IframeContextDetector;

use function add_action;

/**
 * Bridges cookie status events between WordPress and Site Designer iframe
 * Notifies parent window when WordPress cookies are loaded
 */
class CookieStatusBridge {

	/**
	 * Constructor
	 */
	public function __construct() {
		if ( IframeContextDetector::isValidSiteDesignerRequest() ) {
			add_action( 'admin_footer', array( $this, 'outputScript' ), 999 );
			add_action( 'wp_footer', array( $this, 'outputScript' ), 999 );
			add_action( 'login_footer', array( $this, 'outputScript' ), 999 );
		}
	}

	/**
	 * Output JavaScript to monitor and report cookie status
	 */
	public function outputScript() {
		$allowed_origins = Constants::getActiveOrigins();
		
		if ( empty( $allowed_origins ) ) {
			return;
		}

		$is_user_logged_in = is_user_logged_in();
		$has_cookies       = ! empty( $_COOKIE );

		?>
		<script type="text/javascript">
		(function() {
			const ALLOWED_ORIGINS = <?php echo wp_json_encode( $allowed_origins ); ?>;
			const PHP_IS_LOGGED_IN = <?php echo wp_json_encode( $is_user_logged_in ); ?>;
			const PHP_HAS_COOKIES = <?php echo wp_json_encode( $has_cookies ); ?>;
			let lastCookieState = '';

			/**
			 * Get all WordPress-related cookies (that JavaScript can access)
			 */
			function getWordPressCookies() {
				const cookies = {};
				const cookieString = document.cookie;
				
				if (!cookieString) {
					return cookies;
				}

				const cookieArray = cookieString.split(';');
				
				cookieArray.forEach(cookie => {
					const [name, ...valueParts] = cookie.trim().split('=');
					const value = valueParts.join('=');
					
					// Collect WordPress-related cookies
					if (name.startsWith('wordpress_') || 
						name.startsWith('wp-') || 
						name.startsWith('wp_') ||
						name === 'PHPSESSID') {
						cookies[name] = value;
					}
				});

				return cookies;
			}

			/**
			 * Send cookie status to parent window
			 */
			function sendCookieStatus() {
				const wpCookies = getWordPressCookies();
				const jsHasCookies = Object.keys(wpCookies).length > 0;
				
				// Use PHP-detected login status (more reliable) or fall back to JS detection
				const isLoggedIn = PHP_IS_LOGGED_IN;
				const cookiesLoaded = PHP_HAS_COOKIES || jsHasCookies;
				
				const cookieInfo = {
					type: 'wordpress-cookies',
					loaded: cookiesLoaded,
					isLoggedIn: isLoggedIn,
					timestamp: Date.now()
				};

				// Only send if cookie state has changed
				const currentState = JSON.stringify(cookieInfo);
				if (currentState !== lastCookieState) {
					lastCookieState = currentState;

					if (window.parent && window.parent !== window) {
						ALLOWED_ORIGINS.forEach(origin => {
							window.parent.postMessage(cookieInfo, origin);
						});
					}
				}
			}

			/**
			 * Monitor for cookie changes
			 */
			function monitorCookieChanges() {
				let lastCookies = document.cookie;

				// Check immediately
				sendCookieStatus();

				// Poll for cookie changes (in case login happens via JavaScript)
				setInterval(() => {
					if (document.cookie !== lastCookies) {
						lastCookies = document.cookie;
						sendCookieStatus();
					}
				}, 1000); // Check every second

				// Monitor for page visibility changes
				document.addEventListener('visibilitychange', () => {
					if (!document.hidden) {
						sendCookieStatus();
					}
				});
			}

			// Initialize when DOM is ready
			if (document.readyState === 'loading') {
				document.addEventListener('DOMContentLoaded', monitorCookieChanges);
			} else {
				monitorCookieChanges();
			}

			// Also send immediately in case cookies are already present
			setTimeout(sendCookieStatus, 100);
		})();
		</script>
		<?php
	}
}

