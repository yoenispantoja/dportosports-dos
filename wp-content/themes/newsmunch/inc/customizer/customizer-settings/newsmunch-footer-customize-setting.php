<?php
function newsmunch_footer_customize_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	// Footer Section Panel // 
	$wp_customize->add_panel( 
		'footer_options', 
		array(
			'priority'      => 34,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Footer Options', 'newsmunch'),
		) 
	);
	
	/*=========================================
	Footer Widget
	=========================================*/
	$wp_customize->add_section(
        'newsmunch_footer_widget',
        array(
            'title' 		=> __('Footer Widget','newsmunch'),
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
			'label' => __('Footer Widget','newsmunch'),
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
		    'label'   		=> __('Select Widget Column','newsmunch'),
		    'section' 		=> 'newsmunch_footer_widget',
			'type'			=> 'select',
			'choices'        => 
			array(
				'' => __( 'None', 'newsmunch' ),
				'4' => __( '4 Column', 'newsmunch' )
			) 
		) 
	);
	
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'newsmunch_footer_widget_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'priority' => 3,
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'newsmunch_footer_widget_upsale', 
				array(
					'label'      => __( 'Widgets Columns', 'newsmunch' ),
					'section'    => 'newsmunch_footer_widget'
				) 
			) 
		);
	}	
	
	
	/*=========================================
	Footer Copright
	=========================================*/
	$wp_customize->add_section(
        'newsmunch_footer_copyright',
        array(
            'title' 		=> __('Footer Copright','newsmunch'),
			'panel'  		=> 'footer_options',
			'priority'      => 4,
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
			'label' => __('Copyright','newsmunch'),
			'section' => 'newsmunch_footer_copyright',
			'priority'  => 3,
		)
	);
	
	// footer  text // 
	$newsmunch_copyright = esc_html__('Copyright &copy; [current_year] [site_title] | Powered by [theme_author]', 'newsmunch' );
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
		    'label'   		=> __('Copyright','newsmunch'),
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
			'label' => __('Social','newsmunch'),
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
			'label'	      => esc_html__( 'Hide/Show ?', 'newsmunch' ),
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
						'label'   => esc_html__('Social Icons','newsmunch'),
						'priority' => 5,
						'section' => 'newsmunch_footer_copyright',
						'customizer_repeater_icon_control' => true,
						'customizer_repeater_link_control' => true,
					) 
				) 
			);
			
	// Upgrade
	if ( class_exists( 'Desert_Companion_Customize_Upgrade_Control' ) ) {
		$wp_customize->add_setting(
		'newsmunch_footer_social_option_upsale', 
		array(
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		));
		
		$wp_customize->add_control( 
			new Desert_Companion_Customize_Upgrade_Control
			($wp_customize, 
				'newsmunch_footer_social_option_upsale', 
				array(
					'label'      => __( 'Icons', 'newsmunch' ),
					'section'    => 'newsmunch_footer_copyright',
					'priority' => 5,
				) 
			) 
		);
	}	
}
add_action( 'customize_register', 'newsmunch_footer_customize_settings' );