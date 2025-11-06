<?php
function newsmunch_typography_customize( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	

	$wp_customize->add_panel(
		'newsmunch_typography_options', array(
			'priority' => 38,
			'title' => esc_html__( 'Typography', 'newsmunch-pro' ),
		)
	);	
	
	/*=========================================
	NewsMunch Typography
	=========================================*/
	$wp_customize->add_section(
        'newsmunch_typography_options',
        array(
        	'priority'      => 1,
            'title' 		=> __('Body Typography','newsmunch-pro'),
			'panel'  		=> 'newsmunch_typography_options',
		)
    );
	
	 /**
     * Font Family
     */

    $wp_customize->add_setting(
        'newsmunch_body_font_family_option', array(
            'capability'        => 'edit_theme_options',
            'type'              => 'theme_mod',
            'sanitize_callback' => 'newsmunch_sanitize_typography_fonts',
        )
    );

    $wp_customize->add_control(
        new NewsMunch_Font_Selector(
            $wp_customize, 'newsmunch_body_font_family_option', array(
                'label'             => esc_html__( 'Font Family', 'newsmunch-pro' ),
                'section'           => 'newsmunch_typography_options',
                'priority'          => 1,
                'type'              => 'select',
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
				'label'      => __( 'Size', 'newsmunch-pro' ),
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
				'label'      => __( 'Line Height', 'newsmunch-pro' ),
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
				'label'      => __( 'Letter Spacing', 'newsmunch-pro' ),
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
            'label'       => __( 'Weight', 'newsmunch-pro' ),
            'section'     => 'newsmunch_typography_options',
            'type'        =>  'select',
            'priority'    => 5,
            'choices'     =>  array(
                'inherit'   =>  __( 'Default', 'newsmunch-pro' ),
                '100'       =>  __( 'Thin: 100', 'newsmunch-pro' ),
                '200'       =>  __( 'Light: 200', 'newsmunch-pro' ),
                '300'       =>  __( 'Book: 300', 'newsmunch-pro' ),
                '400'       =>  __( 'Normal: 400', 'newsmunch-pro' ),
                '500'       =>  __( 'Medium: 500', 'newsmunch-pro' ),
                '600'       =>  __( 'Semibold: 600', 'newsmunch-pro' ),
                '700'       =>  __( 'Bold: 700', 'newsmunch-pro' ),
                '800'       =>  __( 'Extra Bold: 800', 'newsmunch-pro' ),
                '900'       =>  __( 'Black: 900', 'newsmunch-pro' ),
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
            'label'       => __( 'Font Style', 'newsmunch-pro' ),
            'section'     => 'newsmunch_typography_options',
            'type'        =>  'select',
            'priority'    => 6,
            'choices'     =>  array(
                'inherit'   =>  __( 'Inherit', 'newsmunch-pro' ),
                'normal'       =>  __( 'Normal', 'newsmunch-pro' ),
                'italic'       =>  __( 'Italic', 'newsmunch-pro' ),
                'oblique'       =>  __( 'oblique', 'newsmunch-pro' ),
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
                'label'       => __( 'Transform', 'newsmunch-pro' ),
                'section'     => 'newsmunch_typography_options',
                'type'        => 'select',
                'priority'    => 7,
                'choices'     => array(
                    'inherit'       =>  __( 'Default', 'newsmunch-pro' ),
                    'uppercase'     =>  __( 'Uppercase', 'newsmunch-pro' ),
                    'lowercase'     =>  __( 'Lowercase', 'newsmunch-pro' ),
                    'capitalize'    =>  __( 'Capitalize', 'newsmunch-pro' ),
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
                'label'       => __( 'Text Decoration', 'newsmunch-pro' ),
                'section'     => 'newsmunch_typography_options',
                'type'        => 'select',
                'priority'    => 8,
                'choices'     => array(
                    'inherit'       =>  __( 'Inherit', 'newsmunch-pro' ),
                    'underline'     =>  __( 'Underline', 'newsmunch-pro' ),
                    'overline'     =>  __( 'Overline', 'newsmunch-pro' ),
                    'line-through'    =>  __( 'Line Through', 'newsmunch-pro' ),
					'none'    =>  __( 'None', 'newsmunch-pro' ),
                ),
            )
        )
    );
	/*=========================================
	 NewsMunch Typography Headings
	=========================================*/
	$wp_customize->add_section(
        'newsmunch_headings_typography',
        array(
        	'priority'      => 2,
            'title' 		=> __('Headings (H1-H6) Typography','newsmunch-pro'),
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
			'label' => esc_html('H' . $i .' Typography','newsmunch-pro'),
			'section' => 'newsmunch_headings_typography',
		)
	);
	
    $wp_customize->add_setting(
        'newsmunch_h' . $i . '_font_family_option', array(
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'newsmunch_sanitize_typography_fonts',
        )
    );

    $wp_customize->add_control(
        new NewsMunch_Font_Selector(
            $wp_customize, 'newsmunch_h' . $i . '_font_family_option', array(
                'label'             => esc_html__( 'Font Family', 'newsmunch-pro' ),
                'section'           => 'newsmunch_headings_typography',
                'type'              => 'select',
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
				'label'      => __( 'Font Size', 'newsmunch-pro' ),
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
				'label'      => __( 'Line Height', 'newsmunch-pro' ),
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
				'label'      => __( 'Letter Spacing', 'newsmunch-pro' ),
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
            'label'       => __( 'Font Weight', 'newsmunch-pro' ),
            'section'     => 'newsmunch_headings_typography',
            'type'        =>  'select',
            'choices'     =>  array(
                'inherit'   =>  __( 'Inherit', 'newsmunch-pro' ),
                '100'       =>  __( 'Thin: 100', 'newsmunch-pro' ),
                '200'       =>  __( 'Light: 200', 'newsmunch-pro' ),
                '300'       =>  __( 'Book: 300', 'newsmunch-pro' ),
                '400'       =>  __( 'Normal: 400', 'newsmunch-pro' ),
                '500'       =>  __( 'Medium: 500', 'newsmunch-pro' ),
                '600'       =>  __( 'Semibold: 600', 'newsmunch-pro' ),
                '700'       =>  __( 'Bold: 700', 'newsmunch-pro' ),
                '800'       =>  __( 'Extra Bold: 800', 'newsmunch-pro' ),
                '900'       =>  __( 'Black: 900', 'newsmunch-pro' ),
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
            'label'       => __( 'Font Style', 'newsmunch-pro' ),
            'section'     => 'newsmunch_headings_typography',
            'type'        =>  'select',
            'choices'     =>  array(
                'inherit'   =>  __( 'Inherit', 'newsmunch-pro' ),
                'normal'       =>  __( 'Normal', 'newsmunch-pro' ),
                'italic'       =>  __( 'Italic', 'newsmunch-pro' ),
                'oblique'       =>  __( 'oblique', 'newsmunch-pro' ),
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
                'label'       => __( 'Text Transform', 'newsmunch-pro' ),
                'section'     => 'newsmunch_headings_typography',
                'type'        => 'select',
                'choices'     => array(
                    'inherit'       =>  __( 'Default', 'newsmunch-pro' ),
                    'uppercase'     =>  __( 'Uppercase', 'newsmunch-pro' ),
                    'lowercase'     =>  __( 'Lowercase', 'newsmunch-pro' ),
                    'capitalize'    =>  __( 'Capitalize', 'newsmunch-pro' ),
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
                'label'       => __( 'Text Decoration', 'newsmunch-pro' ),
                'section'     => 'newsmunch_headings_typography',
                'type'        => 'select',
                'choices'     => array(
                    'inherit'       =>  __( 'Inherit', 'newsmunch-pro' ),
                    'underline'     =>  __( 'Underline', 'newsmunch-pro' ),
                    'overline'     =>  __( 'Overline', 'newsmunch-pro' ),
                    'line-through'    =>  __( 'Line Through', 'newsmunch-pro' ),
					'none'    =>  __( 'None', 'newsmunch-pro' ),
                ),
            )
        )
    );
}
}
add_action( 'customize_register', 'newsmunch_typography_customize' );