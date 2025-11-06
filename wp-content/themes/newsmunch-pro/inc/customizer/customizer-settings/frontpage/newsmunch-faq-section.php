<?php
function newsmunch_faq_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	FAQ Section Panel
	=========================================*/
	$wp_customize->add_section(
		'faq_options', array(
			'title' => esc_html__( 'FAQ Section', 'newsmunch-pro' ),
			'panel' => 'newsmunch_frontpage_options',
			'priority' => 9,
		)
	);
	
	/*=========================================
	FAQ Content 
	=========================================*/
	$wp_customize->add_setting(
		'faq_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'faq_options_head',
		array(
			'type' => 'hidden',
			'label' => __('FAQ Content','newsmunch-pro'),
			'section' => 'faq_options',
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_faq_ttl',
    	array(
	        'default'			=> __('Frequently Asked Questions','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_faq_ttl',
		array(
		    'label'   => __('Title','newsmunch-pro'),
		    'section' => 'faq_options',
			'type'           => 'text',
		)  
	);
	
	
	// FAQ 
		$wp_customize->add_setting( 'newsmunch_faq_option', 
			array(
			 'sanitize_callback' => 'newsmunch_repeater_sanitize',
			 'priority' => 5,
			  'default' => newsmunch_faq_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new NewsMunch_Repeater( $wp_customize, 
				'newsmunch_faq_option', 
					array(
						'label'   => esc_html__('FAQ','newsmunch-pro'),
						'section' => 'faq_options',
						'add_field_label'                   => esc_html__( 'Add New FAQ', 'newsmunch-pro' ),
						'item_name'                         => esc_html__( 'FAQ', 'newsmunch-pro' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control' => true,
					) 
				) 
			);
			
	
	/*=========================================
	FAQ After Before
	=========================================*/
	$wp_customize->add_setting(
		'faq_option_before_after'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'faq_option_before_after',
		array(
			'type' => 'hidden',
			'label' => __('Before / After Content','newsmunch-pro'),
			'section' => 'faq_options',
		)
	);
	
	// Before
	$wp_customize->add_setting(
	'newsmunch_faq_option_before',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 13,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_faq_option_before',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For Before Section','newsmunch-pro'),
			'section'	=> 'faq_options',
		)
	);	
	
	// After
	$wp_customize->add_setting(
	'newsmunch_faq_option_after',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 14,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_faq_option_after',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For After Section','newsmunch-pro'),
			'section'	=> 'faq_options',
		)
	);
}
add_action( 'customize_register', 'newsmunch_faq_customize_setting' );