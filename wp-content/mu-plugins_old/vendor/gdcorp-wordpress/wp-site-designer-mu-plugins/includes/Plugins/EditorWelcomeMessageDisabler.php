<?php
/**
 * Editor Welcome Message Disabler Plugin
 *
 * @package wp-site-designer-mu-plugins
 */

namespace GoDaddy\WordPress\Plugins\SiteDesigner\Plugins;

use function add_action;

/**
 * Disables the "Welcome to the Block Editor" message in the Gutenberg Editor
 */
class EditorWelcomeMessageDisabler {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_head-post.php', array( $this, 'outputScript' ) );
		add_action( 'admin_head-post-new.php', array( $this, 'outputScript' ) );
		add_action( 'admin_head-edit.php', array( $this, 'outputScript' ) );
		add_action( 'admin_head-site-editor.php', array( $this, 'outputScript' ) );
		add_action( 'admin_head-themes.php', array( $this, 'outputScript' ) );
	}

	/**
	 * Output JavaScript to disable the welcome guide
	 */
	public function outputScript() {
		?>
		<script>
			window.onload = (event) => {
				// Disable welcome guide for Post Editor (Gutenberg)
				if (wp.data && wp.data.select('core/edit-post')) {
					const editPost = wp.data.select('core/edit-post');
					if (editPost.isFeatureActive && editPost.isFeatureActive('welcomeGuide')) {
						wp.data.dispatch('core/edit-post').toggleFeature('welcomeGuide');
					}
				}
				
				// Disable welcome guide for Site Editor (FSE)
				if (wp.data && wp.data.select('core/edit-site')) {
					const editSite = wp.data.select('core/edit-site');
					if (editSite.isFeatureActive && editSite.isFeatureActive('welcomeGuide')) {
						wp.data.dispatch('core/edit-site').toggleFeature('welcomeGuide');
					}
				}
			};
		</script>
		<?php
	}
}

