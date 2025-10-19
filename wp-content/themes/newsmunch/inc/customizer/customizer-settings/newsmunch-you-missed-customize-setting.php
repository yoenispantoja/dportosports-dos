<?php
function newsmunch_you_missed_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	You Missed Section Panel
	=========================================*/
	$wp_customize->add_section(
		'you_missed_options', array(
			'title' => esc_html__( 'You Missed Section', 'newsmunch' ),
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
			'label' => __('You Missed Setting','newsmunch'),
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
			'label'	      => esc_html__( 'Hide/Show?', 'newsmunch' ),
			'section'     => 'you_missed_options',
			'type'        => 'checkbox'
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
			'label' => __('You Missed Content Head','newsmunch'),
			'section' => 'you_missed_options',
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_you_missed_ttl',
    	array(
	        'default'			=> __('You Missed','newsmunch'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_you_missed_ttl',
		array(
		    'label'   => __('Title','newsmunch'),
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
			'label' => __('You Missed Content','newsmunch'),
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
	$wp_customize->add_control( new Newsmunch_Post_Category_Control( $wp_customize, 
	'newsmunch_you_missed_cat', 
		array(
		'label'   => __('Select Category','newsmunch'),
		'description'   => __('Posts to be shown on You Missed section','newsmunch'),
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
			'label'	      => esc_html__( 'Hide/Show Title?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Category?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Author?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Date?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show View?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Comment?', 'newsmunch' ),
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
			'label'	      => esc_html__( 'Hide/Show Post Format Icon?', 'newsmunch' ),
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
				'label'      => __( 'Number of You Missed', 'newsmunch' ),
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
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'newsmunch_you_missed_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 6,
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'newsmunch_you_missed_option_upsale', 
				array(
					'label'      => __( 'You Missed Types', 'newsmunch' ),
					'section'    => 'you_missed_options'
				) 
			) 
		);	
	}
}
add_action( 'customize_register', 'newsmunch_you_missed_customize_setting' );