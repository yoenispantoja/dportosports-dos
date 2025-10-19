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
			$wp_customize->register_control_type( 'NewsMunch_Customizer_Range_Control' );
			require $newsmunch_control_dir . '/code/newsmunch-slider-control.php';
			require $newsmunch_control_dir . '/code/newsmunch-category-dropdown-control.php';

		}
		
		
		// Customizer Controls
		public function newsmunch_controls_scripts() {
			// Customizer Core.
			wp_enqueue_script( 'newsmunch-customizer-controls-toggle-js', NEWSMUNCH_THEME_INC_URI . '/customizer/controls/js/newsmunch-toggle-control.js', array(), NEWSMUNCH_THEME_VERSION, true );

			// Customizer Controls.
			wp_enqueue_script( 'newsmunch-customizer-controls-js', NEWSMUNCH_THEME_INC_URI . '/customizer/controls/js/newsmunch-customizer-control.js', array( 'newsmunch-customizer-controls-toggle-js' ), NEWSMUNCH_THEME_VERSION, true );
		}
		
		// selective refresh.
		public function newsmunch_customizer_sainitization_selective_refresh() {

			require NEWSMUNCH_THEME_INC_DIR . '/customizer/sanitization.php';

		}

		// Theme Customizer preview reload changes asynchronously.
		public function newsmunch_customize_preview_js() {
			wp_enqueue_script( 'newsmunch-customizer', NEWSMUNCH_THEME_INC_URI . '/customizer/assets/js/customizer-preview.js', array( 'customize-preview' ), NEWSMUNCH_THEME_VERSION, true );
		}
		
		

		// Include customizer settings.
			
		public function newsmunch_customizer_settings() {
			// Recommended Plugin
			require NEWSMUNCH_THEME_INC_DIR . '/customizer/customizer-plugin-notice/newsmunch-notify-plugin.php';
			  
		    // Upsale
		    require NEWSMUNCH_THEME_INC_DIR . '/customizer/controls/code/upgrade/class-customize.php';
			
			$newsmunch_customize_dir =  NEWSMUNCH_THEME_INC_DIR . '/customizer/customizer-settings';
			  require $newsmunch_customize_dir . '/newsmunch-header-customize-setting.php';
			  require $newsmunch_customize_dir . '/newsmunch-footer-customize-setting.php';
			  require $newsmunch_customize_dir . '/newsmunch-top-tags-customize-setting.php';
			  require $newsmunch_customize_dir . '/newsmunch-slider-customize-setting.php';
			  require $newsmunch_customize_dir . '/newsmunch-featured-link-customize-setting.php';
			  require $newsmunch_customize_dir . '/newsmunch-you-missed-customize-setting.php';
			  require $newsmunch_customize_dir . '/newsmunch-theme-customize-setting.php';
			  require $newsmunch_customize_dir . '/newsmunch-prebuilt-page-customize-setting.php';
			  require $newsmunch_customize_dir . '/newsmunch-typography-customize-setting.php';
			  require NEWSMUNCH_THEME_INC_DIR . '/customizer/newsmunch-selective-partial.php';
			  require NEWSMUNCH_THEME_INC_DIR . '/customizer/newsmunch-selective-refresh.php';
		}

	}
endif;
new NewsMunch_Customizer();