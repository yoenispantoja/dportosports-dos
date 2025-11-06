<?php
/*=========================================
 WPML and Polylang compatibility functions
=========================================*/
/**
 * Filter to translate strings
 */
function newsmunch_translate_single_string( $original_value, $domain ) {
	if ( is_customize_preview() ) {
		$wpml_translation = $original_value;
	} else {
		$wpml_translation = apply_filters( 'wpml_translate_single_string', $original_value, $domain, $original_value );
		if ( $wpml_translation === $original_value && function_exists( 'pll__' ) ) {
			return pll__( $original_value );
		}
	}
	return $wpml_translation;
}
add_filter( 'newsmunch_translate_single_string', 'newsmunch_translate_single_string', 10, 2 );

/**
 * Helper to register pll string.
 */
function newsmunch_pll_string_register_helper( $theme_mod ) {
	if ( ! function_exists( 'pll_register_string' ) ) {
		return;
	}
	
	$repeater_content = get_theme_mod( $theme_mod );
	$repeater_content = json_decode( $repeater_content );
	if ( ! empty( $repeater_content ) ) {
		foreach ( $repeater_content as $repeater_item ) {
			foreach ( $repeater_item as $field_name => $field_value ) {
				if ( $field_value !== 'undefined' ) {
					if ( $field_name !== 'id' ) {
						$f_n = ucfirst( $field_name );
						pll_register_string( $f_n, $field_value);
					}
				}
			}
		}
	}
}


/*==================================================================================
Header Section Social Icon
==================================================================================*/
function newsmunch_header_social_strings() {
	$default = newsmunch_get_social_icon_default();
	newsmunch_pll_string_register_helper( 'newsmunch_hdr_social', $default, 'Header Section Social' );
}


/*==================================================================================
 Featured Link Section
==================================================================================*/
function newsmunch_featured_link_strings() {
	$default = newsmunch_featured_link_custom_options_default();
	newsmunch_pll_string_register_helper( 'newsmunch_featured_link_custom', $default, 'Featured Link section' );
}

/*==================================================================================
 Team Section
==================================================================================*/
function newsmunch_team_strings() {
	$default = newsmunch_team_options_default();
	newsmunch_pll_string_register_helper( 'newsmunch_team_option', $default, 'Team section' );
}

/*==================================================================================
 FAQ Section
==================================================================================*/
function newsmunch_faq_strings() {
	$default = newsmunch_faq_options_default();
	newsmunch_pll_string_register_helper( 'newsmunch_faq_option', $default, 'FAQ section' );
}

/*==================================================================================
 Contact Info Section
==================================================================================*/
function newsmunch_contact_info_strings() {
	$default = newsmunch_contact_info_options_default();
	newsmunch_pll_string_register_helper( 'newsmunch_contact_info_option', $default, 'Contact Info section' );
}


/*==================================================================================
Footer Section Social Icon
==================================================================================*/
function newsmunch_footer_social_strings() {
	$default = newsmunch_get_social_icon_default();
	newsmunch_pll_string_register_helper( 'newsmunch_footer_copyright_social', $default, 'Footer Section Social' );
}


if ( function_exists( 'pll_register_string' ) ) {
	add_action( 'after_setup_theme', 'newsmunch_header_social_strings', 11 );
	add_action( 'after_setup_theme', 'newsmunch_featured_link_strings', 11 );
	add_action( 'after_setup_theme', 'newsmunch_team_strings', 11 );
	add_action( 'after_setup_theme', 'newsmunch_faq_strings', 11 );
	add_action( 'after_setup_theme', 'newsmunch_contact_info_strings', 11 );
	add_action( 'after_setup_theme', 'newsmunch_footer_social_strings', 11 );
}