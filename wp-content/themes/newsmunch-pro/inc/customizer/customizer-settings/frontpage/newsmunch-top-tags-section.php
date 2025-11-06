<?php
function newsmunch_top_tags_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Top Tags Section Panel
	=========================================*/
	$wp_customize->add_panel(
		'newsmunch_frontpage_options', array(
			'priority' => 32,
			'title' => esc_html__( 'Theme Frontpage', 'newsmunch-pro' ),
		)
	);
	
	$wp_customize->add_section(
		'top_tags_options', array(
			'title' => esc_html__( 'Top Tags & Latest Story Section', 'newsmunch-pro' ),
			'panel' => 'newsmunch_frontpage_options',
			'priority' => 1,
		)
	);
	
	/*=========================================
	Top Tags Setting
	=========================================*/
	$wp_customize->add_setting(
		'top_tags_setting_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'top_tags_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Top Tags & Latest Story Setting','newsmunch-pro'),
			'section' => 'top_tags_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_top_tags' , 
			array(
			'default'     => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_top_tags', 
		array(
			'label'	      => esc_html__( 'Hide/Show Top Tags?', 'newsmunch-pro' ),
			'section'     => 'top_tags_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_hlatest_story' , 
			array(
			'default'     => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_hlatest_story', 
		array(
			'label'	      => esc_html__( 'Hide/Show Latest Story?', 'newsmunch-pro' ),
			'section'     => 'top_tags_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Display Top Tags
	$wp_customize->add_setting( 
		'newsmunch_display_top_tags' , 
			array(
			'default' => 'front_post',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_display_top_tags' , 
		array(
			'label'          => __( 'Display Top Tags & Latest Story on', 'newsmunch-pro' ),
			'section'        => 'top_tags_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'front' 	=> __( 'Front Page', 'newsmunch-pro' ),
				'post' 	=> __( 'Post Page', 'newsmunch-pro' ),
				'front_post' 	=> __( 'Front & Post Page', 'newsmunch-pro' ),
			) 
		) 
	);
	
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_top_tags_ttl',
    	array(
	        'default'			=> __('Top Tags','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_top_tags_ttl',
		array(
		    'label'   => __('Top Tags Title','newsmunch-pro'),
		    'section' => 'top_tags_options',
			'type'           => 'text',
		)  
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_hlatest_story_ttl',
    	array(
	        'default'			=> __('Latest Story','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_hlatest_story_ttl',
		array(
		    'label'   => __('Latest Story Title','newsmunch-pro'),
		    'section' => 'top_tags_options',
			'type'           => 'text',
		)  
	);
	
	
	// Select Blog Category
	$wp_customize->add_setting(
    'newsmunch_hlatest_story_cat',
		array(
		'default'	      => '0',	
		'capability' => 'edit_theme_options',
		'priority' => 4,
		'sanitize_callback' => 'absint'
		)
	);	
	$wp_customize->add_control( new Category_Dropdown_Custom_Control( $wp_customize, 
	'newsmunch_hlatest_story_cat', 
		array(
		'label'   => __('Select Category','newsmunch-pro'),
		'description'   => __('Posts to be shown on slider section','newsmunch-pro'),
		'section' => 'top_tags_options',
		) 
	) );
	
	/*=========================================
	Top Tags After Before
	=========================================*/
	$wp_customize->add_setting(
		'top_tags_option_before_after'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'top_tags_option_before_after',
		array(
			'type' => 'hidden',
			'label' => __('Before / After Content','newsmunch-pro'),
			'section' => 'top_tags_options',
		)
	);
	
	// Before
	$wp_customize->add_setting(
	'newsmunch_top_tags_option_before',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 13,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_top_tags_option_before',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For Before Section','newsmunch-pro'),
			'section'	=> 'top_tags_options',
		)
	);	
	
	// After
	$wp_customize->add_setting(
	'newsmunch_top_tags_option_after',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 14,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_top_tags_option_after',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For After Section','newsmunch-pro'),
			'section'	=> 'top_tags_options',
		)
	);	
}
add_action( 'customize_register', 'newsmunch_top_tags_customize_setting' );