<?php
function newsmunch_contact_form_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Contact Form Section Panel
	=========================================*/
	$wp_customize->add_section(
		'contact_form_options', array(
			'title' => esc_html__( 'Contact Form Section', 'newsmunch-pro' ),
			'panel' => 'newsmunch_frontpage_options',
			'priority' => 10,
		)
	);
	
	/*=========================================
	Contact Form Content 
	=========================================*/
	$wp_customize->add_setting(
		'contact_form_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'contact_form_options_head',
		array(
			'type' => 'hidden',
			'label' => __('Contact Form Content','newsmunch-pro'),
			'section' => 'contact_form_options',
		)
	);	
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_contact_form_ttl',
    	array(
	        'default'			=> __('Send Message','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_contact_form_ttl',
		array(
		    'label'   => __('Title','newsmunch-pro'),
		    'section' => 'contact_form_options',
			'type'           => 'text',
		)  
	);
	
	
	//  Shortcode // 
	$wp_customize->add_setting(
    	'newsmunch_contact_form_shortcode',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_contact_form_shortcode',
		array(
		    'label'   => __('Shortcode','newsmunch-pro'),
		    'section' => 'contact_form_options',
			'type'           => 'text',
		)  
	);

	//  Image // 
    $wp_customize->add_setting( 
    	'newsmunch_contact_form_img' , 
    	array(
			'default' 			=> esc_url(get_template_directory_uri() .'/assets/img/other/contact.webp'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_url',	
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'newsmunch_contact_form_img' ,
		array(
			'label'          => esc_html__( 'Image', 'newsmunch-pro'),
			'section'        => 'contact_form_options',
		) 
	));
	
	/*=========================================
	Contact Form After Before
	=========================================*/
	$wp_customize->add_setting(
		'contact_form_option_before_after'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'contact_form_option_before_after',
		array(
			'type' => 'hidden',
			'label' => __('Before / After Content','newsmunch-pro'),
			'section' => 'contact_form_options',
		)
	);
	
	// Before
	$wp_customize->add_setting(
	'newsmunch_contact_form_option_before',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 13,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_contact_form_option_before',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For Before Section','newsmunch-pro'),
			'section'	=> 'contact_form_options',
		)
	);	
	
	// After
	$wp_customize->add_setting(
	'newsmunch_contact_form_option_after',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 14,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_contact_form_option_after',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For After Section','newsmunch-pro'),
			'section'	=> 'contact_form_options',
		)
	);
}
add_action( 'customize_register', 'newsmunch_contact_form_customize_setting' );