<?php
function newsmunch_top_tags_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Top Tags Section Panel
	=========================================*/
	$wp_customize->add_panel(
		'newsmunch_frontpage_options', array(
			'priority' => 32,
			'title' => esc_html__( 'Theme Frontpage', 'newsmunch' ),
		)
	);
	
	$wp_customize->add_section(
		'top_tags_options', array(
			'title' => esc_html__( 'Top Tags & Latest Story Section', 'newsmunch' ),
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
			'label' => __('Top Tags & Latest Story Setting','newsmunch'),
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
			'label'	      => esc_html__( 'Hide/Show Top Tags?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Latest Story?', 'newsmunch' ),
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
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_display_top_tags' , 
		array(
			'label'          => __( 'Display Top Tags & Latest Story on', 'newsmunch' ),
			'section'        => 'top_tags_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'front' 	=> __( 'Front Page', 'newsmunch' ),
				'post' 	=> __( 'Post Page', 'newsmunch' ),
				'front_post' 	=> __( 'Front & Post Page', 'newsmunch' ),
			) 
		) 
	);
	
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_top_tags_ttl',
    	array(
	        'default'			=> __('Top Tags','newsmunch'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_top_tags_ttl',
		array(
		    'label'   => __('Top Tags Title','newsmunch'),
		    'section' => 'top_tags_options',
			'type'           => 'text',
		)  
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_hlatest_story_ttl',
    	array(
	        'default'			=> __('Latest Story','newsmunch'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_hlatest_story_ttl',
		array(
		    'label'   => __('Latest Story Title','newsmunch'),
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
	$wp_customize->add_control( new Newsmunch_Post_Category_Control( $wp_customize, 
	'newsmunch_hlatest_story_cat', 
		array(
		'label'   => __('Select Category','newsmunch'),
		'description'   => __('Posts to be shown on slider section','newsmunch'),
		'section' => 'top_tags_options',
		) 
	) );
		
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'newsmunch_top_tags_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 4,
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'newsmunch_top_tags_upsale', 
				array(
					'label'      => __( 'Top Tags Styles', 'newsmunch' ),
					'section'    => 'top_tags_options'
				) 
			) 
		);	
	}	
}
add_action( 'customize_register', 'newsmunch_top_tags_customize_setting' );