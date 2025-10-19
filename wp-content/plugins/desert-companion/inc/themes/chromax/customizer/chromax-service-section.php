<?php
function chromax_service_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Service  Section
	=========================================*/
	$wp_customize->add_section(
		'service_options', array(
			'title' => esc_html__( 'Service Section', 'desert-companion' ),
			'priority' => 4,
			'panel' => 'chromax_frontpage_options',
		)
	);
	
	/*=========================================
	Service Setting
	=========================================*/
	$wp_customize->add_setting(
		'service_options_setting_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'service_options_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Service Setting','desert-companion'),
			'section' => 'service_options',
		)
	);

	// Hide/Show Setting
	$wp_customize->add_setting(
		'chromax_service_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'chromax_service_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'service_options',
		)
	);
	
	/*=========================================
	Header  Section
	=========================================*/
	$wp_customize->add_setting(
		'chromax_service_header_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'chromax_service_header_options',
		array(
			'type' => 'hidden',
			'label' => __('Header','desert-companion'),
			'section' => 'service_options',
		)
	);
	
	
	
	//  Title // 
	$wp_customize->add_setting(
    	'chromax_service_ttl',
    	array(
	        'default'			=> __('Empowering','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'chromax_service_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'service_options',
			'type'           => 'text',
		)  
	);
	
	
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'chromax_service_subttl',
    	array(
	        'default'			=> __('Your Business Growth Through IT Solutions.','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'chromax_service_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'service_options',
			'type'           => 'text',
		)  
	);
	
	/*=========================================
	Content  Section
	=========================================*/
	$wp_customize->add_setting(
		'chromax_service_content_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'chromax_service_content_options',
		array(
			'type' => 'hidden',
			'label' => __('Content','desert-companion'),
			'section' => 'service_options',
		)
	);
	
	// Service 
		$wp_customize->add_setting( 'chromax_service_option', 
			array(
			 'sanitize_callback' => 'chromax_repeater_sanitize',
			 'priority' => 5,
			  'default' => chromax_service_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new Chromax_Repeater( $wp_customize, 
				'chromax_service_option', 
					array(
						'label'   => esc_html__('Service','desert-companion'),
						'section' => 'service_options',
						'add_field_label'                   => esc_html__( 'Add New Service', 'desert-companion' ),
						'item_name'                         => esc_html__( 'Service', 'desert-companion' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_text_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_image_control' => true
					) 
				) 
			);
	
	// Upgrade
	$wp_customize->add_setting(
	'chromax_service_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 5,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'chromax_service_option_upsale', 
			array(
				'label'      => __( 'Service', 'desert-companion' ),
				'section'    => 'service_options'
			) 
		) 
	);	
	
	//  Description // 
	$wp_customize->add_setting(
    	'chromax_service_text',
    	array(
	        'default'			=> __('Ever find yourself staring at your computer screen a good consulting slogan to come to mind? Oftentimes.','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 6,
		)
	);	
	
	$wp_customize->add_control( 
		'chromax_service_text',
		array(
		    'label'   => __('Description','desert-companion'),
		    'section' => 'service_options',
			'type'           => 'textarea',
		)  
	);
	
	//  Button Label // 
	$wp_customize->add_setting(
    	'chromax_service_btn_lbl',
    	array(
	        'default'			=> __('See All Service','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 6,
		)
	);	
	
	$wp_customize->add_control( 
		'chromax_service_btn_lbl',
		array(
		    'label'   => __('Button Label','desert-companion'),
		    'section' => 'service_options',
			'type'           => 'text',
		)  
	);
	
	//  Button Link // 
	$wp_customize->add_setting(
    	'chromax_service_btn_url',
    	array(
	        'default'			=> '#',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_url',
			'priority' => 6,
		)
	);	
	
	$wp_customize->add_control( 
		'chromax_service_btn_url',
		array(
		    'label'   => __('Button Link','desert-companion'),
		    'section' => 'service_options',
			'type'           => 'text',
		)  
	);
	
	/*=========================================
	Service After Before
	=========================================*/
	$wp_customize->add_setting(
		'chromax_service_option_before_after'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'chromax_service_option_before_after',
		array(
			'type' => 'hidden',
			'label' => __('Before / After Content','desert-companion'),
			'section' => 'service_options',
		)
	);
	
	// Before
	$wp_customize->add_setting(
	'chromax_service_option_before',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'chromax_sanitize_integer',
			'priority' => 13,
		)
	);
		
	$wp_customize->add_control(
	'chromax_service_option_before',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For Before Section','desert-companion'),
			'section'	=> 'service_options',
		)
	);	
	
	// After
	$wp_customize->add_setting(
	'chromax_service_option_after',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'chromax_sanitize_integer',
			'priority' => 14,
		)
	);
		
	$wp_customize->add_control(
	'chromax_service_option_after',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For After Section','desert-companion'),
			'section'	=> 'service_options',
		)
	);
}
add_action( 'customize_register', 'chromax_service_customize_setting' );