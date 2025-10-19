<?php
function newsmunch_theme_options_customize( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'newsmunch_theme_options', array(
			'priority' => 31,
			'title' => esc_html__( 'Theme Options', 'newsmunch' ),
		)
	);
	
	/*=========================================
	Header Image
	=========================================*/
	$wp_customize->add_section(
		'header_image', array(
			'title' => esc_html__( 'Header Image', 'newsmunch' ),
			'priority' => 1,
			'panel' => 'newsmunch_theme_options',
		)
	);
	
	/*=========================================
	General Options
	=========================================*/
	$wp_customize->add_section(
		'site_general_options', array(
			'title' => esc_html__( 'General Options', 'newsmunch' ),
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
			'label' => __('Site Preloader','newsmunch'),
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
			'label'	      => esc_html__( 'Hide / Show Preloader', 'newsmunch' ),
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
			'label' => __('Site Container','newsmunch'),
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
				'label'      => __( 'Container Width', 'newsmunch' ),
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
			'label' => __('Top Scroller','newsmunch'),
			'section' => 'site_general_options'
		)
	);
	
	//Hide/show
	$wp_customize->add_setting( 
		'newsmunch_hs_scroller_option' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 7,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_scroller_option', 
		array(
			'label'	      => esc_html__( 'Hide / Show Scroller', 'newsmunch' ),
			'section'     => 'site_general_options',
			'type'        => 'checkbox'
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
			'label' => __('Search Result','newsmunch'),
			'section' => 'site_general_options',
		)
	);
	
	//  Style
	$wp_customize->add_setting( 
		'newsmunch_search_result' , 
			array(
			'default' => 'post',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 8,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_search_result' , 
		array(
			'label'          => __( 'Search Result Page will Show ?', 'newsmunch' ),
			'section'        => 'site_general_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'post' 	=> __( 'Posts', 'newsmunch' ),
				'product' 	=> __( 'WooCommerce Products', 'newsmunch' ),
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
			'label' => __('Light/Dark Style','newsmunch'),
			'section' => 'site_general_options',
		)
	);	
	
	//  Style
	$wp_customize->add_setting( 
		'newsmunch_dark_mode' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 8,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_dark_mode' , 
		array(
			'label'          => __( 'Select Light or  Dark Mode ?', 'newsmunch' ),
			'section'        => 'site_general_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'' 	=> __( 'Light', 'newsmunch' ),
				'dark' 	=> __( 'Dark', 'newsmunch' ),
			) 
		) 
	);
	
	
	/*=========================================
	Breadcrumb  Section
	=========================================*/
	$wp_customize->add_section(
		'newsmunch_site_breadcrumb', array(
			'title' => esc_html__( 'Site Breadcrumb', 'newsmunch' ),
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
			'label' => __('Settings','newsmunch'),
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
			'label'	      => esc_html__( 'Hide / Show Section', 'newsmunch' ),
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
			'label' => __('Content','newsmunch'),
			'section' => 'newsmunch_site_breadcrumb',
		)
	);
	
	
	// Type
	$wp_customize->add_setting( 
		'newsmunch_breadcrumb_type' , 
			array(
			'default' => 'theme3',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 5,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_breadcrumb_type' , 
		array(
			'label'          => __( 'Select Breadcrumb Type', 'newsmunch' ),
			'description'          => __( 'You need to install and activate the respected plugin to show their Breadcrumb. Otherwise, your default theme Breadcrumb will appear. If you see error in search console, then we recommend to use plugin Breadcrumb.', 'newsmunch' ),
			'section'        => 'newsmunch_site_breadcrumb',
			'type'           => 'select',
			'choices'        => 
			array(
				'theme3' 	=> __( 'Theme Default', 'newsmunch' ),
				'yoast' 	=> __( 'Yoast Plugin', 'newsmunch' ),
				'rankmath' 	=> __( 'Rank Math Plugin', 'newsmunch' ),
				'navxt' 	=> __( 'NavXT Plugin', 'newsmunch' ),
			) 
		) 
	);
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'newsmunch_breadcrumb_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 5,
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'newsmunch_breadcrumb_option_upsale', 
				array(
					'label'      => __( 'Breadcrumb Types', 'newsmunch' ),
					'section'    => 'newsmunch_site_breadcrumb'
				) 
			) 
		);	
	}
	
	
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
			'label' => __('Typography','newsmunch'),
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
			'label'      => __( 'Title Font Size', 'newsmunch' ),
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
			'label'      => __( 'Content Font Size', 'newsmunch' ),
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
            'title' 		=> __('Sidebar Options','newsmunch'),
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
			'label' => __('Sidebar Layout','newsmunch'),
			'section' => 'newsmunch_sidebar_options',
		)
	);
	
	// Default Page
	$wp_customize->add_setting( 
		'newsmunch_default_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 2,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_default_pg_sidebar_option' , 
		array(
			'label'          => __( 'Default Page Sidebar Option', 'newsmunch' ),
			'section'        => 'newsmunch_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'newsmunch' ),
				'right_sidebar' 	=> __( 'Right Sidebar', 'newsmunch' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'newsmunch' ),
			) 
		) 
	);
	
	// Archive Page
	$wp_customize->add_setting( 
		'newsmunch_archive_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 3,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_archive_pg_sidebar_option' , 
		array(
			'label'          => __( 'Archive Page Sidebar Option', 'newsmunch' ),
			'section'        => 'newsmunch_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'newsmunch' ),
				'right_sidebar' => __( 'Right Sidebar', 'newsmunch' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'newsmunch' ),
			) 
		) 
	);
	
	
	// Single Page
	$wp_customize->add_setting( 
		'newsmunch_single_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_single_pg_sidebar_option' , 
		array(
			'label'          => __( 'Single Page Sidebar Option', 'newsmunch' ),
			'section'        => 'newsmunch_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'newsmunch' ),
				'right_sidebar' => __( 'Right Sidebar', 'newsmunch' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'newsmunch' ),
			) 
		) 
	);
	
	
	// Blog Page
	$wp_customize->add_setting( 
		'newsmunch_blog_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 5,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_blog_pg_sidebar_option' , 
		array(
			'label'          => __( 'Blog Page Sidebar Option', 'newsmunch' ),
			'section'        => 'newsmunch_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'newsmunch' ),
				'right_sidebar' => __( 'Right Sidebar', 'newsmunch' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'newsmunch' ),
			) 
		) 
	);
	
	// Search Page
	$wp_customize->add_setting( 
		'newsmunch_search_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 5,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_search_pg_sidebar_option' , 
		array(
			'label'          => __( 'Search Page Sidebar Option', 'newsmunch' ),
			'section'        => 'newsmunch_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'newsmunch' ),
				'right_sidebar' => __( 'Right Sidebar', 'newsmunch' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'newsmunch' ),
			) 
		) 
	);
	
	
	// WooCommerce Page
	$wp_customize->add_setting( 
		'newsmunch_shop_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 6,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_shop_pg_sidebar_option' , 
		array(
			'label'          => __( 'WooCommerce Page Sidebar Option', 'newsmunch' ),
			'section'        => 'newsmunch_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'newsmunch' ),
				'right_sidebar' => __( 'Right Sidebar', 'newsmunch' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'newsmunch' ),
			) 
		) 
	);
	
	// Author Page
	$wp_customize->add_setting( 
		'newsmunch_author_pg_sidebar_option' , 
			array(
			'default' => 'right_sidebar',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 6,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_author_pg_sidebar_option' , 
		array(
			'label'          => __( 'Author Page Sidebar Option', 'newsmunch' ),
			'section'        => 'newsmunch_sidebar_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'left_sidebar' 	=> __( 'Left Sidebar', 'newsmunch' ),
				'right_sidebar' => __( 'Right Sidebar', 'newsmunch' ),
				'no_sidebar' 	=> __( 'No Sidebar', 'newsmunch' ),
			) 
		) 
	);
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'newsmunch_sidebar_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 6,
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'newsmunch_sidebar_option_upsale', 
				array(
					'label'      => __( 'Sidebar Features', 'newsmunch' ),
					'section'    => 'newsmunch_sidebar_options'
				) 
			) 
		);	
	}
	
	
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
			'label' => __('Options','newsmunch'),
			'section' => 'newsmunch_sidebar_options',
		)
	);
	
	
	
	// Sidebar Width 
	if ( class_exists( 'Newsmunch_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'newsmunch_sidebar_width',
			array(
				'default'	      => esc_html__( '33', 'newsmunch' ),
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'transport'         => 'postMessage',
				'priority'  => 7
			)
		);
		$wp_customize->add_control( 
		new Newsmunch_Customizer_Range_Control( $wp_customize, 'newsmunch_sidebar_width', 
			array(
				'label'      => __( 'Sidebar Width', 'newsmunch' ),
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
			'label' => __('Sticky Sidebar','newsmunch'),
			'section' => 'newsmunch_sidebar_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting(
		'sticky_sidebar_hs'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority'  => 7
		)
	);

	$wp_customize->add_control(
	'sticky_sidebar_hs',
		array(
			'type' => 'checkbox',
			'label' => __('Sticky Sidebar','newsmunch'),
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
			'label' => __('Typography','newsmunch'),
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
				'label'      => __( 'Widget Title Font Size', 'newsmunch' ),
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
			'title' => esc_html__( 'Blog Options', 'newsmunch' ),
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
			'label' => __('Post Excerpt','newsmunch'),
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
			'label' => __('Enable Excerpt','newsmunch'),
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
				'label'      => __( 'Excerpt Length', 'newsmunch' ),
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
		    'label'   => esc_html__('Excerpt More','newsmunch'),
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
			'label' => __('Enable Read More Button','newsmunch'),
			'section' => 'site_blog_options',
		)
	);
	
	// Readmore button
	$wp_customize->add_setting(
		'newsmunch_read_btn_txt'
			,array(
			'default' => __('Read more','newsmunch'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'priority'      => 13,
		)
	);

	$wp_customize->add_control(
	'newsmunch_read_btn_txt',
		array(
			'type' => 'text',
			'label' => __('Read More Button Text','newsmunch'),
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
			'label'	      => esc_html__( 'Hide/Show Title?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Category?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Author?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Date?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Comment?', 'newsmunch' ),
			'section'     => 'site_blog_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_latest_post_view_meta' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_latest_post_view_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show View?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Reading Time?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Content?', 'newsmunch' ),
			'section'     => 'site_blog_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_latest_post_social_share' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_latest_post_social_share', 
		array(
			'label'	      => esc_html__( 'Hide/Show Social Share?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Post Format Icon?', 'newsmunch' ),
			'section'     => 'site_blog_options',
			'type'        => 'checkbox'
		) 
	);
	
	
	//  Read More Label // 
	$wp_customize->add_setting(
    	'newsmunch_latest_post_rm_lbl',
    	array(
	        'default'			=> __('Continue reading','newsmunch'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_latest_post_rm_lbl',
		array(
		    'label'   => __('Read More Label','newsmunch'),
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
			'label' => __('Archive Layout','newsmunch'),
			'section' => 'site_blog_options',
		)
	);
	
	// Type
	$wp_customize->add_setting( 
		'newsmunch_archives_post_layout' , 
			array(
			'default' => 'grid',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_archives_post_layout' , 
		array(
			'label'          => __( 'Select Type', 'newsmunch' ),
			'section'        => 'site_blog_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'list' 	=> __( 'List', 'newsmunch' ),
				'grid' 	=> __( 'Grid', 'newsmunch' ),
				'classic' 	=> __( 'Classic', 'newsmunch' ),
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
			'label' => __('Post Pagination','newsmunch'),
			'section' => 'site_blog_options',
		)
	);
	
	// Type
	$wp_customize->add_setting( 
		'newsmunch_post_pagination_type' , 
			array(
			'default' => 'default',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 6,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_post_pagination_type' , 
		array(
			'label'          => __( 'Select Type', 'newsmunch' ),
			'section'        => 'site_blog_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'default' 	=> __( 'Default', 'newsmunch' ),
				'next' 	=> __( 'Next / Preview', 'newsmunch' )
			) 
		) 
	);
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'newsmunch_post_pagination_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 6,
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'newsmunch_post_pagination_option_upsale', 
				array(
					'label'      => __( 'Pagination Styles', 'newsmunch' ),
					'section'    => 'site_blog_options'
				) 
			) 
		);	
	}
	
	/*=========================================
	Colors
	=========================================*/
	$wp_customize->add_section(
		'colors', array(
			'title' => esc_html__( 'Colors', 'newsmunch' ),
			'priority' => 12,
			'panel' => 'newsmunch_theme_options',
		)
	);
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'newsmunch_color_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 6,
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'newsmunch_color_option_upsale', 
				array(
					'label'      => __( 'Color Styles', 'newsmunch' ),
					'section'    => 'colors'
				) 
			) 
		);	
	}
	
	/*=========================================
	Background Image
	=========================================*/
	$wp_customize->add_section(
		'background_image', array(
			'title' => esc_html__( 'Background Image', 'newsmunch' ),
			'priority' => 12,
			'panel' => 'newsmunch_theme_options',
		)
	);
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'newsmunch_background_image_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 6,
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'newsmunch_background_image_upsale', 
				array(
					'label'      => __( 'Background Styles', 'newsmunch' ),
					'section'    => 'background_image'
				) 
			) 
		);	
	}
}
add_action( 'customize_register', 'newsmunch_theme_options_customize' );
