<?php
function newsmunch_header_customize_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Header Settings Panel
	=========================================*/
	$wp_customize->add_panel( 
		'header_options', 
		array(
			'priority'      => 2,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Header Options', 'newsmunch'),
		) 
	);
	
	/*=========================================
	NewsMunch Site Identity
	=========================================*/
	$wp_customize->add_section(
        'title_tagline',
        array(
        	'priority'      => 1,
            'title' 		=> __('Site Identity','newsmunch'),
			'panel'  		=> 'header_options',
		)
    );
	
	// Logo Width // 
	if ( class_exists( 'NewsMunch_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'hdr_logo_size',
			array(
				'default'			=> '150',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new NewsMunch_Customizer_Range_Control( $wp_customize, 'hdr_logo_size', 
			array(
				'label'      => __( 'Logo Size', 'newsmunch' ),
				'section'  => 'title_tagline',
				 'media_query'   => true,
					'input_attr'    => array(
						'mobile'  => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
						'tablet'  => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
						'desktop' => array(
							'min'           => 0,
							'max'           => 500,
							'step'          => 1,
							'default_value' => 150,
						),
					),
			) ) 
		);
	}
	
	
	// Site Title Size // 
	if ( class_exists( 'NewsMunch_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'hdr_site_title_size',
			array(
				'default'			=> '55',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new NewsMunch_Customizer_Range_Control( $wp_customize, 'hdr_site_title_size', 
			array(
				'label'      => __( 'Site Title Size', 'newsmunch' ),
				'section'  => 'title_tagline',
				 'media_query'   => true,
					'input_attr'    => array(
						'mobile'  => array(
							'min'           => 0,
							'max'           => 100,
							'step'          => 1,
							'default_value' => 55,
						),
						'tablet'  => array(
							'min'           => 0,
							'max'           => 100,
							'step'          => 1,
							'default_value' => 55,
						),
						'desktop' => array(
							'min'           => 0,
							'max'           => 100,
							'step'          => 1,
							'default_value' => 55,
						),
					),
			) ) 
		);
	}
	
	// Site Tagline Size // 
	if ( class_exists( 'NewsMunch_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'hdr_site_desc_size',
			array(
				'default'			=> '16',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new NewsMunch_Customizer_Range_Control( $wp_customize, 'hdr_site_desc_size', 
			array(
				'label'      => __( 'Site Tagline Size', 'newsmunch' ),
				'section'  => 'title_tagline',
				 'media_query'   => true,
					'input_attr'    => array(
						'mobile'  => array(
							'min'           => 0,
							'max'           => 50,
							'step'          => 1,
							'default_value' => 16,
						),
						'tablet'  => array(
							'min'           => 0,
							'max'           => 50,
							'step'          => 1,
							'default_value' => 16,
						),
						'desktop' => array(
							'min'           => 0,
							'max'           => 50,
							'step'          => 1,
							'default_value' => 16,
						),
					),
			) ) 
		);
	}
	
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_title_tagline_seo' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_title_tagline_seo', 
		array(
			'label'	      => esc_html__( 'Enable Hidden Title (h1 missing SEO issue)', 'newsmunch' ),
			'section'     => 'title_tagline',
			'type'        => 'checkbox'
		) 
	);	
	
	
	
	/*=========================================
	Top Header
	=========================================*/
	$wp_customize->add_section(
        'newsmunch_top_header',
        array(
        	'priority'      => 2,
            'title' 		=> __('Top Header','newsmunch'),
			'panel'  		=> 'header_options',
		)
    );	
	
	/*=========================================
	Global Setting
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_hdr_top'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hdr_top',
		array(
			'type' => 'hidden',
			'label' => __('Global Setting','newsmunch'),
			'section' => 'newsmunch_top_header',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_hdr' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_hdr', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'newsmunch' ),
			'section'     => 'newsmunch_top_header',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Text
	=========================================*/
	$wp_customize->add_setting(
		'NewsMunch_hdr_left_text_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 2,
		)
	);

	$wp_customize->add_control(
	'NewsMunch_hdr_left_text_head',
		array(
			'type' => 'hidden',
			'label' => __('Left Text','newsmunch'),
			'section' => 'newsmunch_top_header',
		)
	);
	
	
	$wp_customize->add_setting( 
		'newsmunch_hs_hdr_left_text' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_hdr_left_text', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'newsmunch' ),
			'section'     => 'newsmunch_top_header',
			'type'        => 'checkbox'
		) 
	);
	
	//  title // 
	$wp_customize->add_setting(
    	'newsmunch_hdr_left_ttl',
    	array(
	        'default'			=> __('<i class="fas fa-fire-alt"></i> Trending News:','newsmunch'),
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 2,
		)
	);	

	$wp_customize->add_control( 
		'newsmunch_hdr_left_ttl',
		array(
		    'label'   		=> __('Title','newsmunch'),
		    'section' 		=> 'newsmunch_top_header',
			'type'		 =>	'text'
		)  
	);
	
	// Select Blog Category
	$wp_customize->add_setting(
    'newsmunch_hdr_left_text_cat',
		array(
		'default'	      => '0',	
		'capability' => 'edit_theme_options',
		'priority' => 2,
		'sanitize_callback' => 'absint'
		)
	);	
	$wp_customize->add_control( new Newsmunch_Post_Category_Control( $wp_customize, 
	'newsmunch_hdr_left_text_cat', 
		array(
		'label'   => __('Select Category','newsmunch'),
		'description'   => __('Posts Title to be shown on Header Text','newsmunch'),
		'section' => 'newsmunch_top_header',
		) 
	) );
	
	
	/*=========================================
	Date
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_hdr_date'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hdr_date',
		array(
			'type' => 'hidden',
			'label' => __('Date & Time','newsmunch'),
			'section' => 'newsmunch_top_header',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_hdr_date' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_hdr_date', 
		array(
			'label'	      => esc_html__( 'Hide/Show Date?', 'newsmunch' ),
			'section'     => 'newsmunch_top_header',
			'type'        => 'checkbox'
		) 
	);	
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_hdr_time' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_hdr_time', 
		array(
			'label'	      => esc_html__( 'Hide/Show Time?', 'newsmunch' ),
			'section'     => 'newsmunch_top_header',
			'type'        => 'checkbox'
		) 
	);	
	
	
	// Type
	$wp_customize->add_setting( 
		'newsmunch_hdr_date_display' , 
			array(
			'default' => 'theme',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 2,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_hdr_date_display' , 
		array(
			'label'          => __( 'Date Display Type', 'newsmunch' ),
			'section'        => 'newsmunch_top_header',
			'type'           => 'select',
			'choices'        => 
			array(
				'theme' 	=> __( 'Theme Default', 'newsmunch' ),
				'wp' 	=> __( 'WordPress', 'newsmunch' )
			) 
		) 
	);
	
	
	/*=========================================
	Weather
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_hdr_top_weather'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 17,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hdr_top_weather',
		array(
			'type' => 'hidden',
			'label' => __('Weather','newsmunch'),
			'section' => 'newsmunch_top_header',
			
		)
	);
	$wp_customize->add_setting( 
		'newsmunch_hs_hdr_top_weather', 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 17,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_hdr_top_weather', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'newsmunch' ),
			'section'     => 'newsmunch_top_header',
			'type'        => 'checkbox'
		) 
	);		
	
	/*=========================================
	Social
	=========================================*/
	$wp_customize->add_setting(
		'NewsMunch_hdr_social_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 24,
		)
	);

	$wp_customize->add_control(
	'NewsMunch_hdr_social_head',
		array(
			'type' => 'hidden',
			'label' => __('Social Icons','newsmunch'),
			'section' => 'newsmunch_top_header',
		)
	);
	
	
	$wp_customize->add_setting( 
		'newsmunch_hs_hdr_social' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 25,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_hdr_social', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'newsmunch' ),
			'section'     => 'newsmunch_top_header',
			'type'        => 'checkbox'
		) 
	);
	
	/**
	 * Customizer Repeater
	 */
		$wp_customize->add_setting( 'newsmunch_hdr_social', 
			array(
			 'sanitize_callback' => 'newsmunch_repeater_sanitize',
			 'priority' => 26,
			 'default' => newsmunch_get_social_icon_default()
		)
		);
		
		$wp_customize->add_control( 
			new NEWSMUNCH_Repeater( $wp_customize, 
				'newsmunch_hdr_social', 
					array(
						'label'   => esc_html__('Social Icons','newsmunch'),
						'section' => 'newsmunch_top_header',
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_link_control' => true,
					) 
				) 
			);
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'newsmunch_social_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 26,
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'newsmunch_social_option_upsale', 
				array(
					'label'      => __( 'Icons', 'newsmunch' ),
					'section'    => 'newsmunch_top_header'
				) 
			) 
		);
	}
	
	/*=========================================
	Header Navigation
	=========================================*/	
	$wp_customize->add_section(
        'newsmunch_hdr_nav',
        array(
        	'priority'      => 4,
            'title' 		=> __('Navigation Bar','newsmunch'),
			'panel'  		=> 'header_options',
		)
    );
	
	
	/*=========================================
	Header Home
	=========================================*/	
	$wp_customize->add_setting(
		'newsmunch_hdr_home_icon'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hdr_home_icon',
		array(
			'type' => 'hidden',
			'label' => __('Home Icon','newsmunch'),
			'section' => 'newsmunch_hdr_nav',
		)
	);
	
	
	$wp_customize->add_setting( 
		'newsmunch_hs_hdr_home_icon' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_hdr_home_icon', 
		array(
			'label'	      => esc_html__( 'Hide/Show Home Icon?', 'newsmunch' ),
			'section'     => 'newsmunch_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Header Cart
	=========================================*/	
	$wp_customize->add_setting(
		'newsmunch_hdr_cart'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hdr_cart',
		array(
			'type' => 'hidden',
			'label' => __('WooCommerce Cart','newsmunch'),
			'section' => 'newsmunch_hdr_nav',
		)
	);
	
	
	$wp_customize->add_setting( 
		'newsmunch_hs_hdr_cart' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_hdr_cart', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'newsmunch' ),
			'section'     => 'newsmunch_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	
	
	
	/*=========================================
	Header Search
	=========================================*/	
	$wp_customize->add_setting(
		'newsmunch_hdr_search'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hdr_search',
		array(
			'type' => 'hidden',
			'label' => __('Site Search','newsmunch'),
			'section' => 'newsmunch_hdr_nav',
		)
	);
	$wp_customize->add_setting( 
		'newsmunch_hs_hdr_search' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_hdr_search', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'newsmunch' ),
			'section'     => 'newsmunch_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	
	/*=========================================
	Header Account
	=========================================*/	
	$wp_customize->add_setting(
		'newsmunch_hdr_account'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hdr_account',
		array(
			'type' => 'hidden',
			'label' => __('My Account','newsmunch'),
			'section' => 'newsmunch_hdr_nav',
		)
	);
	
	
	$wp_customize->add_setting( 
		'newsmunch_hs_hdr_account' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_hdr_account', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'newsmunch' ),
			'section'     => 'newsmunch_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	
	/*=========================================
	Header Subscribe
	=========================================*/	
	$wp_customize->add_setting(
		'newsmunch_hdr_subscribe'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hdr_subscribe',
		array(
			'type' => 'hidden',
			'label' => __('Subscribe','newsmunch'),
			'section' => 'newsmunch_hdr_nav',
		)
	);
	
	
	$wp_customize->add_setting( 
		'newsmunch_hs_hdr_subscribe' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_hdr_subscribe', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'newsmunch' ),
			'section'     => 'newsmunch_hdr_nav',
			'type'        => 'checkbox'
		) 
	);
	
	// Link // 
	$wp_customize->add_setting(
    	'newsmunch_hdr_subscribe_link',
    	array(
			'default'			=> '#',
			'sanitize_callback' => 'newsmunch_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 4,
		)
	);	

	$wp_customize->add_control( 
		'newsmunch_hdr_subscribe_link',
		array(
		    'label'   		=> __('Link','newsmunch'),
		    'section' 		=> 'newsmunch_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	
	
	/*=========================================
	NewsMunch Dark
	=========================================*/
	
	//  Head // 
	$wp_customize->add_setting(
		'newsmunch_hdr_dark_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hdr_dark_head',
		array(
			'type' => 'hidden',
			'label' => __('Light/Dark Style','newsmunch'),
			'section' => 'newsmunch_hdr_nav',
		)
	);
	
	// Hide/ Show
	$wp_customize->add_setting( 
		'newsmunch_hs_hdr_dark_option' , 
			array(
			'default' => '1',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 7,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_hdr_dark_option', 
		array(
			'label'	      => esc_html__( 'Hide / Show Light & Dark Mode Switcher', 'newsmunch' ),
			'section'     => 'newsmunch_hdr_nav',
			'type'        => 'checkbox'
		) 
	);
	
	/*=========================================
	Header Button
	=========================================*/	
	$wp_customize->add_setting(
		'newsmunch_hdr_button'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 7,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hdr_button',
		array(
			'type' => 'hidden',
			'label' => __('Button','newsmunch'),
			'section' => 'newsmunch_hdr_nav',
		)
	);
	

	$wp_customize->add_setting(
		'newsmunch_hs_hdr_btn' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 8,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_hdr_btn', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'newsmunch' ),
			'section'     => 'newsmunch_hdr_nav',
			'type'        => 'checkbox'
		) 
	);
	
	// Button Label // 
	$wp_customize->add_setting(
    	'newsmunch_hdr_btn_lbl',
    	array(
	        'default'			=> __('Subscribe','newsmunch'),
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'capability' => 'edit_theme_options',
			'transport'         => $selective_refresh,
			'priority' => 9,
		)
	);	

	$wp_customize->add_control( 
		'newsmunch_hdr_btn_lbl',
		array(
		    'label'   		=> __('Button Label','newsmunch'),
		    'section' 		=> 'newsmunch_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	// Button Link // 
	$wp_customize->add_setting(
    	'newsmunch_hdr_btn_link',
    	array(
			'default'			=> '#',
			'sanitize_callback' => 'newsmunch_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 10,
		)
	);	

	$wp_customize->add_control( 
		'newsmunch_hdr_btn_link',
		array(
		    'label'   		=> __('Button Link','newsmunch'),
		    'section' 		=> 'newsmunch_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	
	// Open New Tab
	$wp_customize->add_setting( 
		'newsmunch_hdr_btn_target' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 11,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hdr_btn_target', 
		array(
			'label'	      => esc_html__( 'Open in New Tab ?', 'newsmunch' ),
			'section'     => 'newsmunch_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	
	/*=========================================
	Header Banner
	=========================================*/	
	$wp_customize->add_setting(
		'newsmunch_hdr_banner'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hdr_banner',
		array(
			'type' => 'hidden',
			'label' => __('Advertise Banner','newsmunch'),
			'section' => 'newsmunch_hdr_nav',
		)
	);
	

	$wp_customize->add_setting(
		'newsmunch_hs_hdr_banner' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 13,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_hdr_banner', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'newsmunch' ),
			'section'     => 'newsmunch_hdr_nav',
			'type'        => 'checkbox'
		) 
	);
	
	//  Image // 
    $wp_customize->add_setting( 
    	'newsmunch_hdr_banner_img' , 
    	array(
			'default' 			=> esc_url(get_template_directory_uri() .'/assets/img/promo-news.png'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_url',	
			'priority' => 13,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'newsmunch_hdr_banner_img' ,
		array(
			'label'          => esc_html__( 'Image', 'newsmunch'),
			'section'        => 'newsmunch_hdr_nav',
		) 
	));
	
	// Button Link // 
	$wp_customize->add_setting(
    	'newsmunch_hdr_banner_link',
    	array(
			'default'			=> '#',
			'sanitize_callback' => 'newsmunch_sanitize_url',
			'capability' => 'edit_theme_options',
			'priority' => 15,
		)
	);	

	$wp_customize->add_control( 
		'newsmunch_hdr_banner_link',
		array(
		    'label'   		=> __('Link','newsmunch'),
		    'section' 		=> 'newsmunch_hdr_nav',
			'type'		 =>	'text'
		)  
	);
	
	
	// Open New Tab
	$wp_customize->add_setting( 
		'newsmunch_hdr_banner_target' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 16,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hdr_banner_target', 
		array(
			'label'	      => esc_html__( 'Open in New Tab ?', 'newsmunch' ),
			'section'     => 'newsmunch_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	
	/*=========================================
	Header Docker
	=========================================*/	
	$wp_customize->add_setting(
		'newsmunch_hdr_docker'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 16,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hdr_docker',
		array(
			'type' => 'hidden',
			'label' => __('Menu Side Docker','newsmunch'),
			'section' => 'newsmunch_hdr_nav',
		)
	);
	$wp_customize->add_setting( 
		'newsmunch_hs_side_docker' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 16,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_side_docker', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'newsmunch' ),
			'section'     => 'newsmunch_hdr_nav',
			'type'        => 'checkbox'
		) 
	);	
	
	/*=========================================
	Sticky Header
	=========================================*/	
	$wp_customize->add_section(
        'newsmunch_sticky_header_set',
        array(
        	'priority'      => 4,
            'title' 		=> __('Header Sticky','newsmunch'),
			'panel'  		=> 'header_options',
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'newsmunch_hdr_sticky'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hdr_sticky',
		array(
			'type' => 'hidden',
			'label' => __('Sticky Header','newsmunch'),
			'section' => 'newsmunch_sticky_header_set',
		)
	);
	$wp_customize->add_setting( 
		'newsmunch_hs_hdr_sticky' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_hdr_sticky', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'newsmunch' ),
			'section'     => 'newsmunch_sticky_header_set',
			'type'        => 'checkbox'
		) 
	);	
}
add_action( 'customize_register', 'newsmunch_header_customize_settings' );

