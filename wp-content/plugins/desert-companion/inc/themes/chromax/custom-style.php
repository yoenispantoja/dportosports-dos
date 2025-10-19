<?php
/**
 * Enqueue User Custom styles.
 */
if( ! function_exists( 'desert_chromax_user_custom_style' ) ):
    function desert_chromax_user_custom_style() {

		$chromax_print_style = '';
		
		/*=========================================
		Slider 
		=========================================*/
		$chromax_slider_overlay 	= get_theme_mod('chromax_slider_overlay','#000000');
		$chromax_slider_opacity	= get_theme_mod('chromax_slider_opacity','0.6');
		list($color1, $color2, $color3) = sscanf($chromax_slider_overlay, "#%02x%02x%02x");
				$chromax_print_style .=".dt_slider .dt_slider-wrapper {
					background-color: rgba($color1, $color2, $color3, $chromax_slider_opacity);
				}\n";	
				
        wp_add_inline_style( 'atua-style', $chromax_print_style );
    }
endif;
add_action( 'wp_enqueue_scripts', 'desert_chromax_user_custom_style' );