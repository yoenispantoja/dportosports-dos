<?php
function newsmunch_contact_info_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Contact Info Section Panel
	=========================================*/
	$wp_customize->add_section(
		'contact_info_options', array(
			'title' => esc_html__( 'Contact Info Section', 'newsmunch-pro' ),
			'panel' => 'newsmunch_frontpage_options',
			'priority' => 9,
		)
	);
	
	/*=========================================
	Contact Info Content 
	=========================================*/
	$wp_customize->add_setting(
		'contact_info_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'contact_info_options_head',
		array(
			'type' => 'hidden',
			'label' => __('Contact Info Content','newsmunch-pro'),
			'section' => 'contact_info_options',
		)
	);
	
	// Contact Info 
		$wp_customize->add_setting( 'newsmunch_contact_info_option', 
			array(
			 'sanitize_callback' => 'newsmunch_repeater_sanitize',
			 'priority' => 5,
			  'default' => newsmunch_contact_info_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new NewsMunch_Repeater( $wp_customize, 
				'newsmunch_contact_info_option', 
					array(
						'label'   => esc_html__('Contact Info','newsmunch-pro'),
						'section' => 'contact_info_options',
						'add_field_label'                   => esc_html__( 'Add New Contact Info', 'newsmunch-pro' ),
						'item_name'                         => esc_html__( 'Contact Info', 'newsmunch-pro' ),
						
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_link_control' => true,
					) 
				) 
			);
	
	/*=========================================
	Contact Info After Before
	=========================================*/
	$wp_customize->add_setting(
		'contact_info_option_before_after'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'contact_info_option_before_after',
		array(
			'type' => 'hidden',
			'label' => __('Before / After Content','newsmunch-pro'),
			'section' => 'contact_info_options',
		)
	);
	
	// Before
	$wp_customize->add_setting(
	'newsmunch_contact_info_option_before',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 13,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_contact_info_option_before',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For Before Section','newsmunch-pro'),
			'section'	=> 'contact_info_options',
		)
	);	
	
	// After
	$wp_customize->add_setting(
	'newsmunch_contact_info_option_after',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 14,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_contact_info_option_after',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For After Section','newsmunch-pro'),
			'section'	=> 'contact_info_options',
		)
	);
}
add_action( 'customize_register', 'newsmunch_contact_info_customize_setting' );