<?php
function chromax_why_choose_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Why Choose Section
	=========================================*/
	$wp_customize->add_section(
		'why_choose_options', array(
			'title' => esc_html__( 'Why Choose Section', 'chromax-pro' ),
			'priority' => 8,
			'panel' => 'chromax_frontpage_options',
		)
	);
	
	/*=========================================
	Why Choose Setting
	=========================================*/
	$wp_customize->add_setting(
		'why_choose_options_setting_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'why_choose_options_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Why Choose Setting','desert-companion'),
			'section' => 'why_choose_options',
		)
	);

	// Hide/Show Setting
	$wp_customize->add_setting(
		'chromax_why_choose_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'chromax_why_choose_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'why_choose_options',
		)
	);
	
	/*=========================================
	Left Section
	=========================================*/
	$wp_customize->add_setting(
		'chromax_why_choose_left_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'chromax_why_choose_left_options',
		array(
			'type' => 'hidden',
			'label' => __('Left Content','chromax-pro'),
			'section' => 'why_choose_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'chromax_hs_why_choose_left' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_hs_why_choose_left', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'chromax-pro' ),
			'section'     => 'why_choose_options',
			'type'        => 'checkbox'
		) 
	);	
	
	
	//  Title // 
	$wp_customize->add_setting(
    	'chromax_why_choose_left_ttl',
    	array(
	        'default'			=> __('What we offer','chromax-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'chromax_why_choose_left_ttl',
		array(
		    'label'   => __('Title','chromax-pro'),
		    'section' => 'why_choose_options',
			'type'           => 'text',
		)  
	);
	
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'chromax_why_choose_left_subttl',
    	array(
	        'default'			=> __('Small Smart Business Grow Faster Now','chromax-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'chromax_why_choose_left_subttl',
		array(
		    'label'   => __('Subtitle','chromax-pro'),
		    'section' => 'why_choose_options',
			'type'           => 'text',
		)  
	);
	
	//  Text // 
	$wp_customize->add_setting(
    	'chromax_why_choose_left_text',
    	array(
	        'default'			=> __('It is a long established fact that a reader will be distracted the readable content of a page when looking at layout the point.','chromax-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'chromax_why_choose_left_text',
		array(
		    'label'   => __('Text','chromax-pro'),
		    'section' => 'why_choose_options',
			'type'           => 'textarea',
		)  
	);
	
	//  Image // 
    $wp_customize->add_setting( 
    	'chromax_why_choose_left_img' , 
    	array(
			'default' 			=> esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/why_choose01.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_url',	
			'priority' => 3,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'chromax_why_choose_left_img' ,
		array(
			'label'          => esc_html__( 'Image', 'chromax-pro'),
			'section'        => 'why_choose_options',
		) 
	));
	
	
	/*=========================================
	Right Section
	=========================================*/
	$wp_customize->add_setting(
		'chromax_why_choose_right_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 8,
		)
	);

	$wp_customize->add_control(
	'chromax_why_choose_right_options',
		array(
			'type' => 'hidden',
			'label' => __('Right Content','chromax-pro'),
			'section' => 'why_choose_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'chromax_hs_why_choose_right' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 9,
		) 
	);
	
	$wp_customize->add_control(
	'chromax_hs_why_choose_right', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'chromax-pro' ),
			'section'     => 'why_choose_options',
			'type'        => 'checkbox'
		) 
	);	
	 
	$wp_customize->add_setting( 'chromax_why_choose_right_option', 
		array(
		 'sanitize_callback' => 'chromax_repeater_sanitize',
		 'priority' => 9,
		 'default' => chromax_why_choose_options_default()
		)
	);
	
	$wp_customize->add_control( 
		new Chromax_Repeater( $wp_customize, 
			'chromax_why_choose_right_option', 
				array(
					'label'   => esc_html__('Why Choose','chromax-pro'),
					'section' => 'why_choose_options',
					'add_field_label'                   => esc_html__( 'Add New Why Choose', 'chromax-pro' ),
					'item_name'                         => esc_html__( 'Why Choose', 'chromax-pro' ),
					
					'customizer_repeater_title_control' => true,
					'customizer_repeater_text_control' => true,
					'customizer_repeater_link_control' => true,
					'customizer_repeater_icon_control' => true
				) 
			) 
		);
	
	// Upgrade
	$wp_customize->add_setting(
	'chromax_why_choose_right_option_upsale', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 9,
    ));
	
	$wp_customize->add_control( 
		new Desert_Companion_Customize_Upgrade_Control
		($wp_customize, 
			'chromax_why_choose_right_option_upsale', 
			array(
				'label'      => __( 'Why Choose', 'desert-companion' ),
				'section'    => 'why_choose_options'
			) 
		) 
	);	
	
	/*=========================================
	Why Choose Background
	=========================================*/
	$wp_customize->add_setting(
		'chromax_why_choose_bg'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 17,
		)
	);

	$wp_customize->add_control(
	'chromax_why_choose_bg',
		array(
			'type' => 'hidden',
			'label' => __('Background','chromax-pro'),
			'section' => 'why_choose_options',
		)
	);
	
	//  Image // 
    $wp_customize->add_setting( 
    	'chromax_why_choose_bg_img' , 
    	array(
			'default' 			=> esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/why_choose_us_bg.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_url',	
			'priority' => 17,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'chromax_why_choose_bg_img' ,
		array(
			'label'          => esc_html__( 'Background Image', 'chromax-pro'),
			'section'        => 'why_choose_options',
		) 
	));
}
add_action( 'customize_register', 'chromax_why_choose_customize_setting' );