<?php
/**
 * @package   Chromica
 */

require desert_companion_plugin_dir . 'inc/themes/chromax/customizer-repeater-default.php';
require desert_companion_plugin_dir . 'inc/themes/chromax/custom-style.php';
require desert_companion_plugin_dir . 'inc/themes/chromax/customizer/chromax-slider-section.php';
require desert_companion_plugin_dir . 'inc/themes/chromax/customizer/chromax-information-section.php';
require desert_companion_plugin_dir . 'inc/themes/chromax/customizer/chromax-about-section.php';
require desert_companion_plugin_dir . 'inc/themes/chromax/customizer/chromax-service-section.php';
require desert_companion_plugin_dir . 'inc/themes/chromax/customizer/chromax-why-section.php';
require desert_companion_plugin_dir . 'inc/themes/chromax/customizer/chromax-blog-section.php';
require desert_companion_plugin_dir . 'inc/themes/chromax/customizer/chromax-selective-refresh.php';
require desert_companion_plugin_dir . 'inc/themes/chromax/customizer/chromax-selective-partial.php';

if ( ! function_exists( 'desert_companion_chromax_frontpage_sections' ) ) :
	function desert_companion_chromax_frontpage_sections() {	
		require desert_companion_plugin_dir . 'inc/themes/chromax/front/section-slider.php';
		require desert_companion_plugin_dir . 'inc/themes/chromica/front/section-information.php';
		require desert_companion_plugin_dir . 'inc/themes/chromax/front/section-about.php';
		require desert_companion_plugin_dir . 'inc/themes/chromica/front/section-service.php';
		require desert_companion_plugin_dir . 'inc/themes/chromax/front/section-why-choose.php';
		require desert_companion_plugin_dir . 'inc/themes/chromax/front/section-blog.php';
    }
	add_action( 'Desert_Companion_Chromax_frontpage', 'desert_companion_chromax_frontpage_sections' );
endif;