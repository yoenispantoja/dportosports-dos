<?php
function newsmunch_you_missed_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	You Missed Section Panel
	=========================================*/
	$wp_customize->add_section(
		'you_missed_options', array(
			'title' => esc_html__( 'You Missed Section', 'newsmunch-pro' ),
			'panel' => 'footer_options',
			'priority' => 1,
		)
	);
	
	/*=========================================
	You Missed Setting
	=========================================*/
	$wp_customize->add_setting(
		'you_missed_setting_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'you_missed_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('You Missed Setting','newsmunch-pro'),
			'section' => 'you_missed_options',
		)
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_you_missed' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_you_missed', 
		array(
			'label'	      => esc_html__( 'Hide/Show?', 'newsmunch-pro' ),
			'section'     => 'you_missed_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Type
	$wp_customize->add_setting( 
		'newsmunch_you_missed_post_style' , 
			array(
			'default' => 'style-1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_you_missed_post_style' , 
		array(
			'label'          => __( 'Select Post Style', 'newsmunch-pro' ),
			'section'        => 'you_missed_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'style-1' 	=> __( 'Style 1', 'newsmunch-pro' ),
				'style-2' 	=> __( 'Style 2', 'newsmunch-pro' ),
				'style-3' 	=> __( 'Style 3', 'newsmunch-pro' ),
			) 
		) 
	);
	
	/*=========================================
	You Missed Content 
	=========================================*/
	$wp_customize->add_setting(
		'you_missed_options_heading'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'you_missed_options_heading',
		array(
			'type' => 'hidden',
			'label' => __('You Missed Content Head','newsmunch-pro'),
			'section' => 'you_missed_options',
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_you_missed_ttl',
    	array(
	        'default'			=> __('You Missed','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_you_missed_ttl',
		array(
		    'label'   => __('Title','newsmunch-pro'),
		    'section' => 'you_missed_options',
			'type'           => 'text',
		)  
	);
	
	/*=========================================
	You Missed Content
	=========================================*/
	$wp_customize->add_setting(
		'you_missed_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'you_missed_options_head',
		array(
			'type' => 'hidden',
			'label' => __('You Missed Content','newsmunch-pro'),
			'section' => 'you_missed_options',
		)
	);
	
	// Select Blog Category
	$wp_customize->add_setting(
    'newsmunch_you_missed_cat',
		array(
		'default'	      => '0',	
		'capability' => 'edit_theme_options',
		'priority' => 4,
		'sanitize_callback' => 'absint'
		)
	);	
	$wp_customize->add_control( new Category_Dropdown_Custom_Control( $wp_customize, 
	'newsmunch_you_missed_cat', 
		array(
		'label'   => __('Select Category','newsmunch-pro'),
		'description'   => __('Posts to be shown on You Missed section','newsmunch-pro'),
		'section' => 'you_missed_options',
		) 
	) );
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_you_missed_title' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_you_missed_title', 
		array(
			'label'	      => esc_html__( 'Hide/Show Title?', 'newsmunch-pro' ),
			'section'     => 'you_missed_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_you_missed_cat_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_you_missed_cat_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Category?', 'newsmunch-pro' ),
			'section'     => 'you_missed_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_you_missed_auth_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_you_missed_auth_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Author?', 'newsmunch-pro' ),
			'section'     => 'you_missed_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_you_missed_date_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_you_missed_date_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Date?', 'newsmunch-pro' ),
			'section'     => 'you_missed_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_you_missed_view_meta' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_you_missed_view_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show View?', 'newsmunch-pro' ),
			'section'     => 'you_missed_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_you_missed_comment_meta' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_you_missed_comment_meta', 
		array(
			'label'	      => esc_html__( 'Hide/Show Comment?', 'newsmunch-pro' ),
			'section'     => 'you_missed_options',
			'type'        => 'checkbox'
		) 
	);
	
	// Hide / Show
	$wp_customize->add_setting( 
		'newsmunch_hs_you_missed_pf' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 2,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_hs_you_missed_pf', 
		array(
			'label'	      => esc_html__( 'Hide/Show Post Format Icon?', 'newsmunch-pro' ),
			'section'     => 'you_missed_options',
			'type'        => 'checkbox'
		) 
	);
	
	// No. of Slides
	if ( class_exists( 'NewsMunch_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'newsmunch_num_you_missed',
			array(
				'default' => '6',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'priority' => 11,
			)
		);
		$wp_customize->add_control( 
		new NewsMunch_Customizer_Range_Control( $wp_customize, 'newsmunch_num_you_missed', 
			array(
				'label'      => __( 'Number of You Missed', 'newsmunch-pro' ),
				'section'  => 'you_missed_options',
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

	// Column
	$wp_customize->add_setting( 
		'newsmunch_you_missed_column' , 
			array(
			'default' => '4',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_you_missed_column' , 
		array(
			'label'          => __( 'Select Column', 'newsmunch-pro' ),
			'section'        => 'you_missed_options',
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
	You Missed After Before
	=========================================*/
	$wp_customize->add_setting(
		'you_missed_option_before_after'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'you_missed_option_before_after',
		array(
			'type' => 'hidden',
			'label' => __('Before / After Content','newsmunch-pro'),
			'section' => 'you_missed_options',
		)
	);
	
	// Before
	$wp_customize->add_setting(
	'newsmunch_you_missed_option_before',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 13,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_you_missed_option_before',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For Before Section','newsmunch-pro'),
			'section'	=> 'you_missed_options',
		)
	);	
	
	// After
	$wp_customize->add_setting(
	'newsmunch_you_missed_option_after',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 14,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_you_missed_option_after',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For After Section','newsmunch-pro'),
			'section'	=> 'you_missed_options',
		)
	);
}
add_action( 'customize_register', 'newsmunch_you_missed_customize_setting' );