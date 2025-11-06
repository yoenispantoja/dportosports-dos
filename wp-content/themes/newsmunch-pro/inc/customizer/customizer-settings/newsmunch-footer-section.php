<?php
function newsmunch_footer_customize_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	// Footer Section Panel // 
	$wp_customize->add_panel( 
		'footer_options', 
		array(
			'priority'      => 34,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Footer Options', 'newsmunch-pro'),
		) 
	);
	
	/*=========================================
	Footer Widget
	=========================================*/
	$wp_customize->add_section(
        'newsmunch_footer_widget',
        array(
            'title' 		=> __('Footer Widget','newsmunch-pro'),
			'panel'  		=> 'footer_options',
			'priority'      => 3,
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'newsmunch_footer_widget_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'newsmunch_footer_widget_head',
		array(
			'type' => 'hidden',
			'label' => __('Footer Widget','newsmunch-pro'),
			'section' => 'newsmunch_footer_widget',
			'priority'  => 1,
		)
	);
	
	
	// column // 
	$wp_customize->add_setting(
    	'newsmunch_footer_widget_column',
    	array(
	        'default'			=> '4',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
			'priority' => 3,
		)
	);	

	$wp_customize->add_control(
		'newsmunch_footer_widget_column',
		array(
		    'label'   		=> __('Select Widget Column','newsmunch-pro'),
		    'section' 		=> 'newsmunch_footer_widget',
			'type'			=> 'select',
			'choices'        => 
			array(
				'' => __( 'None', 'newsmunch-pro' ),
				'1' => __( '1 Column', 'newsmunch-pro' ),
				'2' => __( '2 Column', 'newsmunch-pro' ),
				'3' => __( '3 Column', 'newsmunch-pro' ),
				'4' => __( '4 Column', 'newsmunch-pro' )
			) 
		) 
	);
	
	
	/*=========================================
	Footer Copright
	=========================================*/
	$wp_customize->add_section(
        'newsmunch_footer_copyright',
        array(
            'title' 		=> __('Footer Copright','newsmunch-pro'),
			'panel'  		=> 'footer_options',
			'priority'      => 4,
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'newsmunch_footer_copyright_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'newsmunch_footer_copyright_head',
		array(
			'type' => 'hidden',
			'label' => __('Setting','newsmunch-pro'),
			'section' => 'newsmunch_footer_copyright',
			'priority'  => 1,
		)
	);
	

	// Style // 
	$wp_customize->add_setting(
    	'newsmunch_footer_cp_style',
    	array(
	        'default'			=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
		)
	);	

	$wp_customize->add_control(
		'newsmunch_footer_cp_style',
		array(
		    'label'   		=> __('Style','newsmunch-pro'),
		    'section' 		=> 'newsmunch_footer_copyright',
			'type'			=> 'select',
			'priority'  => 3,
			'choices'        => 
			array(
				'1' => __( 'Style 1', 'newsmunch-pro' ),
				'2' => __( 'Style 2', 'newsmunch-pro' )
			) 
		) 
	);
	
	
	// Heading
	$wp_customize->add_setting(
		'newsmunch_footer_copyright_first_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'newsmunch_footer_copyright_first_head',
		array(
			'type' => 'hidden',
			'label' => __('Copyright','newsmunch-pro'),
			'section' => 'newsmunch_footer_copyright',
			'priority'  => 3,
		)
	);
	
	// footer  text // 
	$newsmunch_copyright = esc_html__('Copyright &copy; [current_year] [site_title] | Powered by [theme_author]', 'newsmunch-pro' );
	$wp_customize->add_setting(
    	'newsmunch_footer_copyright_text',
    	array(
			'default' => $newsmunch_copyright,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
		)
	);	

	$wp_customize->add_control( 
		'newsmunch_footer_copyright_text',
		array(
		    'label'   		=> __('Copyright','newsmunch-pro'),
		    'section'		=> 'newsmunch_footer_copyright',
			'type' 			=> 'textarea',
			'priority'      => 4,
		)  
	);	
	
	
	// Heading
	$wp_customize->add_setting(
		'newsmunch_footer_copyright_social_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'newsmunch_footer_copyright_social_head',
		array(
			'type' => 'hidden',
			'label' => __('Social','newsmunch-pro'),
			'section' => 'newsmunch_footer_copyright',
			'priority'  => 5,
		)
	);
	
	// Hide/Show
	$wp_customize->add_setting( 
		'newsmunch_footer_copyright_social_hs' , 
			array(
			'default' => '1',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
		) 
	);
	
	$wp_customize->add_control(
	'newsmunch_footer_copyright_social_hs', 
		array(
			'label'	      => esc_html__( 'Hide/Show ?', 'newsmunch-pro' ),
			'section'     => 'newsmunch_footer_copyright',
			'type'        => 'checkbox',
			'priority' => 5,
		) 
	);
	
	/**
	 * Customizer Repeater
	 */
		$wp_customize->add_setting( 'newsmunch_footer_copyright_social', 
			array(
			 'sanitize_callback' => 'newsmunch_repeater_sanitize',
			 'default' => newsmunch_get_social_icon_default()
		)
		);
		
		$wp_customize->add_control( 
			new NEWSMUNCH_Repeater( $wp_customize, 
				'newsmunch_footer_copyright_social', 
					array(
						'label'   => esc_html__('Social Icons','newsmunch-pro'),
						'priority' => 5,
						'section' => 'newsmunch_footer_copyright',
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_link_control' => true,
					) 
				) 
			);
	
	/*=========================================
	Footer Background
	=========================================*/
	$wp_customize->add_section(
        'footer_background_options',
        array(
            'title' 		=> __('Footer Background','newsmunch-pro'),
			'panel'  		=> 'footer_options',
			'priority'      => 4,
		)
    );
	
	// Heading
	$wp_customize->add_setting(
		'footer_background_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text'
		)
	);

	$wp_customize->add_control(
	'footer_background_head',
		array(
			'type' => 'hidden',
			'label' => __('Footer Background','newsmunch-pro'),
			'section' => 'footer_background_options',
			'priority' => 4,
		)
	);
	
	// Style // 
	$wp_customize->add_setting(
    	'newsmunch_footer_style',
    	array(
	        'default'			=> 'footer-dark',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_select',
		)
	);	

	$wp_customize->add_control(
		'newsmunch_footer_style',
		array(
		    'label'   		=> __('Style','newsmunch-pro'),
		    'section' 		=> 'footer_background_options',
			'type'			=> 'select',
			'priority'  => 4,
			'choices'        => 
			array(
				'footer-light' => __( 'Light', 'newsmunch-pro' ),
				'footer-dark' => __( 'Dark', 'newsmunch-pro' )
			) 
		) 
	);
	
	//  Color
	$wp_customize->add_setting(
	'newsmunch_footer_text_color', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '#5c6777'
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'newsmunch_footer_text_color', 
			array(
				'label'      => __( 'Footer Text Color', 'newsmunch-pro' ),
				'section'    => 'footer_background_options',
			) 
		) 
	);
	
	//  Footer Background Color
	$wp_customize->add_setting(
	'newsmunch_footer_bg_color', 
	array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'default' => '#121418'
    ));
	
	$wp_customize->add_control( 
		new WP_Customize_Color_Control
		($wp_customize, 
			'newsmunch_footer_bg_color', 
			array(
				'label'      => __( 'Footer Background Color', 'newsmunch-pro' ),
				'section'    => 'footer_background_options',
			) 
		) 
	);
}
add_action( 'customize_register', 'newsmunch_footer_customize_settings' );