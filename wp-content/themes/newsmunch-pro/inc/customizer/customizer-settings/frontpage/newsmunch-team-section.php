<?php
function newsmunch_team_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Team Section Panel
	=========================================*/
	$wp_customize->add_section(
		'team_options', array(
			'title' => esc_html__( 'Team Section', 'newsmunch-pro' ),
			'panel' => 'newsmunch_frontpage_options',
			'priority' => 8,
		)
	);
	
	/*=========================================
	Team Content 
	=========================================*/
	$wp_customize->add_setting(
		'team_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'team_options_head',
		array(
			'type' => 'hidden',
			'label' => __('Team Content','newsmunch-pro'),
			'section' => 'team_options',
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_team_ttl',
    	array(
	        'default'			=> __('Meet Our Team','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_team_ttl',
		array(
		    'label'   => __('Title','newsmunch-pro'),
		    'section' => 'team_options',
			'type'           => 'text',
		)  
	);
	
	
	// Team 
		$wp_customize->add_setting( 'newsmunch_team_option', 
			array(
			 'sanitize_callback' => 'newsmunch_repeater_sanitize',
			 'priority' => 5,
			  'default' => newsmunch_team_options_default()
			)
		);
		
		$wp_customize->add_control( 
			new NewsMunch_Repeater( $wp_customize, 
				'newsmunch_team_option', 
					array(
						'label'   => esc_html__('Team','newsmunch-pro'),
						'section' => 'team_options',
						'add_field_label'                   => esc_html__( 'Add New Team', 'newsmunch-pro' ),
						'item_name'                         => esc_html__( 'Team', 'newsmunch-pro' ),
						
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_image_control' => true,
						'customizer_repeater_repeater_control' => true,
					) 
				) 
			);
			
	// Column
	$wp_customize->add_setting( 
		'newsmunch_team_column' , 
			array(
			'default' => '3',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 6,
		) 
	);

	$wp_customize->add_control(
	'newsmunch_team_column' , 
		array(
			'label'          => __( 'Select Column', 'newsmunch-pro' ),
			'section'        => 'team_options',
			'type'           => 'select',
			'choices'        => 
			array(
				'12' 	=> __( '1 Column', 'newsmunch-pro' ),
				'6' 	=> __( '2 Column', 'newsmunch-pro' ),
				'4' 	=> __( '3 Column', 'newsmunch-pro' ),
				'3' 	=> __( '4 Column', 'newsmunch-pro' ),
			) 
		) 
	);
	
	/*=========================================
	Team After Before
	=========================================*/
	$wp_customize->add_setting(
		'team_option_before_after'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'team_option_before_after',
		array(
			'type' => 'hidden',
			'label' => __('Before / After Content','newsmunch-pro'),
			'section' => 'team_options',
		)
	);
	
	// Before
	$wp_customize->add_setting(
	'newsmunch_team_option_before',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 13,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_team_option_before',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For Before Section','newsmunch-pro'),
			'section'	=> 'team_options',
		)
	);	
	
	// After
	$wp_customize->add_setting(
	'newsmunch_team_option_after',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 14,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_team_option_after',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For After Section','newsmunch-pro'),
			'section'	=> 'team_options',
		)
	);
}
add_action( 'customize_register', 'newsmunch_team_customize_setting' );