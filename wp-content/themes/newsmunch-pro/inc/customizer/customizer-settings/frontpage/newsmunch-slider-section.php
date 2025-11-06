<?php
function newsmunch_slider_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Slider Section Panel
	=========================================*/
	
	$wp_customize->add_section(
		'slider_options', array(
			'title' => esc_html__( 'Slider Section', 'newsmunch-pro' ),
			'panel' => 'newsmunch_frontpage_options',
			'priority' => 1,
		)
	);
	
	/*=========================================
	Slider Setting
	=========================================*/
	$wp_customize->add_setting(
		'slider_setting_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'slider_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('Slider Setting','newsmunch-pro'),
			'section' => 'slider_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider', 
		array(
			'label'	      => esc_html__( 'Hide/Show?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Slider Type
	$wp_customize->add_setting( 
		'newsmunch_slider_right_type' , 
			array(
			'default' => 'style-1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_slider_right_type' , 
		array(
			'label'          => __( 'Slider Style', 'newsmunch-pro' ),
			'section'        => 'slider_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'style-1' 	=> __( 'Style 1', 'newsmunch-pro' ),
				'style-2' 	=> __( 'Style 2', 'newsmunch-pro' ),
				'style-3' 	=> __( 'Style 3', 'newsmunch-pro' ),
				// 'style-4' 	=> __( 'Style 4', 'newsmunch-pro' ),
				// 'style-5' 	=> __( 'Style 5', 'newsmunch-pro' ),
				// 'style-6' 	=> __( 'Style 6', 'newsmunch-pro' ),
				// 'style-7' 	=> __( 'Style 7', 'newsmunch-pro' )
			) 
		) 
	);
	
	// Display Slider
	$wp_customize->add_setting( 
		'newsmunch_display_slider' , 
			array(
			'default' => 'front_post',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 1,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_display_slider' , 
		array(
			'label'          => __( 'Display Slider on', 'newsmunch-pro' ),
			'section'        => 'slider_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'front' 	=> __( 'Front Page', 'newsmunch-pro' ),
				'post' 	=> __( 'Post Page', 'newsmunch-pro' ),
				'front_post' 	=> __( 'Front & Post Page', 'newsmunch-pro' ),
			) 
		) 
	);
	
	//  Slider Position
	$wp_customize->add_setting( 
		'newsmunch_slider_position' , 
			array(
			'default' => 'left',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_slider_position' , 
		array(
			'label'          => __( 'Slider Position', 'newsmunch-pro' ),
			'section'        => 'slider_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left' 	=> __( 'Left', 'newsmunch-pro' ),
				'right' 	=> __( 'Right', 'newsmunch-pro' ),
			) 
		) 
	);
	
	
	
	/*=========================================
	Slider Content Left
	=========================================*/
	$wp_customize->add_setting(
		'slider_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'slider_options_head',
		array(
			'type' => 'hidden',
			'label' => __('Slider Content Left','newsmunch-pro'),
			'section' => 'slider_options',
		)
	);
	 
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_left' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_left', 
		array(
			'label'	      => esc_html__( 'Hide/Show Slider Left?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Slider Type
	$wp_customize->add_setting( 
		'newsmunch_slider_type' , 
			array(
			'default' => 'lg',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_slider_type' , 
		array(
			'label'          => __( 'Slider Size', 'newsmunch-pro' ),
			'section'        => 'slider_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'lg' 	=> __( 'Large', 'newsmunch-pro' ),
				'md' 	=> __( 'Medium', 'newsmunch-pro' ),
				'xl' 	=> __( 'Extra Large', 'newsmunch-pro' ),
			) 
		) 
	);
	
	
	// Slider Column
	$wp_customize->add_setting( 
		'newsmunch_slider_column' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_slider_column' , 
		array(
			'label'          => __( 'Slider Column', 'newsmunch-pro' ),
			'section'        => 'slider_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'1' 	=> __( '1 Column', 'newsmunch-pro' ),
				'2' 	=> __( '2 Column', 'newsmunch-pro' ),
				'3' 	=> __( '3 Column', 'newsmunch-pro' ),
			) 
		) 
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_slider_ttl',
    	array(
	        'default'			=> __('Main Story','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 1,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_slider_ttl',
		array(
		    'label'   => __('Title','newsmunch-pro'),
		    'section' => 'slider_options',
			'type'           => 'text',
		)  
	);
	
	// Select Blog Category
	$wp_customize->add_setting(
    'newsmunch_slider_cat',
		array(
		'default'	      => '0',	
		'capability' => 'edit_theme_options',
		'priority' => 4,
		'sanitize_callback' => 'absint'
		)
	);	
	$wp_customize->add_control( new Category_Dropdown_Custom_Control( $wp_customize, 
	'newsmunch_slider_cat', 
		array(
		'label'   => __('Select Category','newsmunch-pro'),
		'description'   => __('Posts to be shown on slider section','newsmunch-pro'),
		'section' => 'slider_options',
		) 
	) );
	
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_title' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_title', 
		array(
			'label'	      => esc_html__( 'Hide/Show Title?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_cat_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_cat_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Category?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_auth_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_auth_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Author?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_date_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_date_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Date?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_comment_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_comment_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Comment?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_views_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_views_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Views?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	// No. of Slides
	if ( class_exists( 'NewsMunch_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'newsmunch_num_slides',
			array(
				'default' => '6',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'priority' => 11,
			)
		);
		$wp_customize->add_control( 
		new NewsMunch_Customizer_Range_Control( $wp_customize, 'newsmunch_num_slides', 
			array(
				'label'      => __( 'Number of Slides', 'newsmunch-pro' ),
				'section'  => 'slider_options',
				 'media_query'   => false,
					'input_attr'    => array(
						'desktop' => array(
							'min'           => 1,
							'max'           => 100,
							'step'          => 1,
							'default_value' => 6,
						),
					),
			) ) 
		);
	}
	
	
	/*=========================================
	Slider Content Middle
	=========================================*/
	$wp_customize->add_setting(
		'slider_mdl_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 11,
		)
	);

	$wp_customize->add_control(
	'slider_mdl_options_head',
		array(
			'type' => 'hidden',
			'label' => __('Slider Content Middle','newsmunch-pro'),
			'section' => 'slider_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_mdl' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_mdl', 
		array(
			'label'	      => esc_html__( 'Hide/Show Slider Middle?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_slider_mdl_ttl',
    	array(
	        'default'			=> __('Today Post','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 11,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_slider_mdl_ttl',
		array(
		    'label'   => __('Title','newsmunch-pro'),
		    'section' => 'slider_options',
			'type'           => 'text',
		)  
	);
	
	// Select Blog Category
	$wp_customize->add_setting(
    'newsmunch_slider_mdl_cat',
		array(
		'default'	      => '0',	
		'capability' => 'edit_theme_options',
		'priority' => 11,
		'sanitize_callback' => 'absint'
		)
	);	
	$wp_customize->add_control( new Category_Dropdown_Custom_Control( $wp_customize, 
	'newsmunch_slider_mdl_cat', 
		array(
		'label'   => __('Select Category','newsmunch-pro'),
		'description'   => __('Posts to be shown on Left','newsmunch-pro'),
		'section' => 'slider_options',
		) 
	) );
	
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_mdl_title' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_mdl_title', 
		array(
			'label'	      => esc_html__( 'Hide/Show Title?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_mdl_cat_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_mdl_cat_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Category?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_mdl_auth_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_mdl_auth_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Author?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_mdl_date_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_mdl_date_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Date?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_mdl_comment_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_mdl_comment_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Comment?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_mdl_views_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_mdl_views_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Views?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	// No. of Slides
	if ( class_exists( 'NewsMunch_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'newsmunch_num_slides_mdl_tab',
			array(
				'default' => '2',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'priority' => 11,
			)
		);
		$wp_customize->add_control( 
		new NewsMunch_Customizer_Range_Control( $wp_customize, 'newsmunch_num_slides_mdl_tab', 
			array(
				'label'      => __( 'Number of Post', 'newsmunch-pro' ),
				'section'  => 'slider_options',
				 'media_query'   => false,
					'input_attr'    => array(
						'desktop' => array(
							'min'           => 1,
							'max'           => 10,
							'step'          => 1,
							'default_value' => 2,
						),
					),
			) ) 
		);
	}
	
	/*=========================================
	Slider Content Right
	=========================================*/
	$wp_customize->add_setting(
		'slider_right_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'slider_right_options_head',
		array(
			'type' => 'hidden',
			'label' => __('Slider Content Right','newsmunch-pro'),
			'section' => 'slider_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_right' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 12,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_right', 
		array(
			'label'	      => esc_html__( 'Hide/Show Tab Post?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);

	
	// Tab Count
	$wp_customize->add_setting( 
		'newsmunch_slider_right_tab_count' , 
			array(
			'default' => '3',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 11,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_slider_right_tab_count' , 
		array(
			'label'          => __( 'Tab Count', 'newsmunch-pro' ),
			'section'        => 'slider_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'1' 	=> __( '1 Tab', 'newsmunch-pro' ),
				'2' 	=> __( '2 Tab', 'newsmunch-pro' ),
				'3' 	=> __( '3 Tab', 'newsmunch-pro' ),
			) 
		) 
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_slider_right_ttl',
    	array(
	        'default'			=> __('Today Update','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 11,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_slider_right_ttl',
		array(
		    'label'   => __('Title','newsmunch-pro'),
		    'section' => 'slider_options',
			'type'           => 'text',
		)  
	);
	
	// Select Blog Category
	$wp_customize->add_setting(
    'newsmunch_tabfirst_cat',
		array(
		'default'	      => '0',	
		'capability' => 'edit_theme_options',
		'priority' => 12,
		'sanitize_callback' => 'absint'
		)
	);	
	$wp_customize->add_control( new Category_Dropdown_Custom_Control( $wp_customize, 
	'newsmunch_tabfirst_cat', 
		array(
		'label'   => __('Select Category For 1','newsmunch-pro'),
		'description'   => __('Posts to be shown on 1','newsmunch-pro'),
		'section' => 'slider_options',
		) 
	) );
	
	// Select Blog Category
	$wp_customize->add_setting(
    'newsmunch_tabsecond_cat',
		array(
		'default'	      => '0',	
		'capability' => 'edit_theme_options',
		'priority' => 12,
		'sanitize_callback' => 'absint'
		)
	);	
	$wp_customize->add_control( new Category_Dropdown_Custom_Control( $wp_customize, 
	'newsmunch_tabsecond_cat', 
		array(
		'label'   => __('Select Category For 2','newsmunch-pro'),
		'description'   => __('Posts to be shown on 2','newsmunch-pro'),
		'section' => 'slider_options',
		) 
	) );
	
	// Select Blog Category
	$wp_customize->add_setting(
    'newsmunch_tabthird_cat',
		array(
		'default'	      => '0',	
		'capability' => 'edit_theme_options',
		'priority' => 12,
		'sanitize_callback' => 'absint'
		)
	);	
	$wp_customize->add_control( new Category_Dropdown_Custom_Control( $wp_customize, 
	'newsmunch_tabthird_cat', 
		array(
		'label'   => __('Select Category For 3','newsmunch-pro'),
		'description'   => __('Posts to be shown on 3','newsmunch-pro'),
		'section' => 'slider_options',
		) 
	) );
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_tab_title' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 12,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_tab_title', 
		array(
			'label'	      => esc_html__( 'Hide/Show Title?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_tab_cat_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 12,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_tab_cat_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Category?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_slider_tab_date_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 12,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_slider_tab_date_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Date?', 'newsmunch-pro' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	// No. of Slides
	if ( class_exists( 'NewsMunch_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'newsmunch_num_slides_tab',
			array(
				'default' => '5',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'priority' => 11,
			)
		);
		$wp_customize->add_control( 
		new NewsMunch_Customizer_Range_Control( $wp_customize, 'newsmunch_num_slides_tab', 
			array(
				'label'      => __( 'Number of Post in Tab', 'newsmunch-pro' ),
				'section'  => 'slider_options',
				 'media_query'   => false,
					'input_attr'    => array(
						'desktop' => array(
							'min'           => 1,
							'max'           => 10,
							'step'          => 1,
							'default_value' => 5,
						),
					),
			) ) 
		);
	}
	
	
	/*=========================================
	Slider Background
	=========================================*/
	$wp_customize->add_setting(
		'slider_option_bg_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'slider_option_bg_head',
		array(
			'type' => 'hidden',
			'label' => __('Background','newsmunch-pro'),
			'section' => 'slider_options',
		)
	);
	
	//  Image // 
    $wp_customize->add_setting( 
    	'newsmunch_slider_bg_img' , 
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_url',	
			'priority' => 12,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'newsmunch_slider_bg_img' ,
		array(
			'label'          => esc_html__( 'Background Image', 'newsmunch-pro'),
			'section'        => 'slider_options',
		) 
	));
	
	/*=========================================
	Slider After Before
	=========================================*/
	$wp_customize->add_setting(
		'slider_option_before_after'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'slider_option_before_after',
		array(
			'type' => 'hidden',
			'label' => __('Before / After Content','newsmunch-pro'),
			'section' => 'slider_options',
		)
	);
	
	
	// Before
	$wp_customize->add_setting(
	'newsmunch_slider_option_before',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 13,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_slider_option_before',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For Before Section','newsmunch-pro'),
			'section'	=> 'slider_options',
		)
	);	
	
	// After
	$wp_customize->add_setting(
	'newsmunch_slider_option_after',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 14,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_slider_option_after',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For After Section','newsmunch-pro'),
			'section'	=> 'slider_options',
		)
	);
}
add_action( 'customize_register', 'newsmunch_slider_customize_setting' );