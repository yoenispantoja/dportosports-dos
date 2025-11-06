<?php
function newsmunch_theme_options_customize( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'newsmunch_theme_options', array(
			'priority' => 31,
			'title' => esc_html__( 'Theme Options', 'newsmunch-pro' ),
		)
	);
	
	/*=========================================
	Header Image
	=========================================*/
	$wp_customize->add_section(
		'header_image', array(
			'title' => esc_html__( 'Header Image', 'newsmunch-pro' ),
			'priority' => 1,
			'panel' => 'newsmunch_theme_options',
		)
	);
	
	/*=========================================
	General Options
	=========================================*/
	$wp_customize->add_section(
		'site_general_options', array(
			'title' => esc_html__( 'General Options', 'newsmunch-pro' ),
			'priority' => 1,
			'panel' => 'newsmunch_theme_options',
		)
	);
	
	
	/*=========================================
	Preloader
	=========================================*/
	// Heading
	$wp_customize->add_setting(
		'newsmunch_preloader_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_preloader_option',
		array(
			'type' => 'hidden',
			'label' => __('Site Preloader','newsmunch-pro'),
			'section' => 'site_general_options',
		)
	);
	
	
	// Hide/ Show
	$wp_customize->add_setting( 
		'newsmunch_hs_preloader_option' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 1,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_preloader_option', 
		array(
			'label'	      => esc_html__( 'Hide / Show Preloader', 'newsmunch-pro' ),
			'section'     => 'site_general_options',
			'type'        => 'checkbox'
		) 
	);
	
	
	
	/*=========================================
	NewsMunch Container
	=========================================*/
	// Heading
	$wp_customize->add_setting(
		'newsmunch_site_container_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 6,
		)
	);

	$wp_customize->add_control(
	'newsmunch_site_container_option',
		array(
			'type' => 'hidden',
			'label' => __('Site Container','newsmunch-pro'),
			'section' => 'site_general_options',
		)
	);
	
	if ( class_exists( 'NewsMunch_Customizer_Range_Control' ) ) {
		//container width
		$wp_customize->add_setting(
			'newsmunch_site_container_width',
			array(
				'default'			=> '2000',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'transport'         => 'postMessage',
				'priority'      => 6,
			)
		);
		$wp_customize->add_control( 
		new NewsMunch_Customizer_Range_Control( $wp_customize, 'newsmunch_site_container_width', 
			array(
				'label'      => __( 'Container Width', 'newsmunch-pro' ),
				'section'  => 'site_general_options',
				 'media_query'   => false,
                'input_attr'    => array(
                    'desktop' => array(
                        'min'           => 768,
                        'max'           => 2000,
                        'step'          => 1,
                        'default_value' => 2000,
                    ),
                ),
			) ) 
		);
	}
	
	/*=========================================
	Scroller
	=========================================*/
	//Heading
	$wp_customize->add_setting(
		'newsmunch_scroller_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'newsmunch_scroller_option',
		array(
			'type' => 'hidden',
			'label' => __('Top Scroller','newsmunch-pro'),
			'section' => 'site_general_options'
		)
	);
	
	//Hide/show
	$wp_customize->add_setting( 
		'newsmunch_hs_scroller_option' , 
			array(
			'default' => '0',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 7,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_scroller_option', 
		array(
			'label'	      => esc_html__( 'Hide / Show Scroller', 'newsmunch-pro' ),
			'section'     => 'site_general_options',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	NewsMunch Button Styles
	=========================================*/
	
	//  Button Style // 
	// $wp_customize->add_setting(
		// 'newsmunch_btn_style_head'
			// ,array(
			// 'capability'     	=> 'edit_theme_options',
			// 'sanitize_callback' => 'newsmunch_sanitize_text',
			// 'priority' => 7,
		// )
	// );

	// $wp_customize->add_control(
	// 'newsmunch_btn_style_head',
		// array(
			// 'type' => 'hidden',
			// 'label' => __('Button Style','newsmunch-pro'),
			// 'section' => 'site_general_options',
		// )
	// );
	
	// Button Style
	// $wp_customize->add_setting( 
		// 'newsmunch_btn_style' , 
			// array(
			// 'default' => 'btn--effect-one',
			// 'capability'     => 'edit_theme_options',
			// 'sanitize_callback' => 'newsmunch_sanitize_text',
			// 'priority' => 8,
		// ) 
	// );

	// $wp_customize->add_control(
	// 'newsmunch_btn_style' , 
		// array(
			// 'label'          => __( 'Button Effect', 'newsmunch-pro' ),
			// 'section'        => 'site_general_options',
			// 'type'           => 'select',
			// 'choices'        => 
			// array(
				// 'btn--effect-none' 	=> __( 'None', 'newsmunch-pro' ),
				// 'btn--effect-one' 	=> __( 'One', 'newsmunch-pro' ),
			// ) 
		// ) 
	// );

	/*=========================================
	NewsMunch Heading Styles
	=========================================*/
	
	//  Heading Style // 
	$wp_customize->add_setting(
		'newsmunch_heading_style_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'newsmunch_heading_style_head',
		array(
			'type' => 'hidden',
			'label' => __('Heading Style','newsmunch-pro'),
			'section' => 'site_general_options',
		)
	);
	
	// Heading Style
	$wp_customize->add_setting( 
		'newsmunch_heading_style' , 
			array(
			'default' => 'dt-section--title-one',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 8,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_heading_style' , 
		array(
			'label'          => __( 'Heading Style', 'newsmunch-pro' ),
			'section'        => 'site_general_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'dt-section--title-one' 	=> __( 'One', 'newsmunch-pro' ),
				'dt-section--title-two' 	=> __( 'Two', 'newsmunch-pro' ),
				'dt-section--title-three' 	=> __( 'Three', 'newsmunch-pro' ),
				'dt-section--title-four' 	=> __( 'Four', 'newsmunch-pro' ),
				'dt-section--title-five' 	=> __( 'Five', 'newsmunch-pro' ),
			) 
		) 
	);	
	
	/*=========================================
	NewsMunch Search Result
	=========================================*/
	
	//  Head // 
	$wp_customize->add_setting(
		'newsmunch_search_result_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'newsmunch_search_result_head',
		array(
			'type' => 'hidden',
			'label' => __('Search Result','newsmunch-pro'),
			'section' => 'site_general_options',
		)
	);
	
	//  Style
	$wp_customize->add_setting( 
		'newsmunch_search_result' , 
			array(
			'default' => 'post',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 8,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_search_result' , 
		array(
			'label'          => __( 'Search Result Page will Show ?', 'newsmunch-pro' ),
			'section'        => 'site_general_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'post' 	=> __( 'Posts', 'newsmunch-pro' ),
				'product' 	=> __( 'WooCommerce Products', 'newsmunch-pro' ),
			) 
		) 
	);
	
	
	/*=========================================
	NewsMunch Dark
	=========================================*/
	
	//  Head // 
	$wp_customize->add_setting(
		'newsmunch_dark_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'newsmunch_dark_head',
		array(
			'type' => 'hidden',
			'label' => __('Light/Dark Style','newsmunch-pro'),
			'section' => 'site_general_options',
		)
	);
	
	//  Style
	$wp_customize->add_setting( 
		'newsmunch_dark_mode' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 8,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_dark_mode' , 
		array(
			'label'          => __( 'Select Light or  Dark Mode ?', 'newsmunch-pro' ),
			'section'        => 'site_general_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'' 	=> __( 'Light', 'newsmunch-pro' ),
				'dark' 	=> __( 'Dark', 'newsmunch-pro' ),
			) 
		) 
	);


	/*=========================================
	Background Animate
	=========================================*/
	//Heading
	$wp_customize->add_setting(
		'newsmunch_background_animate_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'newsmunch_background_animate_option',
		array(
			'type' => 'hidden',
			'label' => __('Background Animate','newsmunch-pro'),
			'section' => 'site_general_options'
		)
	);
	
	//Hide/show
	$wp_customize->add_setting( 
		'newsmunch_hs_background_animate_option' , 
			array(
			'default' => '',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 7,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_background_animate_option', 
		array(
			'label'	      => esc_html__( 'Hide / Show Background Animate', 'newsmunch-pro' ),
			'section'     => 'site_general_options',
			'type'        => 'checkbox'
		) 
	);
	
	
	/*=========================================
	Breadcrumb  Section
	=========================================*/
	$wp_customize->add_section(
		'newsmunch_site_breadcrumb', array(
			'title' => esc_html__( 'Site Breadcrumb', 'newsmunch-pro' ),
			'priority' => 12,
			'panel' => 'newsmunch_theme_options',
		)
	);
	
	// Heading
	$wp_customize->add_setting(
		'newsmunch_site_breadcrumb_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_site_breadcrumb_option',
		array(
			'type' => 'hidden',
			'label' => __('Settings','newsmunch-pro'),
			'section' => 'newsmunch_site_breadcrumb',
		)
	);
	
	// Breadcrumb Hide/ Show Setting // 
	$wp_customize->add_setting( 
		'newsmunch_hs_site_breadcrumb' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_site_breadcrumb', 
		array(
			'label'	      => esc_html__( 'Hide / Show Section', 'newsmunch-pro' ),
			'section'     => 'newsmunch_site_breadcrumb',
			'type'        => 'checkbox'
		) 
	);
	
	// Breadcrumb Content Section // 
	$wp_customize->add_setting(
		'newsmunch_site_breadcrumb_content'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
	'newsmunch_site_breadcrumb_content',
		array(
			'type' => 'hidden',
			'label' => __('Content','newsmunch-pro'),
			'section' => 'newsmunch_site_breadcrumb',
		)
	);
	
	
	// Type
	$wp_customize->add_setting( 
		'newsmunch_breadcrumb_type' , 
			array(
			'default' => 'theme',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 5,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_breadcrumb_type' , 
		array(
			'label'          => __( 'Select Breadcrumb Type', 'newsmunch-pro' ),
			'description'          => __( 'You need to install and activate the respected plugin to show their Breadcrumb. Otherwise, your default theme Breadcrumb will appear. If you see error in search console, then we recommend to use plugin Breadcrumb.', 'newsmunch-pro' ),
			'section'        => 'newsmunch_site_breadcrumb',
			'type'           => 'select',
			'choices'        => 
			array(
				'theme' 	=> __( 'Theme Default 1', 'newsmunch-pro' ),
				'theme2' 	=> __( 'Theme Default 2', 'newsmunch-pro' ),
				'theme3' 	=> __( 'Theme Default 3', 'newsmunch-pro' ),
				'yoast' 	=> __( 'Yoast Plugin', 'newsmunch-pro' ),
				'rankmath' 	=> __( 'Rank Math Plugin', 'newsmunch-pro' ),
				'navxt' 	=> __( 'NavXT Plugin', 'newsmunch-pro' ),
			) 
		) 
	);
	
	// Typography
	$wp_customize->add_setting(
		'newsmunch_breadcrumb_typography'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority'  => 13,
		)
	);

	$wp_customize->add_control(
	'newsmunch_breadcrumb_typography',
		array(
			'type' => 'hidden',
			'label' => __('Typography','newsmunch-pro'),
			'section' => 'newsmunch_site_breadcrumb',
		)
	);
	
	if ( class_exists( 'NewsMunch_Customizer_Range_Control' ) ) {
	// Title size // 
	$wp_customize->add_setting(
    	'newsmunch_breadcrumb_title_size',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_range_value',
			'transport'         => 'postMessage',
			'priority'  => 14,
		)
	);
	$wp_customize->add_control( 
	new NewsMunch_Customizer_Range_Control( $wp_customize, 'newsmunch_breadcrumb_title_size', 
		array(
			'label'      => __( 'Title Font Size', 'newsmunch-pro' ),
			'section'  => 'newsmunch_site_breadcrumb',
			'media_query'   => true,
			'input_attr'    => array(
				'mobile'  => array(
					'min'           => 0,
					'max'           => 60,
					'step'          => 1,
					'default_value' => 30,
				),
				'tablet'  => array(
					'min'           => 0,
					'max'           => 60,
					'step'          => 1,
					'default_value' => 30,
				),
				'desktop' => array(
					'min'           => 0,
					'max'           => 60,
					'step'          => 1,
					'default_value' => 30,
				),
			),
		) ) 
	);
	// Content size // 
	$wp_customize->add_setting(
    	'newsmunch_breadcrumb_content_size',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_range_value',
			'transport'         => 'postMessage',
			'priority'  => 15,
		)
	);
	$wp_customize->add_control( 
	new NewsMunch_Customizer_Range_Control( $wp_customize, 'newsmunch_breadcrumb_content_size', 
		array(
			'label'      => __( 'Content Font Size', 'newsmunch-pro' ),
			'section'  => 'newsmunch_site_breadcrumb',
			'media_query'   => true,
			'input_attr'    => array(
				'mobile'  => array(
					'min'           => 0,
					'max'           => 50,
					'step'          => 1,
					'default_value' => 15,
				),
				'tablet'  => array(
					'min'           => 0,
					'max'           => 50,
					'step'          => 1,
					'default_value' => 15,
				),
				'desktop' => array(
					'min'           => 0,
					'max'           => 50,
					'step'          => 1,
					'default_value' => 15,
				),
			),
		) ) 
	);
	}
	
	
	
	/*=========================================
	NewsMunch Sidebar
	=========================================*/
	$wp_customize->add_section(
        'newsmunch_sidebar_options',
        array(
        	'priority'      => 8,
            'title' 		=> __('Sidebar Options','newsmunch-pro'),
			'panel'  		=> 'newsmunch_theme_options',
		)
    );
	
	//  Pages Layout // 
	$wp_customize->add_setting(
		'newsmunch_pages_sidebar_option'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pages_sidebar_option',
		array(
			'type' => 'hidden',
			'label' => __('Sidebar Layout','newsmunch-pro'),
			'section' => 'newsmunch_sidebar_options',
		)
	);
	
	// Default Page
	$wp_customize->add_setting( 
		'newsmunch_default_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 2,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_default_pg_sidebar_option' , 
		array(
			'label'          => __( 'Default Page Sidebar Option', 'newsmunch-pro' ),
			'section'        => 'newsmunch_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'newsmunch-pro' ),
				'right_sidebar' 	=> __( 'Right Sidebar', 'newsmunch-pro' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'newsmunch-pro' ),
			) 
		) 
	);
	
	// Archive Page
	$wp_customize->add_setting( 
		'newsmunch_archive_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 3,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_archive_pg_sidebar_option' , 
		array(
			'label'          => __( 'Archive Page Sidebar Option', 'newsmunch-pro' ),
			'section'        => 'newsmunch_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'newsmunch-pro' ),
				'right_sidebar' => __( 'Right Sidebar', 'newsmunch-pro' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'newsmunch-pro' ),
			) 
		) 
	);
	
	
	// Single Page
	$wp_customize->add_setting( 
		'newsmunch_single_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_single_pg_sidebar_option' , 
		array(
			'label'          => __( 'Single Page Sidebar Option', 'newsmunch-pro' ),
			'section'        => 'newsmunch_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'newsmunch-pro' ),
				'right_sidebar' => __( 'Right Sidebar', 'newsmunch-pro' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'newsmunch-pro' ),
			) 
		) 
	);
	
	
	// Blog Page
	$wp_customize->add_setting( 
		'newsmunch_blog_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 5,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_blog_pg_sidebar_option' , 
		array(
			'label'          => __( 'Blog Page Sidebar Option', 'newsmunch-pro' ),
			'section'        => 'newsmunch_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'newsmunch-pro' ),
				'right_sidebar' => __( 'Right Sidebar', 'newsmunch-pro' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'newsmunch-pro' ),
			) 
		) 
	);
	
	// Search Page
	$wp_customize->add_setting( 
		'newsmunch_search_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 5,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_search_pg_sidebar_option' , 
		array(
			'label'          => __( 'Search Page Sidebar Option', 'newsmunch-pro' ),
			'section'        => 'newsmunch_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'newsmunch-pro' ),
				'right_sidebar' => __( 'Right Sidebar', 'newsmunch-pro' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'newsmunch-pro' ),
			) 
		) 
	);
	
	
	// WooCommerce Page
	$wp_customize->add_setting( 
		'newsmunch_shop_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 6,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_shop_pg_sidebar_option' , 
		array(
			'label'          => __( 'WooCommerce Page Sidebar Option', 'newsmunch-pro' ),
			'section'        => 'newsmunch_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'newsmunch-pro' ),
				'right_sidebar' => __( 'Right Sidebar', 'newsmunch-pro' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'newsmunch-pro' ),
			) 
		) 
	);
	
	// Author Page
	$wp_customize->add_setting( 
		'newsmunch_author_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 6,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_author_pg_sidebar_option' , 
		array(
			'label'          => __( 'Author Page Sidebar Option', 'newsmunch-pro' ),
			'section'        => 'newsmunch_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'newsmunch-pro' ),
				'right_sidebar' => __( 'Right Sidebar', 'newsmunch-pro' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'newsmunch-pro' ),
			) 
		) 
	);
	
	// Widget options
	$wp_customize->add_setting(
		'sidebar_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority'  => 6
		)
	);

	$wp_customize->add_control(
	'sidebar_options',
		array(
			'type' => 'hidden',
			'label' => __('Options','newsmunch-pro'),
			'section' => 'newsmunch_sidebar_options',
		)
	);
	
	
	
	// Sidebar Width 
	if ( class_exists( 'Newsmunch_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'newsmunch_sidebar_width',
			array(
				'default'	      => esc_html__( '33', 'newsmunch-pro' ),
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'transport'         => 'postMessage',
				'priority'  => 7
			)
		);
		$wp_customize->add_control( 
		new Newsmunch_Customizer_Range_Control( $wp_customize, 'newsmunch_sidebar_width', 
			array(
				'label'      => __( 'Sidebar Width', 'newsmunch-pro' ),
				'section'  => 'newsmunch_sidebar_options',
				 'media_query'   => false,
					'input_attr'    => array(
						'desktop' => array(
							'min'           => 25,
							'max'           => 50,
							'step'          => 1,
							'default_value' => 33,
						),
					),
			) ) 
		);
	}
	
	
	// Sticky Sidebar
	$wp_customize->add_setting(
		'sticky_sidebar_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority'  => 7
		)
	);

	$wp_customize->add_control(
	'sticky_sidebar_options',
		array(
			'type' => 'hidden',
			'label' => __('Sticky Sidebar','newsmunch-pro'),
			'section' => 'newsmunch_sidebar_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting(
		'sticky_sidebar_hs'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority'  => 7
		)
	);

	$wp_customize->add_control(
	'sticky_sidebar_hs',
		array(
			'type' => 'checkbox',
			'label' => __('Sticky Sidebar','newsmunch-pro'),
			'section' => 'newsmunch_sidebar_options',
		)
	);
	
	// Widget Typography
	$wp_customize->add_setting(
		'sidebar_typography'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'sidebar_typography',
		array(
			'type' => 'hidden',
			'label' => __('Typography','newsmunch-pro'),
			'section' => 'newsmunch_sidebar_options',
			'priority'  => 21,
		)
	);
	
	// Widget Title // 
	if ( class_exists( 'Newsmunch_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'newsmunch_widget_ttl_size',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'transport'         => 'postMessage'
			)
		);
		$wp_customize->add_control( 
		new Newsmunch_Customizer_Range_Control( $wp_customize, 'newsmunch_widget_ttl_size', 
			array(
				'label'      => __( 'Widget Title Font Size', 'newsmunch-pro' ),
				'section'  => 'newsmunch_sidebar_options',
				'priority'  => 22,
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 5,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 17,
                    ),
                    'tablet'  => array(
                        'min'           => 5,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 17,
                    ),
                    'desktop' => array(
                        'min'           => 5,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => 17,
                    ),
                ),
			) ) 
		);
	}
	
	/*=========================================
	Blog Options
	=========================================*/
	$wp_customize->add_section(
		'site_blog_options', array(
			'title' => esc_html__( 'Blog Options', 'newsmunch-pro' ),
			'priority' => 2,
			'panel' => 'newsmunch_theme_options',
		)
	);
	
	/*=========================================
	Excerpt
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_blog_excerpt_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 9,
		)
	);

	$wp_customize->add_control(
	'newsmunch_blog_excerpt_options',
		array(
			'type' => 'hidden',
			'label' => __('Post Excerpt','newsmunch-pro'),
			'section' => 'site_blog_options',
		)
	);
	
	
	// Enable Excerpt
	$wp_customize->add_setting(
		'newsmunch_enable_post_excerpt'
			,array(
			'default' => '1',	
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority'      => 9,
		)
	);

	$wp_customize->add_control(
	'newsmunch_enable_post_excerpt',
		array(
			'type' => 'checkbox',
			'label' => __('Enable Excerpt','newsmunch-pro'),
			'section' => 'site_blog_options',
		)
	);
	
	
	// post Exerpt // 
	if ( class_exists( 'NewsMunch_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'newsmunch_post_excerpt_length',
			array(
				'default'     	=> '30',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'priority'      => 10,
			)
		);
		$wp_customize->add_control( 
		new NewsMunch_Customizer_Range_Control( $wp_customize, 'newsmunch_post_excerpt_length', 
			array(
				'label'      => __( 'Excerpt Length', 'newsmunch-pro' ),
				'section'  => 'site_blog_options',
				 'media_query'   => false,
                'input_attr'    => array(
                    'desktop' => array(
                       'min'           => 0,
                        'max'           => 1000,
                        'step'          => 1,
                        'default_value' => 30,
                    ),
				)	
			) ) 
		);
	}
	
	// excerpt more // 
	$wp_customize->add_setting(
    	'newsmunch_blog_excerpt_more',
    	array(
			'default'      => '...',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
			'priority'      => 11,
		)
	);	

	$wp_customize->add_control( 
		'newsmunch_blog_excerpt_more',
		array(
		    'label'   => esc_html__('Excerpt More','newsmunch-pro'),
		    'section' => 'site_blog_options',
			'type' => 'text',
		)  
	);
	
	
	// Enable Excerpt
	$wp_customize->add_setting(
		'newsmunch_show_post_btn'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority'      => 12,
		)
	);

	$wp_customize->add_control(
	'newsmunch_show_post_btn',
		array(
			'type' => 'checkbox',
			'label' => __('Enable Read More Button','newsmunch-pro'),
			'section' => 'site_blog_options',
		)
	);
	
	// Readmore button
	$wp_customize->add_setting(
		'newsmunch_read_btn_txt'
			,array(
			'default' => __('Read more','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'priority'      => 13,
		)
	);

	$wp_customize->add_control(
	'newsmunch_read_btn_txt',
		array(
			'type' => 'text',
			'label' => __('Read More Button Text','newsmunch-pro'),
			'section' => 'site_blog_options',
		)
	);
	
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_latest_post_title' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_latest_post_title', 
		array(
			'label'	      => esc_html__( 'Hide/Show Title?', 'newsmunch-pro' ),
			'section'     => 'site_blog_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_latest_post_cat_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_latest_post_cat_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Category?', 'newsmunch-pro' ),
			'section'     => 'site_blog_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_latest_post_auth_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_latest_post_auth_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Author?', 'newsmunch-pro' ),
			'section'     => 'site_blog_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_latest_post_date_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_latest_post_date_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Date?', 'newsmunch-pro' ),
			'section'     => 'site_blog_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_latest_post_comment_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_latest_post_comment_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Comment?', 'newsmunch-pro' ),
			'section'     => 'site_blog_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_latest_post_view_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_latest_post_view_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show View?', 'newsmunch-pro' ),
			'section'     => 'site_blog_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_latest_post_reading_meta' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_latest_post_reading_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Reading Time?', 'newsmunch-pro' ),
			'section'     => 'site_blog_options',
			'type'        => 'checkbox'
		) 
	);
	
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_latest_post_content_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_latest_post_content_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Content?', 'newsmunch-pro' ),
			'section'     => 'site_blog_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_latest_post_social_share' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_latest_post_social_share', 
		array(
			'label'	      => esc_html__( 'Hide/Show Social Share?', 'newsmunch-pro' ),
			'section'     => 'site_blog_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_latest_post_format_icon' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_latest_post_format_icon', 
		array(
			'label'	      => esc_html__( 'Hide/Show Post Format Icon?', 'newsmunch-pro' ),
			'section'     => 'site_blog_options',
			'type'        => 'checkbox'
		) 
	);
	
	
	//  Read More Label // 
	$wp_customize->add_setting(
    	'newsmunch_latest_post_rm_lbl',
    	array(
	        'default'			=> __('Continue reading','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_latest_post_rm_lbl',
		array(
		    'label'   => __('Read More Label','newsmunch-pro'),
		    'section' => 'site_blog_options',
			'type'           => 'text',
		)  
	);
	
	
	/*=========================================
	Archive Layout
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_archives_layout_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'newsmunch_archives_layout_options',
		array(
			'type' => 'hidden',
			'label' => __('Archive Layout','newsmunch-pro'),
			'section' => 'site_blog_options',
		)
	);
	
	// Type
	$wp_customize->add_setting( 
		'newsmunch_archives_post_layout' , 
			array(
			'default' => 'list',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_archives_post_layout' , 
		array(
			'label'          => __( 'Select Type', 'newsmunch-pro' ),
			'section'        => 'site_blog_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'list' 	=> __( 'List', 'newsmunch-pro' ),
				'grid' 	=> __( 'Grid', 'newsmunch-pro' ),
				'classic' 	=> __( 'Classic', 'newsmunch-pro' ),
			) 
		) 
	);
	
	
	/*=========================================
	Post Pagination
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_post_pagination_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
	'newsmunch_post_pagination_options',
		array(
			'type' => 'hidden',
			'label' => __('Post Pagination','newsmunch-pro'),
			'section' => 'site_blog_options',
		)
	);
	
	// Type
	$wp_customize->add_setting( 
		'newsmunch_post_pagination_type' , 
			array(
			'default' => 'default',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 6,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_post_pagination_type' , 
		array(
			'label'          => __( 'Select Type', 'newsmunch-pro' ),
			'section'        => 'site_blog_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'default' 	=> __( 'Default', 'newsmunch-pro' ),
				'button' 	=> __( 'Load More Button', 'newsmunch-pro' ),
				'infinite' 	=> __( 'Infinite scroll', 'newsmunch-pro' )
			) 
		) 
	);
	
	// Type
	$wp_customize->add_setting( 
		'newsmunch_post_pagination_lm_btn' , 
			array(
			'default' => __( 'Load More', 'newsmunch-pro' ),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'priority' => 6,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_post_pagination_lm_btn' , 
		array(
			'label'          => __( 'Load More Button Label', 'newsmunch-pro' ),
			'section'        => 'site_blog_options',
			'type'           => 'text'
		) 
	);
	
	/*=========================================
	Colors
	=========================================*/
	$wp_customize->add_section(
		'colors', array(
			'title' => esc_html__( 'Colors', 'newsmunch-pro' ),
			'priority' => 12,
			'panel' => 'newsmunch_theme_options',
		)
	);
	
	/*=========================================
	Background Image
	=========================================*/
	$wp_customize->add_section(
		'background_image', array(
			'title' => esc_html__( 'Background Image', 'newsmunch-pro' ),
			'priority' => 12,
			'panel' => 'newsmunch_theme_options',
		)
	);
}
add_action( 'customize_register', 'newsmunch_theme_options_customize' );
