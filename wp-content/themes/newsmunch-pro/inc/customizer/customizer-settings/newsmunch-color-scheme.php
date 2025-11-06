<?php
function newsmunch_color_scheme_customize_setting( $wp_customize ) {
	/*=========================================
	Color Scheme
	=========================================*/
	$wp_customize->add_section(
        'color_scheme',
        array(
            'title' 		=> __('Theme Color Scheme','newsmunch-pro'),
			'priority'      => 37,
		)
    );
	
	/*=========================================
	Predefine Color
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_predefine_color_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_predefine_color_options',
		array(
			'type' => 'hidden',
			'label' => __('Predefine Color','newsmunch-pro'),
			'section' => 'color_scheme',
		)
	);

	//Predefine Color
	$wp_customize->add_setting(
	'newsmunch_predefine_color', array(
		'default' => '#1151D3',  
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'priority' => 2,
    ));
	$wp_customize->add_control(new NewsMunch_Predefine_Color_Control($wp_customize,'newsmunch_predefine_color',
	array(
        'section' => 'color_scheme',
		'label' => __('Color','newsmunch-pro'),
			'type' => 'radio',	
			'choices' => array(
				'#1151D3' => '#1151D3',
				'#FF003D' => '#FF003D',
				'#FF4C60' => '#FF4C60',
				'#0476D0' => '#0476D0',
				'#6a2dec' => '#6a2dec',
				'#F79489' => '#F79489',
				'#3D5B59' => '#3D5B59',
				'#041F60' => '#041F60',
				'#167D7F' => '#167D7F',
				'#E1C340' => '#E1C340'
			)
		)
	));
	
	/*=========================================
	Custom Color
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_custom_color_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 3,
		)
	);

	$wp_customize->add_control(
	'newsmunch_custom_color_options',
		array(
			'type' => 'hidden',
			'label' => __('Custom Color','newsmunch-pro'),
			'section' => 'color_scheme',
		)
	);
	
	// Enable Custom Color
	$wp_customize->add_setting( 
		'newsmunch_enable_custom_color' , 
			array(
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_enable_custom_color', 
		array(
			'label'	      => esc_html__( 'Enable/Disable Custom Color ?', 'newsmunch-pro' ),
			'section'     => 'color_scheme',
			'type'        => 'checkbox'
		) 
	);	
	
	// Primary Color
	$wp_customize->add_setting(
	'newsmunch_primary_color', 
	array(
		'default' => '#1151D3',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'priority'  => 5,
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'newsmunch_primary_color', 
			array(
				'label'      => __( 'Primary Color', 'newsmunch-pro'),
				'section'    => 'color_scheme',
			) 
		) 
	);
	
	// Secondary Color
	$wp_customize->add_setting(
	'newsmunch_secondary_color', 
	array(
		'default' => '#121418',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		'priority'  => 5,
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'newsmunch_secondary_color', 
			array(
				'label'      => __( 'Secondary Color', 'newsmunch-pro'),
				'section'    => 'color_scheme',
			) 
		) 
	);
	
	
	/*=========================================
	Layout
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_theme_layout_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 6,
		)
	);

	$wp_customize->add_control(
	'newsmunch_theme_layout_options',
		array(
			'type' => 'hidden',
			'label' => __('Layout','newsmunch-pro'),
			'section' => 'color_scheme',
		)
	);
	
	// Layout
	$wp_customize->add_setting( 
		'newsmunch_theme_layout_option' , 
			array(
			'default' => 'wide-layout',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
		) 
	);

	$wp_customize->add_control(
	'newsmunch_theme_layout_option' , 
		array(
			'label'          => __( 'Select Page Layout', 'newsmunch-pro' ),
			'section'        => 'color_scheme',
			'type'           => 'select',
			'choices'        => 
			array(
				'wide-layout' 	=> __( 'Wide', 'newsmunch-pro' ),
				'boxed-layout' 	=> __( 'Boxed', 'newsmunch-pro' )
			) 
		) 
	);
	
	// Background Pattern // 
	$wp_customize->add_setting( 
		'newsmunch_theme_layout_style' , 
			array(
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);

	$wp_customize->add_control(new NewsMunch_Predefine_Pattern_Control($wp_customize,
	'newsmunch_theme_layout_style' , 
		array(
			'label'          => __( 'Background Pattern', 'newsmunch-pro' ),
			'section'        => 'color_scheme',
			'type'           => 'radio',
			'description'    => __( 'Pattern Only Work with Boxed', 'newsmunch-pro' ),
			'choices'        => 
			array(
				'1.png' => '1.png',
				'2.png' => '2.png',
				'3.png' => '3.png',
				'4.png' => '4.png',
				'5.png' => '5.png',
				'6.png' => '6.png',
				'7.png' => '7.png',
				'8.png' => '8.png',
			) 
		) 
	) );
	
	/*=========================================
	Front Color Switcher
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_front_color_switcher_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'newsmunch_front_color_switcher_options',
		array(
			'type' => 'hidden',
			'label' => __('Front Color Switcher','newsmunch-pro'),
			'section' => 'color_scheme',
		)
	);
	
	// Enable Front Color Switcher
	$wp_customize->add_setting( 
		'newsmunch_enable_front_color_switcher' , 
			array(
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'capability' => 'edit_theme_options',
			'priority' => 13,
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_enable_front_color_switcher', 
		array(
			'label'	      => esc_html__( 'Enable/Disable Front Color Switcher ?', 'newsmunch-pro' ),
			'section'     => 'color_scheme',
			'type'        => 'checkbox'
		) 
	);
	
}

add_action( 'customize_register', 'newsmunch_color_scheme_customize_setting' );