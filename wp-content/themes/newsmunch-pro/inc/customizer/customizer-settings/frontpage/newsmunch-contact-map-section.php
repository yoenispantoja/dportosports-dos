<?php
function newsmunch_contact_map_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Contact Map Section Panel
	=========================================*/
	$wp_customize->add_section(
		'contact_map_options', array(
			'title' => esc_html__( 'Contact Map Section', 'newsmunch-pro' ),
			'panel' => 'newsmunch_frontpage_options',
			'priority' => 10,
		)
	);
	
	/*=========================================
	Contact Map Content 
	=========================================*/
	$wp_customize->add_setting(
		'contact_map_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'contact_map_options_head',
		array(
			'type' => 'hidden',
			'label' => __('Contact Map Content','newsmunch-pro'),
			'section' => 'contact_map_options',
		)
	);	
	
	//  Map Link // 
	$wp_customize->add_setting(
    	'newsmunch_contact_map_link',
    	array(
			'default'     	=> 'https://maps.google.com/maps?q=London%20Eye%2C%20London%2C%20United%20Kingdom&amp;t=m&amp;z=10&amp;output=embed&amp;iwloc=near',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_url',
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_contact_map_link',
		array(
		    'label'   => __('Map Link','newsmunch-pro'),
		    'section' => 'contact_map_options',
			'type'           => 'textarea',
		)  
	);
	/*=========================================
	Contact Map After Before
	=========================================*/
	$wp_customize->add_setting(
		'contact_map_option_before_after'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'contact_map_option_before_after',
		array(
			'type' => 'hidden',
			'label' => __('Before / After Content','newsmunch-pro'),
			'section' => 'contact_map_options',
		)
	);
	
	// Before
	$wp_customize->add_setting(
	'newsmunch_contact_map_option_before',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 13,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_contact_map_option_before',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For Before Section','newsmunch-pro'),
			'section'	=> 'contact_map_options',
		)
	);	
	
	// After
	$wp_customize->add_setting(
	'newsmunch_contact_map_option_after',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 14,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_contact_map_option_after',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For After Section','newsmunch-pro'),
			'section'	=> 'contact_map_options',
		)
	);
}
add_action( 'customize_register', 'newsmunch_contact_map_customize_setting' );