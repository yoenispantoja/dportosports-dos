<?php
function newsmunch_typography_customize( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	

	$wp_customize->add_panel(
		'newsmunch_typography_options', array(
			'priority' => 38,
			'title' => esc_html__( 'Typography', 'newsmunch' ),
		)
	);	
	
	/*=========================================
	NewsMunch Typography
	=========================================*/
	$wp_customize->add_section(
        'newsmunch_typography_options',
        array(
        	'priority'      => 1,
            'title' 		=> __('Body Typography','newsmunch'),
			'panel'  		=> 'newsmunch_typography_options',
		)
    );
	
	 /**
     * Font Family
     */
	
	$wp_customize->add_setting( 'newsmunch_body_font_family_option', array(
      'capability'        => 'edit_theme_options',
      'default'           => '',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'newsmunch_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'newsmunch_body_font_family_option', array(
            'label'       => __( 'Font Family', 'newsmunch' ),
            'section'     => 'newsmunch_typography_options',
            'type'        =>  'select',
            'priority'    => 1,
            'choices'     =>  array(
                ''   =>  __( 'Default', 'newsmunch' ),
                ),
            )
        )
    );
	
	// Body Font Size // 
	if ( class_exists( 'NewsMunch_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'newsmunch_body_font_size_option',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new NewsMunch_Customizer_Range_Control( $wp_customize, 'newsmunch_body_font_size_option', 
			array(
				'label'      => __( 'Size', 'newsmunch' ),
				'section'  => 'newsmunch_typography_options',
				'priority'      => 2,
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 1,
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
	
	// Body Font Size // 
	if ( class_exists( 'NewsMunch_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'newsmunch_body_line_height_option',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new NewsMunch_Customizer_Range_Control( $wp_customize, 'newsmunch_body_line_height_option', 
			array(
				'label'      => __( 'Line Height', 'newsmunch' ),
				'section'  => 'newsmunch_typography_options',
				'priority'      => 3,
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.6,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.6,
                    ),
                    'desktop' => array(
                       'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.6,
                    ),
				)	
			) ) 
		);
	}
	
	// Body Font Size // 
	if ( class_exists( 'NewsMunch_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'newsmunch_body_ltr_space_option',
			array(
                'default'           => '0.1',
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new NewsMunch_Customizer_Range_Control( $wp_customize, 'newsmunch_body_ltr_space_option', 
			array(
				'label'      => __( 'Letter Spacing', 'newsmunch' ),
				'section'  => 'newsmunch_typography_options',
				'priority'      => 4,
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0,
                    ),
                    'tablet'  => array(
                       'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0,
                    ),
                    'desktop' => array(
                       'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0,
                    ),
				)	
			) ) 
		);
	}
	
	// Body Font weight // 
	 $wp_customize->add_setting( 'newsmunch_body_font_weight_option', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'newsmunch_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'newsmunch_body_font_weight_option', array(
            'label'       => __( 'Weight', 'newsmunch' ),
            'section'     => 'newsmunch_typography_options',
            'type'        =>  'select',
            'priority'    => 5,
            'choices'     =>  array(
                'inherit'   =>  __( 'Default', 'newsmunch' ),
                '100'       =>  __( 'Thin: 100', 'newsmunch' ),
                '200'       =>  __( 'Light: 200', 'newsmunch' ),
                '300'       =>  __( 'Book: 300', 'newsmunch' ),
                '400'       =>  __( 'Normal: 400', 'newsmunch' ),
                '500'       =>  __( 'Medium: 500', 'newsmunch' ),
                '600'       =>  __( 'Semibold: 600', 'newsmunch' ),
                '700'       =>  __( 'Bold: 700', 'newsmunch' ),
                '800'       =>  __( 'Extra Bold: 800', 'newsmunch' ),
                '900'       =>  __( 'Black: 900', 'newsmunch' ),
                ),
            )
        )
    );
	
	// Body Font style // 
	 $wp_customize->add_setting( 'newsmunch_body_font_style_option', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'newsmunch_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'newsmunch_body_font_style_option', array(
            'label'       => __( 'Font Style', 'newsmunch' ),
            'section'     => 'newsmunch_typography_options',
            'type'        =>  'select',
            'priority'    => 6,
            'choices'     =>  array(
                'inherit'   =>  __( 'Inherit', 'newsmunch' ),
                'normal'       =>  __( 'Normal', 'newsmunch' ),
                'italic'       =>  __( 'Italic', 'newsmunch' ),
                'oblique'       =>  __( 'oblique', 'newsmunch' ),
                ),
            )
        )
    );
	// Body Text Transform // 
	 $wp_customize->add_setting( 'newsmunch_body_text_transform_option', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'newsmunch_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'newsmunch_body_text_transform_option', array(
                'label'       => __( 'Transform', 'newsmunch' ),
                'section'     => 'newsmunch_typography_options',
                'type'        => 'select',
                'priority'    => 7,
                'choices'     => array(
                    'inherit'       =>  __( 'Default', 'newsmunch' ),
                    'uppercase'     =>  __( 'Uppercase', 'newsmunch' ),
                    'lowercase'     =>  __( 'Lowercase', 'newsmunch' ),
                    'capitalize'    =>  __( 'Capitalize', 'newsmunch' ),
                ),
            )
        )
    );
	
	// Body Text Decoration // 
	 $wp_customize->add_setting( 'newsmunch_body_txt_decoration_option', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'newsmunch_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'newsmunch_body_txt_decoration_option', array(
                'label'       => __( 'Text Decoration', 'newsmunch' ),
                'section'     => 'newsmunch_typography_options',
                'type'        => 'select',
                'priority'    => 8,
                'choices'     => array(
                    'inherit'       =>  __( 'Inherit', 'newsmunch' ),
                    'underline'     =>  __( 'Underline', 'newsmunch' ),
                    'overline'     =>  __( 'Overline', 'newsmunch' ),
                    'line-through'    =>  __( 'Line Through', 'newsmunch' ),
					'none'    =>  __( 'None', 'newsmunch' ),
                ),
            )
        )
    );
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'newsmunch_body_typography_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'newsmunch_body_typography_option_upsale', 
				array(
					'label'      => __( 'Typography Features', 'newsmunch' ),
					'section'    => 'newsmunch_typography_options',
					'priority' => 8,
				) 
			) 
		);	
	}
	/*=========================================
	 NewsMunch Typography Headings
	=========================================*/
	$wp_customize->add_section(
        'newsmunch_headings_typography',
        array(
        	'priority'      => 2,
            'title' 		=> __('Headings (H1-H6) Typography','newsmunch'),
			'panel'  		=> 'newsmunch_typography_options',
		)
    );
	
	/*=========================================
	 NewsMunch Typography H1
	=========================================*/
	for ( $i = 1; $i <= 6; $i++ ) {
	if($i  == '1'){$j=36;}elseif($i  == '2'){$j=32;}elseif($i  == '3'){$j=28;}elseif($i  == '4'){$j=24;}elseif($i  == '5'){$j=20;}else{$j=16;}
	$wp_customize->add_setting(
		'h' . $i . '_typography'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'h' . $i . '_typography',
		array(
			'type' => 'hidden',
			'label' => esc_html('H' . $i .' Typography','newsmunch'),
			'section' => 'newsmunch_headings_typography',
		)
	);
	
	
	$wp_customize->add_setting( 'newsmunch_h' . $i . '_font_family_option', array(
      'capability'        => 'edit_theme_options',
      'default'           => '',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'newsmunch_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'newsmunch_h' . $i . '_font_family_option', array(
            'label'       => __( 'Font Family', 'newsmunch' ),
            'section'     => 'newsmunch_headings_typography',
            'type'        =>  'select',
            'choices'     =>  array(
                ''   =>  __( 'Default', 'newsmunch' ),
                ),
            )
        )
    );
	

	// Heading Font Size // 
	if ( class_exists( 'NewsMunch_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'newsmunch_h' . $i . '_font_size_option',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'transport'         => 'postMessage'
			)
		);
		$wp_customize->add_control( 
		new NewsMunch_Customizer_Range_Control( $wp_customize, 'newsmunch_h' . $i . '_font_size_option', 
			array(
				'label'      => __( 'Font Size', 'newsmunch' ),
				'section'  => 'newsmunch_headings_typography',
				'media_query'   => true,
				'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 1,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => $j,
                    ),
                    'tablet'  => array(
                        'min'           => 1,
                        'max'           => 100,
                        'step'          => 1,
                        'default_value' => $j,
                    ),
                    'desktop' => array(
                       'min'           => 1,
                        'max'           => 100,
                        'step'          => 1,
					    'default_value' => $j,
                    ),
				)	
			) ) 
		);
	}
	
	// Heading Font Size // 
	if ( class_exists( 'NewsMunch_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'newsmunch_h' . $i . '_line_height_option',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new NewsMunch_Customizer_Range_Control( $wp_customize, 'newsmunch_h' . $i . '_line_height_option', 
			array(
				'label'      => __( 'Line Height', 'newsmunch' ),
				'section'  => 'newsmunch_headings_typography',
				'media_query'   => true,
				'input_attrs' => array(
					'min'    => 0,
					'max'    => 5,
					'step'   => 0.1,
					//'suffix' => 'px', //optional suffix
				),
				 'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.2,
                    ),
                    'tablet'  => array(
                        'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.2,
                    ),
                    'desktop' => array(
                       'min'           => 0,
                        'max'           => 3,
                        'step'          => 0.1,
                        'default_value' => 1.2,
                    ),
				)	
			) ) 
		);
		}
	// Heading Letter Spacing // 
	if ( class_exists( 'NewsMunch_Customizer_Range_Control' ) ) {
		$wp_customize->add_setting(
			'newsmunch_h' . $i . '_ltr_space_option',
			array(
				'capability'     	=> 'edit_theme_options',
				'sanitize_callback' => 'newsmunch_sanitize_range_value',
				'transport'         => 'postMessage',
			)
		);
		$wp_customize->add_control( 
		new NewsMunch_Customizer_Range_Control( $wp_customize, 'newsmunch_h' . $i . '_ltr_space_option', 
			array(
				'label'      => __( 'Letter Spacing', 'newsmunch' ),
				'section'  => 'newsmunch_headings_typography',
				 'media_query'   => true,
                'input_attr'    => array(
                    'mobile'  => array(
                        'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0.1,
                    ),
                    'tablet'  => array(
                       'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0.1,
                    ),
                    'desktop' => array(
                       'min'           => -10,
                        'max'           => 10,
                        'step'          => 1,
                        'default_value' => 0.1,
                    ),
				)	
			) ) 
		);
	}
	
	// Heading Font weight // 
	 $wp_customize->add_setting( 'newsmunch_h' . $i . '_font_weight_option', array(
		  'capability'        => 'edit_theme_options',
		  'default'           => '700',
		  'transport'         => 'postMessage',
		  'sanitize_callback' => 'newsmunch_sanitize_select',
		) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'newsmunch_h' . $i . '_font_weight_option', array(
            'label'       => __( 'Font Weight', 'newsmunch' ),
            'section'     => 'newsmunch_headings_typography',
            'type'        =>  'select',
            'choices'     =>  array(
                'inherit'   =>  __( 'Inherit', 'newsmunch' ),
                '100'       =>  __( 'Thin: 100', 'newsmunch' ),
                '200'       =>  __( 'Light: 200', 'newsmunch' ),
                '300'       =>  __( 'Book: 300', 'newsmunch' ),
                '400'       =>  __( 'Normal: 400', 'newsmunch' ),
                '500'       =>  __( 'Medium: 500', 'newsmunch' ),
                '600'       =>  __( 'Semibold: 600', 'newsmunch' ),
                '700'       =>  __( 'Bold: 700', 'newsmunch' ),
                '800'       =>  __( 'Extra Bold: 800', 'newsmunch' ),
                '900'       =>  __( 'Black: 900', 'newsmunch' ),
                ),
            )
        )
    );
	
	// Heading Font style // 
	 $wp_customize->add_setting( 'newsmunch_h' . $i . '_font_style_option', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'newsmunch_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
                $wp_customize, 'newsmunch_h' . $i . '_font_style_option', array(
            'label'       => __( 'Font Style', 'newsmunch' ),
            'section'     => 'newsmunch_headings_typography',
            'type'        =>  'select',
            'choices'     =>  array(
                'inherit'   =>  __( 'Inherit', 'newsmunch' ),
                'normal'       =>  __( 'Normal', 'newsmunch' ),
                'italic'       =>  __( 'Italic', 'newsmunch' ),
                'oblique'       =>  __( 'oblique', 'newsmunch' ),
                ),
            )
        )
    );
	
	// Heading Text Transform // 
	 $wp_customize->add_setting( 'newsmunch_h' . $i . '_text_transform_option', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'newsmunch_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'newsmunch_h' . $i . '_text_transform_option', array(
                'label'       => __( 'Text Transform', 'newsmunch' ),
                'section'     => 'newsmunch_headings_typography',
                'type'        => 'select',
                'choices'     => array(
                    'inherit'       =>  __( 'Default', 'newsmunch' ),
                    'uppercase'     =>  __( 'Uppercase', 'newsmunch' ),
                    'lowercase'     =>  __( 'Lowercase', 'newsmunch' ),
                    'capitalize'    =>  __( 'Capitalize', 'newsmunch' ),
                ),
            )
        )
    );
	
	// Heading Text Decoration // 
	 $wp_customize->add_setting( 'newsmunch_h' . $i . '_txt_decoration_option', array(
      'capability'        => 'edit_theme_options',
      'default'           => 'inherit',
      'transport'         => 'postMessage',
      'sanitize_callback' => 'newsmunch_sanitize_select',
    ) );

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize, 'newsmunch_h' . $i . '_txt_decoration_option', array(
                'label'       => __( 'Text Decoration', 'newsmunch' ),
                'section'     => 'newsmunch_headings_typography',
                'type'        => 'select',
                'choices'     => array(
                    'inherit'       =>  __( 'Inherit', 'newsmunch' ),
                    'underline'     =>  __( 'Underline', 'newsmunch' ),
                    'overline'     =>  __( 'Overline', 'newsmunch' ),
                    'line-through'    =>  __( 'Line Through', 'newsmunch' ),
					'none'    =>  __( 'None', 'newsmunch' ),
                ),
            )
        )
    );
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'newsmunch_h' . $i . '_typography_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'newsmunch_h' . $i . '_typography_option_upsale', 
				array(
					'label'      => __( 'Typography Features', 'newsmunch' ),
					'section'    => 'newsmunch_headings_typography',
				) 
			) 
		);	
	}
}
}
add_action( 'customize_register', 'newsmunch_typography_customize' );