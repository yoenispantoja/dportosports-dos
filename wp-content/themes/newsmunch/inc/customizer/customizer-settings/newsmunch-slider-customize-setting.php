<?php
function newsmunch_slider_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Slider Section Panel
	=========================================*/
	$wp_customize->add_section(
		'slider_options', array(
			'title' => esc_html__( 'Slider Section', 'newsmunch' ),
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
			'label' => __('Slider Setting','newsmunch'),
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
			'label'	      => esc_html__( 'Hide/Show?', 'newsmunch' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
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
			'label'          => __( 'Display Slider on', 'newsmunch' ),
			'section'        => 'slider_options',
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
			'label' => __('Slider Content Left','newsmunch'),
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
			'label'	      => esc_html__( 'Hide/Show Slider Left?', 'newsmunch' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);	
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_slider_ttl',
    	array(
	        'default'			=> __('Main Story','newsmunch'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 1,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_slider_ttl',
		array(
		    'label'   => __('Title','newsmunch'),
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
	$wp_customize->add_control( new Newsmunch_Post_Category_Control( $wp_customize, 
	'newsmunch_slider_cat', 
		array(
		'label'   => __('Select Category','newsmunch'),
		'description'   => __('Posts to be shown on slider section','newsmunch'),
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
			'label'	      => esc_html__( 'Hide/Show Title?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Category?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Author?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Date?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Comment?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Views?', 'newsmunch' ),
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
				'label'      => __( 'Number of Slides', 'newsmunch' ),
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
			'label' => __('Slider Content Middle','newsmunch'),
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
			'label'	      => esc_html__( 'Hide/Show Slider Middle?', 'newsmunch' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_slider_mdl_ttl',
    	array(
	        'default'			=> __('Today Post','newsmunch'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 11,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_slider_mdl_ttl',
		array(
		    'label'   => __('Title','newsmunch'),
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
	$wp_customize->add_control( new Newsmunch_Post_Category_Control( $wp_customize, 
	'newsmunch_slider_mdl_cat', 
		array(
		'label'   => __('Select Category','newsmunch'),
		'description'   => __('Posts to be shown on Left','newsmunch'),
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
			'label'	      => esc_html__( 'Hide/Show Title?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Category?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Author?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Date?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Comment?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Views?', 'newsmunch' ),
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
				'label'      => __( 'Number of Post', 'newsmunch' ),
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
			'label' => __('Slider Content Right','newsmunch'),
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
			'label'	      => esc_html__( 'Hide/Show Tab Post?', 'newsmunch' ),
			'section'     => 'slider_options',
			'type'        => 'checkbox'
		) 
	);

	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_slider_right_ttl',
    	array(
	        'default'			=> __('Today Update','newsmunch'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 11,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_slider_right_ttl',
		array(
		    'label'   => __('Title','newsmunch'),
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
	$wp_customize->add_control( new Newsmunch_Post_Category_Control( $wp_customize, 
	'newsmunch_tabfirst_cat', 
		array(
		'label'   => __('Select Category For 1','newsmunch'),
		'description'   => __('Posts to be shown on 1','newsmunch'),
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
	$wp_customize->add_control( new Newsmunch_Post_Category_Control( $wp_customize, 
	'newsmunch_tabsecond_cat', 
		array(
		'label'   => __('Select Category For 2','newsmunch'),
		'description'   => __('Posts to be shown on 2','newsmunch'),
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
	$wp_customize->add_control( new Newsmunch_Post_Category_Control( $wp_customize, 
	'newsmunch_tabthird_cat', 
		array(
		'label'   => __('Select Category For 3','newsmunch'),
		'description'   => __('Posts to be shown on 3','newsmunch'),
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
			'label'	      => esc_html__( 'Hide/Show Title?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Category?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Date?', 'newsmunch' ),
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
				'label'      => __( 'Number of Post in Tab', 'newsmunch' ),
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
			'label' => __('Background','newsmunch'),
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
			'label'          => esc_html__( 'Background Image', 'newsmunch'),
			'section'        => 'slider_options',
		) 
	));
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'newsmunch_slider_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 12,
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'newsmunch_slider_option_upsale', 
				array(
					'label'      => __( 'Slider Types', 'newsmunch' ),
					'section'    => 'slider_options'
				) 
			) 
		);	
	}
}
add_action( 'customize_register', 'newsmunch_slider_customize_setting' );