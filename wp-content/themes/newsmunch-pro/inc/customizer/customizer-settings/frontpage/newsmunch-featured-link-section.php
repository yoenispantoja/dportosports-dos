<?php
function newsmunch_featured_link_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Featured Link Section Panel
	=========================================*/
	$wp_customize->add_section(
		'featured_link_options', array(
			'title' => esc_html__( 'Featured Link Section', 'newsmunch-pro' ),
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
			'label' => __('Featured Link Setting','newsmunch-pro'),
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
			'label'	      => esc_html__( 'Hide/Show?', 'newsmunch-pro' ),
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
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_display_featured_link' , 
		array(
			'label'          => __( 'Display Featured Link on', 'newsmunch-pro' ),
			'section'        => 'featured_link_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'front' 	=> __( 'Front Page', 'newsmunch-pro' ),
				'post' 	=> __( 'Post Page', 'newsmunch-pro' ),
				'front_post' 	=> __( 'Front & Post Page', 'newsmunch-pro' ),
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
			'label' => __('Featured Link Content','newsmunch-pro'),
			'section' => 'featured_link_options',
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_featured_link_ttl',
    	array(
	        'default'			=> __('Featured Story','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_featured_link_ttl',
		array(
		    'label'   => __('Title','newsmunch-pro'),
		    'section' => 'featured_link_options',
			'type'           => 'text',
		)  
	);
	
	// Type
	$wp_customize->add_setting( 
		'newsmunch_featured_link_content_type' , 
			array(
			'default' => 'post',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_featured_link_content_type' , 
		array(
			'label'          => __( 'Select Content Type', 'newsmunch-pro' ),
			'section'        => 'featured_link_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'post' 	=> __( 'Post', 'newsmunch-pro' ),
				'category' 	=> __( 'Category', 'newsmunch-pro' ),
			) 
		) 
	);
	
	// Type
	$wp_customize->add_setting( 
		'newsmunch_featured_link_type' , 
			array(
			'default' => 'category',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_featured_link_type' , 
		array(
			'label'          => __( 'Select Category Type', 'newsmunch-pro' ),
			'section'        => 'featured_link_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'custom' 	=> __( 'Custom', 'newsmunch-pro' ),
				'category' 	=> __( 'Category', 'newsmunch-pro' ),
			) 
		) 
	);
	
	// Featured Link 
		$wp_customize->add_setting( 'newsmunch_featured_link_custom', 
			array(
			 'sanitize_callback' => 'newsmunch_repeater_sanitize',
			 'priority' => 4,
			  'default' => newsmunch_featured_link_custom_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new NewsMunch_Repeater( $wp_customize, 
				'newsmunch_featured_link_custom', 
					array(
						'label'   => esc_html__('Featured Link','newsmunch-pro'),
						'section' => 'featured_link_options',
						'add_field_label'                   => esc_html__( 'Add New Featured Link', 'newsmunch-pro' ),
						'item_name'                         => esc_html__( 'Featured Link', 'newsmunch-pro' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_subtitle2_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_image_control' => true
					) 
				) 
			);
	
	// Type
	$wp_customize->add_setting( 
		'newsmunch_featured_link_post_style' , 
			array(
			'default' => 'style-1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_featured_link_post_style' , 
		array(
			'label'          => __( 'Select Post Style', 'newsmunch-pro' ),
			'section'        => 'featured_link_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'style-1' 	=> __( 'Style 1', 'newsmunch-pro' ),
				'style-2' 	=> __( 'Style 2', 'newsmunch-pro' ),
				'style-3' 	=> __( 'Style 3', 'newsmunch-pro' ),
			) 
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
	$wp_customize->add_control( new Category_Dropdown_Custom_Control( $wp_customize, 
	'newsmunch_featured_link_cat', 
		array(
		'label'   => __('Select Post Category','newsmunch-pro'),
		'description'   => __('Posts to be shown on slider section','newsmunch-pro'),
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
			'label'	      => esc_html__( 'Hide/Show Title?', 'newsmunch-pro' ),
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
			'label'	      => esc_html__( 'Hide/Show Category?', 'newsmunch-pro' ),
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
			'label'	      => esc_html__( 'Hide/Show Author?', 'newsmunch-pro' ),
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
			'label'	      => esc_html__( 'Hide/Show Date?', 'newsmunch-pro' ),
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
			'label'	      => esc_html__( 'Hide/Show Comment?', 'newsmunch-pro' ),
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
			'label'	      => esc_html__( 'Hide/Show Views?', 'newsmunch-pro' ),
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
			'label'	      => esc_html__( 'Hide/Show Post Format Icon?', 'newsmunch-pro' ),
			'section'     => 'featured_link_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Column
	$wp_customize->add_setting( 
		'newsmunch_featured_link_column' , 
			array(
			'default' => '5',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_featured_link_column' , 
		array(
			'label'          => __( 'Select Column', 'newsmunch-pro' ),
			'section'        => 'featured_link_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'2' 	=> __( '2 Column', 'newsmunch-pro' ),
				'3' 	=> __( '3 Column', 'newsmunch-pro' ),
				'4' 	=> __( '4 Column', 'newsmunch-pro' ),
				'5' 	=> __( '5 Column', 'newsmunch-pro' ),
				'6' 	=> __( '6 Column', 'newsmunch-pro' ),
			) 
		) 
	);
	
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
			'label' => __('Before / After Content','newsmunch-pro'),
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
			'label'	=> __('Select Page For Before Section','newsmunch-pro'),
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
			'label'	=> __('Select Page For After Section','newsmunch-pro'),
			'section'	=> 'featured_link_options',
		)
	);
}
add_action( 'customize_register', 'newsmunch_featured_link_customize_setting' );