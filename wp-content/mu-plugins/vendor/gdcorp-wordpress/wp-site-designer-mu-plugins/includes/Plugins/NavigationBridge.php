<?php
/**
 * Navigation Bridge Plugin
 *
 * @package wp-site-designer-mu-plugins
 */

namespace GoDaddy\WordPress\Plugins\SiteDesigner\Plugins;

use GoDaddy\WordPress\Plugins\SiteDesigner\Constants;
use GoDaddy\WordPress\Plugins\SiteDesigner\Utilities\IframeContextDetector;

use function add_action;

/**
 * Bridges navigation events between WordPress and Site Designer iframe
 */
class NavigationBridge {

	/**
	 * Constructor
	 */
	public function __construct() {
		if ( IframeContextDetector::isValidSiteDesignerRequest() ) {
			add_action( 'admin_footer', array( $this, 'outputScript' ), 999 );
			add_action( 'wp_footer', array( $this, 'outputScript' ), 999 );
		}
	}

	/**
	 * Output JavaScript to bridge navigation events
	 */
	public function outputScript() {
		$allowed_origins = Constants::getActiveOrigins();

		if ( empty( $allowed_origins ) ) {
			return;
		}

		?>
		<script type="text/javascript">
		(function() {
			const ALLOWED_ORIGINS = <?php echo wp_json_encode( $allowed_origins ); ?>;
			let urlCheckInterval = null;
			let unsubscribe = null;

			// Send current page info to parent window
			function sendNavigationInfo() {
				const pageInfo = {
					type: 'wordpress-navigation',
					url: window.location.href,
					pathname: window.location.pathname,
					timestamp: Date.now()
				};

				// Site Editor: get page info from wp.data
				if (typeof wp !== 'undefined' && wp.data) {
					try {
						const { select } = wp.data;
						const siteEditorStore = select('core/edit-site');

						if (siteEditorStore) {
							const urlParams = new URLSearchParams(window.location.search);
							const pageId = urlParams.get('postId');
							const pageType = urlParams.get('postType') || 'page';
							
							if (pageId) {
								pageInfo.pageId = parseInt(pageId, 10);
								
								const pageEntity = select('core').getEntityRecord('postType', pageType, pageInfo.pageId);
								
								if (pageEntity) {
									pageInfo.pageName = pageEntity.slug || pageEntity.title?.rendered || pageEntity.title?.raw || pageEntity.title;
								}
							}
						}
					} catch (e) {
						console.log('[NavigationBridge] Site editor error:', e.message);
					}
				}

				// Fallback: extract from URL pathname (frontend context)
				if (!pageInfo.pageName) {
					const pathname = window.location.pathname.replace(/^\/+|\/+$/g, '');
					const segments = pathname.split('/').filter(s => s);
					if (segments.length > 0) {
						pageInfo.pageName = segments[segments.length - 1];
					} else if (pathname === '') {
						// Root path - this is the home page
						pageInfo.pageName = 'home';
					}
				}

				// Extract page ID from body classes (WordPress adds these)
				const bodyClasses = document.body.className.split(' ');
				for (const className of bodyClasses) {
					if (className.startsWith('page-id-')) {
						pageInfo.pageId = parseInt(className.replace('page-id-', ''), 10);
						break;
					} else if (className.startsWith('postid-')) {
						pageInfo.pageId = parseInt(className.replace('postid-', ''), 10);
						break;
					}
				}

				// Extract page ID from admin URL if present
				const urlParams = new URLSearchParams(window.location.search);
				if (urlParams.has('post')) {
					pageInfo.pageId = parseInt(urlParams.get('post'), 10);
				}

				if (window.parent && window.parent !== window) {
					ALLOWED_ORIGINS.forEach(origin => {
						window.parent.postMessage(pageInfo, origin);
					});
				}
			}

			// Setup function for subscribe (needs wp.data to be loaded)
			function setupSubscribe() {
				// Only setup subscribe in site editor (not preview mode)
				if (typeof wp === 'undefined' || !wp.data || window.location.pathname.indexOf('site-editor.php') === -1) {
					return;
				}

				try {
					let lastPageId = null;
					let hasLoadedOnce = false;
					
					// Trigger initial fetch by calling the selector
					const urlParams = new URLSearchParams(window.location.search);
					const postId = urlParams.get('postId');
					if (postId) {
						const postIdNum = parseInt(postId, 10);
						const postType = urlParams.get('postType') || 'page';
						// This call triggers the async fetch
						wp.data.select('core').getEntityRecord('postType', postType, postIdNum);
					}
					
					// Subscribe to be notified when data loads
					unsubscribe = wp.data.subscribe(() => {
						try {
							// Get postId from URL
							const urlParams = new URLSearchParams(window.location.search);
							const postId = urlParams.get('postId');

							if (postId) {
								const postIdNum = parseInt(postId, 10);
								const postType = urlParams.get('postType') || 'page';
								
								// Check if entity record is available now
								const entity = wp.data.select('core').getEntityRecord('postType', postType, postIdNum);
								
								// When entity becomes available or page ID changes
								if (entity && postIdNum !== lastPageId) {
									lastPageId = postIdNum;
									hasLoadedOnce = true;
									setTimeout(sendNavigationInfo, 100);
								}
							}
						} catch (e) {
							// Silently ignore
						}
					});
				} catch (e) {
					console.log('[NavigationBridge] Error setting up subscribe:', e.message);
				}
			}

			// Send on initial load and setup subscribe
			if (document.readyState === 'loading') {
				document.addEventListener('DOMContentLoaded', () => {
					sendNavigationInfo();
					setupSubscribe();
				});
			} else {
				sendNavigationInfo();
				setupSubscribe();
			}

			// Send on history navigation (back/forward buttons, pushState, replaceState)
			window.addEventListener('popstate', sendNavigationInfo);

			// Intercept pushState and replaceState to detect SPA-style navigation
			const originalPushState = history.pushState;
			const originalReplaceState = history.replaceState;

			history.pushState = function() {
				originalPushState.apply(this, arguments);
				sendNavigationInfo();
			};

			history.replaceState = function() {
				originalReplaceState.apply(this, arguments);
				sendNavigationInfo();
			};

			// Send on hash changes
			window.addEventListener('hashchange', sendNavigationInfo);

			// Cleanup function
			function cleanup() {
				if (urlCheckInterval) {
					clearInterval(urlCheckInterval);
					urlCheckInterval = null;
				}
				if (unsubscribe) {
					unsubscribe();
					unsubscribe = null;
				}
			}

			// Cleanup on page unload
			window.addEventListener('beforeunload', cleanup);

			let lastUrl = window.location.href;
			urlCheckInterval = setInterval(() => {
				if (window.location.href !== lastUrl) {
					lastUrl = window.location.href;
					sendNavigationInfo();
				}
			}, 1000);
		})();
		</script>
		<?php
	}
}
