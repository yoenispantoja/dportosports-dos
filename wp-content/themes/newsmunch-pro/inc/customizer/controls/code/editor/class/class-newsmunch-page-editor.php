<?php
/**
 * Page editor control
 *
 * @package newsmunch
 * @since newsmunch 1.0
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Class to create a custom tags control
 */
class NewsMunch_Page_Editor extends WP_Customize_Control {

	/**
	 * Flag to include sync scripts if needed
	 *
	 * @var bool|mixed
	 */
	private $needsync = false;

	/**
	 * NewsMunch_Page_Editor constructor.
	 *
	 * @param WP_Customize_Manager $manager Manager.
	 * @param string               $id Id.
	 * @param array                $args Constructor args.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		if ( ! empty( $args['needsync'] ) ) {
			$this->needsync = $args['needsync'];
		}
	}

	/**
	 * Enqueue scripts
	 *
	 * @since   1.1.0
	 * @access  public
	 * @updated Changed wp_enqueue_scripts order and dependencies.
	 */
	public function enqueue() {
		wp_enqueue_style( 'newsmunch_text_editor_css', get_template_directory_uri() . '/inc/customizer/controls/code/editor/css/newsmunch-page-editor.css', array(),'newsmunch-pro');
		wp_enqueue_script(
			'newsmunch_text_editor', get_template_directory_uri() . '/inc/customizer/controls/code/editor/js/newsmunch-text-editor.js', array(
				'jquery',
				'customize-preview',
			),'newsmunch-pro', true
		);
		if ( $this->needsync === true ) {
			wp_enqueue_script( 'newsmunch_controls_script', get_template_directory_uri() . '/inc/customizer/controls/code/editor/js/newsmunch-update-controls.js', array( 'jquery', 'newsmunch_text_editor' ),'newsmunch-pro', true );
			wp_localize_script(
				'newsmunch_controls_script', 'requestpost', array(
					'ajaxurl'           => admin_url( 'admin-ajax.php' ),
					'thumbnail_control' => 'newsmunch_feature_thumbnail', // name of image control that needs sync
				'editor_control'    => 'NewsMunch_Page_Editor', // name of control (theme_mod) that needs sync
				'thumbnail_label'   => esc_html__( 'About background', 'newsmunch-pro' ), // name of thumbnail control
				)
			);
		}
	}

	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content() {
		?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>" id="<?php echo esc_attr( $this->id ); ?>" class="editorfield">
			<a onclick="javascript:WPEditorWidget.toggleEditor('<?php echo $this->id; ?>');" class="button edit-content-button"><?php _e( '(Edit)', 'newsmunch-pro' ); ?></a>
		</label>
		<?php
	}
}
