<?php
function newsmunch_featured_link_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Featured Link Section Panel
	=========================================*/
	$wp_customize->add_section(
		'featured_link_options', array(
			'title' => esc_html__( 'Featured Link Section', 'newsmunch' ),
			'panel' => 'newsmunch_frontpage_options',
			'priority' => 1,
		)
	);
	
	/*=========================================
	Featured Link Setting
	=========================================*/
	$wp_customize->add_setting(
		'featured_link_setting_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'featured_link_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Featured Link Setting','newsmunch'),
			'section' => 'featured_link_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_featured_link' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_featured_link', 
		array(
			'label'	      => esc_html__( 'Hide/Show?', 'newsmunch' ),
			'section'     => 'featured_link_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Display Featured Link
	$wp_customize->add_setting( 
		'newsmunch_display_featured_link' , 
			array(
			'default' => 'front_post',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 1,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_display_featured_link' , 
		array(
			'label'          => __( 'Display Featured Link on', 'newsmunch' ),
			'section'        => 'featured_link_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'front' 	=> __( 'Front Page', 'newsmunch' ),
				'post' 	=> __( 'Post Page', 'newsmunch' ),
				'front_post' 	=> __( 'Front & Post Page', 'newsmunch' ),
			) 
		) 
	);
	
	/*=========================================
	Featured Link Content
	=========================================*/
	$wp_customize->add_setting(
		'featured_link_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'featured_link_options_head',
		array(
			'type' => 'hidden',
			'label' => __('Featured Link Content','newsmunch'),
			'section' => 'featured_link_options',
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_featured_link_ttl',
    	array(
	        'default'			=> __('Featured Story','newsmunch'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_featured_link_ttl',
		array(
		    'label'   => __('Title','newsmunch'),
		    'section' => 'featured_link_options',
			'type'           => 'text',
		)  
	);
	
	// Select Blog Category
	$wp_customize->add_setting(
    'newsmunch_featured_link_cat',
		array(
		'default'	      => '0',	
		'capability' => 'edit_theme_options',
		'priority' => 4,
		'sanitize_callback' => 'absint'
		)
	);	
	$wp_customize->add_control( new Newsmunch_Post_Category_Control( $wp_customize, 
	'newsmunch_featured_link_cat', 
		array(
		'label'   => __('Select Post Category','newsmunch'),
		'description'   => __('Posts to be shown on slider section','newsmunch'),
		'section' => 'featured_link_options',
		) 
	) );
	
	
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_featured_link_title' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_featured_link_title', 
		array(
			'label'	      => esc_html__( 'Hide/Show Title?', 'newsmunch' ),
			'section'     => 'featured_link_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_featured_link_cat_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_featured_link_cat_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Category?', 'newsmunch' ),
			'section'     => 'featured_link_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_featured_link_auth_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_featured_link_auth_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Author?', 'newsmunch' ),
			'section'     => 'featured_link_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_featured_link_date_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_featured_link_date_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Date?', 'newsmunch' ),
			'section'     => 'featured_link_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_featured_link_comment_meta' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_featured_link_comment_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Comment?', 'newsmunch' ),
			'section'     => 'featured_link_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_featured_link_views_meta' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_featured_link_views_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Views?', 'newsmunch' ),
			'section'     => 'featured_link_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_featured_link_pf_icon' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_featured_link_pf_icon', 
		array(
			'label'	      => esc_html__( 'Hide/Show Post Format Icon?', 'newsmunch' ),
			'section'     => 'featured_link_options',
			'type'        => 'checkbox'
		) 
	);
	
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'newsmunch_featured_link_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 2,
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'newsmunch_featured_link_option_upsale', 
				array(
					'label'      => __( 'Featured Types', 'newsmunch' ),
					'section'    => 'featured_link_options'
				) 
			) 
		);
	}
	
	/*=========================================
	Featured Link After Before
	=========================================*/
	$wp_customize->add_setting(
		'featured_link_option_before_after'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'featured_link_option_before_after',
		array(
			'type' => 'hidden',
			'label' => __('Before / After Content','newsmunch'),
			'section' => 'featured_link_options',
		)
	);
	
	// Before
	$wp_customize->add_setting(
	'newsmunch_featured_link_option_before',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 13,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_featured_link_option_before',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For Before Section','newsmunch'),
			'section'	=> 'featured_link_options',
		)
	);	
	
	// After
	$wp_customize->add_setting(
	'newsmunch_featured_link_option_after',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 14,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_featured_link_option_after',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For After Section','newsmunch'),
			'section'	=> 'featured_link_options',
		)
	);
}
add_action( 'customize_register', 'newsmunch_featured_link_customize_setting' );