<?php
/**
 * NewsMunch Customizer Class
 *
 * @package NewsMunch
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

 if ( ! class_exists( 'NewsMunch_Customizer' ) ) :

	class NewsMunch_Customizer {

		// Constructor customizer
		public function __construct() {
			add_action( 'customize_register',array( $this, 'newsmunch_customizer_register' ) );
			add_action( 'customize_register',array( $this, 'newsmunch_customizer_sainitization_selective_refresh' ) );
			add_action( 'customize_register',array( $this, 'newsmunch_customizer_control' ) );
			add_action( 'customize_preview_init',array( $this, 'newsmunch_customize_preview_js' ) );
			add_action( 'customize_controls_enqueue_scripts',array( $this, 'newsmunch_controls_scripts' ) );
			add_action( 'customize_controls_enqueue_scripts',array( $this, 'newsmunch_customizer_navigation_script' ) );
			add_action( 'after_setup_theme',array( $this, 'newsmunch_customizer_settings' ) );
		}
		
		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		public function newsmunch_customizer_register( $wp_customize ) {
			
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
			$wp_customize->get_setting('custom_logo')->transport = 'refresh';
		}
		
		// Register custom controls
		public function newsmunch_customizer_control( $wp_customize ) {
			
			$newsmunch_control_dir =  NEWSMUNCH_THEME_INC_DIR . '/customizer/controls';
			
			// Load custom control classes.
			$wp_customize->register_control_type( 'NewsMunch_Control_Sortable' );
			$wp_customize->register_control_type( 'NewsMunch_Customizer_Range_Control' );
			require $newsmunch_control_dir . '/code/newsmunch-customize-base-control.php';
			require $newsmunch_control_dir . '/code/newsmunch-slider-control.php';
			require $newsmunch_control_dir . '/code/newsmunch-control-sortable.php';
			require $newsmunch_control_dir . '/code/newsmunch-radio-image.php';
			require $newsmunch_control_dir . '/code/font-selector/functions.php';
			require $newsmunch_control_dir . '/code/newsmunch-icon-picker-control.php';
			require $newsmunch_control_dir . '/code/newsmunch-category-dropdown-control.php';
			require $newsmunch_control_dir . '/code/newsmunch-pricing-category-control.php';
			require $newsmunch_control_dir . '/code/newsmunch-portfolio-category-control.php';
			require $newsmunch_control_dir . '/code/newsmunch-product-category-control.php';
			require $newsmunch_control_dir . '/code/newsmunch-job-category-control.php';
			require $newsmunch_control_dir . '/code/editor/class/class-newsmunch-page-editor.php';
			require $newsmunch_control_dir . '/code/newsmunch-predefine-color.php';
			require $newsmunch_control_dir . '/code/newsmunch-predefine-pattern.php';

		}
		
		
		// Customizer Controls
		public function newsmunch_controls_scripts() {
				$js_prefix  = '.js';
				$css_prefix = '.css';
				
			// Customizer Core.
			wp_enqueue_script( 'newsmunch-customizer-controls-toggle-js', NEWSMUNCH_THEME_INC_URI . '/customizer/controls/js/newsmunch-toggle-control' . $js_prefix, array(), NEWSMUNCH_THEME_VERSION, true );

			// Customizer Controls.
			wp_enqueue_script( 'newsmunch-customizer-controls-js', NEWSMUNCH_THEME_INC_URI . '/customizer/controls/js/newsmunch-customizer-control' . $js_prefix, array( 'newsmunch-customizer-controls-toggle-js' ), NEWSMUNCH_THEME_VERSION, true );
		}
		
		// selective refresh.
		public function newsmunch_customizer_sainitization_selective_refresh() {

			require NEWSMUNCH_THEME_INC_DIR . '/customizer/sanitization.php';
			// Selective Refresh
			// require NEWSMUNCH_THEME_INC_DIR . '/customizer/newsmunch-selective-partial.php';
			// require NEWSMUNCH_THEME_INC_DIR . '/customizer/newsmunch-selective-refresh.php';

		}

		// Theme Customizer preview reload changes asynchronously.
		public function newsmunch_customize_preview_js() {
			wp_enqueue_script( 'newsmunch-customizer', NEWSMUNCH_THEME_INC_URI . '/customizer/assets/js/customizer-preview.js', array( 'customize-preview' ), NEWSMUNCH_THEME_VERSION, true );
		}
		
		public function newsmunch_customizer_navigation_script() {
			 wp_enqueue_script( 'newsmunch-customizer-section', NEWSMUNCH_THEME_INC_URI .'/customizer/assets/js/customizer-section.js', array("jquery"),'', true  );	
		}
		

		// Include customizer settings.
			
		public function newsmunch_customizer_settings() {
			$newsmunch_customize_dir =  NEWSMUNCH_THEME_INC_DIR . '/customizer/customizer-settings';
			  require $newsmunch_customize_dir . '/newsmunch-header-section.php';
			  require $newsmunch_customize_dir . '/newsmunch-footer-section.php';
			   require $newsmunch_customize_dir . '/frontpage/newsmunch-top-tags-section.php';
			  // require $newsmunch_customize_dir . '/frontpage/newsmunch-hero-section.php';
			  require $newsmunch_customize_dir . '/frontpage/newsmunch-slider-section.php';
			  require $newsmunch_customize_dir . '/frontpage/newsmunch-featured-link-section.php';
			  // require $newsmunch_customize_dir . '/frontpage/newsmunch-editor-section.php';
			  // require $newsmunch_customize_dir . '/frontpage/newsmunch-sponsor-section.php';
			  // require $newsmunch_customize_dir . '/frontpage/newsmunch-trending-section.php';
			  // require $newsmunch_customize_dir . '/frontpage/newsmunch-inspiration-section.php';
			  // require $newsmunch_customize_dir . '/frontpage/newsmunch-latest-post-section.php';
			   require $newsmunch_customize_dir . '/frontpage/newsmunch-you-missed-section.php';
			  // require $newsmunch_customize_dir . '/frontpage/newsmunch-gallery-section.php';
			   require $newsmunch_customize_dir . '/frontpage/newsmunch-about-section.php';
			   require $newsmunch_customize_dir . '/frontpage/newsmunch-skill-section.php';
			   require $newsmunch_customize_dir . '/frontpage/newsmunch-team-section.php';
			   require $newsmunch_customize_dir . '/frontpage/newsmunch-faq-section.php';
			   require $newsmunch_customize_dir . '/frontpage/newsmunch-contact-info-section.php';
			   require $newsmunch_customize_dir . '/frontpage/newsmunch-contact-form-section.php';
			   require $newsmunch_customize_dir . '/frontpage/newsmunch-contact-map-section.php';
			   require $newsmunch_customize_dir . '/newsmunch-frontpage-layout.php';
			   require $newsmunch_customize_dir . '/newsmunch-theme-options.php';
			   require $newsmunch_customize_dir . '/newsmunch-prebuilt-page.php';
			   require $newsmunch_customize_dir . '/newsmunch-color-scheme.php';
			   require $newsmunch_customize_dir . '/newsmunch-typography.php';
			  require NEWSMUNCH_THEME_INC_DIR . '/customizer/newsmunch-selective-partial.php';
			  require NEWSMUNCH_THEME_INC_DIR . '/customizer/newsmunch-selective-refresh.php';
		}

	}
endif;
new NewsMunch_Customizer();