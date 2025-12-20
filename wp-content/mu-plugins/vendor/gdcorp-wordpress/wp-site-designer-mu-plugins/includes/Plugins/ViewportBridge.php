<?php
/**
 * Viewport Bridge Plugin
 *
 * @package wp-site-designer-mu-plugins
 */

namespace GoDaddy\WordPress\Plugins\SiteDesigner\Plugins;

use GoDaddy\WordPress\Plugins\SiteDesigner\Constants;
use GoDaddy\WordPress\Plugins\SiteDesigner\Utilities\IframeContextDetector;

use function add_action;

/**
 * Captures viewport context for Site Designer chat requests
 * Reports what content is visible to help AI understand user's current view
 */
class ViewportBridge {

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
	 * Output JavaScript to capture and report visible content
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
			let lastSentData = '';
			let pollingInterval = null;
			let unsubscribe = null;

			/**
			 * Truncate text to max length
			 */
			function truncate(text, maxLength) {
				if (!text) return '';
				const cleaned = text.trim().replace(/\s+/g, ' ');
				return cleaned.length > maxLength 
					? cleaned.substring(0, maxLength) + '...' 
					: cleaned;
			}

			/**
			 * Get the content root (where actual page content lives)
			 * Returns object with { root, window } for proper viewport detection
			 */
			function getContentRoot() {
				// Site Editor: content is in nested iframe
				const editorCanvas = document.querySelector('iframe[name="editor-canvas"]');
				if (editorCanvas?.contentDocument) {
					return { 
						root: editorCanvas.contentDocument.body, 
						window: editorCanvas.contentWindow 
					};
				}
				
				// All other contexts (Post Editor, Frontend, Preview)
				return { root: document.body, window: window };
			}

			/**
			 * Check if element is visible in viewport
			 */
			function isElementVisible(element, targetWindow) {
				if (!element) return false;
				const rect = element.getBoundingClientRect();
				const viewportHeight = targetWindow ? targetWindow.innerHeight : window.innerHeight;
				return (
					rect.top < viewportHeight &&
					rect.bottom > 0 &&
					rect.height > 0 &&
					rect.width > 0
				);
			}

			/**
			 * Check if element is inside a header tag
			 */
			function isInsideHeader(element) {
				return element.closest('header') !== null;
			}

			/**
			 * Check if element is inside a footer tag
			 */
			function isInsideFooter(element) {
				return element.closest('footer') !== null;
			}

			/**
			 * Check if element is in main content (not in header or footer)
			 */
			function isInMainContent(element) {
				return !isInsideHeader(element) && !isInsideFooter(element);
			}

			/**
			 * Get label text for an input element
			 */
			function getInputLabel(input) {
				// Try to find label by 'for' attribute
				if (input.id) {
					const label = document.querySelector(`label[for="${input.id}"]`);
					if (label) {
						return label.innerText.trim();
					}
				}
				
				// Try to find parent label
				const parentLabel = input.closest('label');
				if (parentLabel) {
					return parentLabel.innerText.trim();
				}
				
				// Try to find previous sibling label
				let prevSibling = input.previousElementSibling;
				while (prevSibling) {
					if (prevSibling.tagName.toLowerCase() === 'label') {
						return prevSibling.innerText.trim();
					}
					prevSibling = prevSibling.previousElementSibling;
				}
				
				// Try placeholder or name as fallback
				return input.placeholder || input.name || '';
			}

			/**
			 * Get element info based on type
			 */
			function getElementInfo(element) {
				const tagName = element.tagName.toLowerCase();
				
				// Heading
				if (tagName.match(/^h[1-6]$/)) {
					return {
						type: 'heading',
						text: truncate(element.innerText, 50)
					};
				}
				
				// Paragraph
				if (tagName === 'p') {
					const text = element.innerText.trim();
					if (text.length > 0) {
						return {
							type: 'paragraph',
							text: truncate(text, 100)
						};
					}
				}
				
				// Input (text, email, password, number, tel, url, search, textarea, select)
				if (tagName === 'input' || tagName === 'textarea' || tagName === 'select') {
					const inputType = element.type || 'text';
					// Skip hidden inputs and buttons
					if (inputType === 'hidden' || inputType === 'submit' || inputType === 'button') {
						return null;
					}
					
					const label = getInputLabel(element);
					const value = element.value || '';
					
					// Format: label value (or just label if no value, or just value if no label)
					let text = '';
					if (label && value) {
						text = `${truncate(label, 30)} ${truncate(value, 50)}`;
					} else if (label) {
						text = truncate(label, 50);
					} else if (value) {
						text = truncate(value, 50);
					}
					
					if (text) {
						return {
							type: 'input',
							text: text
						};
					}
				}
				
				// Button (WordPress blocks or standard buttons)
				// In editor: <div role="textbox" class="wp-block-button__link">
				// In frontend: <a class="wp-element-button"> or <button>
				if (tagName === 'button' ||
					(tagName === 'a' && element.classList.contains('wp-element-button')) ||
					(tagName === 'a' && element.closest('.wp-block-button')) ||
					(tagName === 'div' && element.classList.contains('wp-block-button__link'))) {
					return {
						type: 'button',
						text: truncate(element.innerText, 30)
					};
				}
			
				// Image - use wp-image-{id} from class
				if (tagName === 'img') {
					const altText = element?.alt ? truncate(element.alt, 50) : null;
					const className = element?.className || '';
					
					// Extract wp-image-{id} from class
					const wpImageMatch = className.match(/wp-image-(\d+)/);
					const imageId = wpImageMatch ? wpImageMatch[1] : undefined;
					
					if (altText || imageId) {
						const imageInfo = {
							type: 'image',
							text: altText || '',
							imageId: imageId ? parseInt(imageId, 10) : undefined
						};

						return imageInfo;
					}
				}
				
				return null;
			}

			/**
			 * Capture viewport context with visible elements
			 */
			function captureViewportContext() {
				const contentContext = getContentRoot();
				const contentRoot = contentContext.root;
				const targetWindow = contentContext.window;
				const elements = [];
				
				// Get ALL elements we care about in their natural HTML order
				const selector = 'h1, h2, h3, h4, h5, h6, p, input, textarea, select, button, a.wp-element-button, .wp-block-button a, .wp-block-button__link, img';
				contentRoot.querySelectorAll(selector).forEach(element => {
					// Check if visible and in main content
					if (!isElementVisible(element, targetWindow) || !isInMainContent(element)) {
						return;
					}
					
					const tagName = element.tagName.toLowerCase();
					
					// Skip empty paragraphs
					if (tagName === 'p') {
						const text = element.innerText.trim();
						if (text.length === 0) {
							return;
						}
					}
					
					// Skip images without alt text
					if (tagName === 'img' && !element.alt) {
						return;
					}
					
					// Get element info
					const info = getElementInfo(element);
					
					// Skip buttons without text
					if (info && info.type === 'button' && !info.text) {
						return;
					}
					
					// Add element if we got valid info
					if (info) {
						elements.push(info);
					}
				});
				
				return {
					type: 'wordpress-viewport',
					timestamp: Date.now(),
					scrollPercent: Math.round((window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100) || 0,
					visibleElements: elements
				};
			}

			/**
			 * Send viewport context to parent window
			 */
			function sendViewportContext() {
				if (!ALLOWED_ORIGINS || !ALLOWED_ORIGINS.length || !window.parent || window.parent === window) {
					return;
				}

				try {
					const context = captureViewportContext();
					const currentData = JSON.stringify(context.visibleElements);
					
					// Only send if data has changed significantly
					if (currentData !== lastSentData) {
						lastSentData = currentData;
						// Send to all allowed origins
						ALLOWED_ORIGINS.forEach(origin => {
							window.parent.postMessage(context, origin);
						});
					}
				} catch (e) {
					console.error('Error capturing viewport context:', e);
				}
			}

			/**
			 * Check if we're in the site editor
			 */
			function isSiteEditor() {
				return window.location.pathname.includes('site-editor.php');
			}

			/**
			 * Setup polling for site editor (every 3 seconds)
			 */
			function setupPolling() {
				if (isSiteEditor()) {
					pollingInterval = setInterval(function() {
						sendViewportContext();
					}, 3000);
				}
			}

			/**
			 * Cleanup function to clear interval and unsubscribe
			 */
			function cleanup() {
				if (pollingInterval) {
					clearInterval(pollingInterval);
					pollingInterval = null;
				}
				if (unsubscribe) {
					unsubscribe();
					unsubscribe = null;
				}
			}

			/**
			 * Setup event listeners for basic interactions
			 */
			function setupEventListeners() {
				let scrollTimeout;
				
				// Send on scroll (debounced)
				window.addEventListener('scroll', function() {
					clearTimeout(scrollTimeout);
					scrollTimeout = setTimeout(sendViewportContext, 200);
				}, { passive: true });

				// Send on focus changes
				document.addEventListener('focusin', function() {
					setTimeout(sendViewportContext, 50);
				});
				
				// Send on click (user might be clicking buttons/links)
				document.addEventListener('click', function() {
					setTimeout(sendViewportContext, 50);
				});

				// Cleanup on page unload
				window.addEventListener('beforeunload', cleanup);
			}

			/**
			 * Setup subscribe for Gutenberg block selection changes and initial content load
			 */
			function setupSubscribe() {
				// Only setup if wp.data is available
				if (typeof wp === 'undefined' || !wp.data) {
					return;
				}

				try {
					let previousSelectedBlock = null;
					let hasLoadedOnce = false;
					
					unsubscribe = wp.data.subscribe(() => {
						try {
							// Check if blocks are available (content is loaded)
							const blocks = wp.data.select('core/block-editor')?.getBlocks();
							
							// Send initial viewport context when blocks first become available
							if (blocks && blocks.length > 0 && !hasLoadedOnce) {
								hasLoadedOnce = true;
								setTimeout(sendViewportContext, 100);
							}
							
							// Track block selection changes
							const selectedBlockClientId = wp.data.select('core/block-editor')?.getSelectedBlockClientId();
							if (selectedBlockClientId !== previousSelectedBlock) {
								previousSelectedBlock = selectedBlockClientId;
								setTimeout(sendViewportContext, 50);
							}
						} catch (e) {
							// Silently ignore - block editor may not be available
						}
					});
				} catch (e) {
					console.log('[ViewportBridge] Error setting up subscribe:', e.message);
				}
			}

			// Setup event listeners
			setupEventListeners();

			// Setup polling for site editor
			setupPolling();

			// Send initial context and setup subscribe
			if (document.readyState === 'loading') {
				document.addEventListener('DOMContentLoaded', function() {
					setTimeout(sendViewportContext, 200);
					setupSubscribe();
				});
			} else {
				setTimeout(sendViewportContext, 200);
				setupSubscribe();
			}
		})();
		</script>
		<?php
	}
}

