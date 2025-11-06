<?php
function newsmunch_layout_options_customize( $wp_customize ){

	/* layout manager section */
	$wp_customize->add_section( 'frontpage_layout' , array(
		'title'      => __('Frontpage Layout', 'newsmunch-pro'),
		'priority'       => 39,
   	) );
	
	/*=========================================
	Frontpage Head
	=========================================*/
	$wp_customize->add_setting(
		'frontpage_layout_header'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'frontpage_layout_header',
		array(
			'type' => 'hidden',
			'label' => __('Frontpage Head Layout','newsmunch-pro'),
			'section' => 'frontpage_layout',
			'priority'  => 1,
		)
	);
	
	 $wp_customize->add_setting( 
		'newsmunch_frontpage_layout_head' , 
			array(
			'default'   => array(
							'top_tags_option',
							'slider_option',
							'featured_link_option'
						),
		'sanitize_callback' => 'newsmunch_sanitize_sortable',
		) 
	);
	
	$wp_customize->add_control( 
	new NewsMunch_Control_Sortable( $wp_customize, 'newsmunch_frontpage_layout_head', 
		array(
			'label'      => __( 'Frontpage Header Layout', 'newsmunch-pro' ),
			'section'     => 'frontpage_layout',
			'priority'      => 2,
			'choices'     => array(
				'top_tags_option'     => __( 'Top Tags Section', 'newsmunch-pro' ),
				'slider_option'     => __( 'Slider Section', 'newsmunch-pro' ),
				'featured_link_option'     => __( 'Featured Link Section', 'newsmunch-pro' ),
			),
		) ) 
	);	
	
	/*=========================================
	Frontpage Footer
	=========================================*/
	$wp_customize->add_setting(
		'frontpage_layout_footer'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
		)
	);

	$wp_customize->add_control(
	'frontpage_layout_footer',
		array(
			'type' => 'hidden',
			'label' => __('Frontpage Footer Layout','newsmunch-pro'),
			'section' => 'frontpage_layout',
			'priority'  => 3,
		)
	);
	
	 $wp_customize->add_setting( 
		'newsmunch_frontpage_layout_footer' , 
			array(
		'sanitize_callback' => 'newsmunch_sanitize_sortable',
		) 
	);
	
	$wp_customize->add_control( 
	new NewsMunch_Control_Sortable( $wp_customize, 'newsmunch_frontpage_layout_footer', 
		array(
			'label'      => __( 'Frontpage Footer Layout', 'newsmunch-pro' ),
			'section'     => 'frontpage_layout',
			'priority'      => 4,
			'choices'     => array(
				'about_option'     => __( 'About Section', 'newsmunch-pro' ),
				 'skill_option'     => __( 'Skill Section', 'newsmunch-pro' ),
				 'team_option'     => __( 'Team Section', 'newsmunch-pro' ),
				 'faq_option'     => __( 'FAQ Section', 'newsmunch-pro' ),
				 'contact_info_option'     => __( 'Contact Info Section', 'newsmunch-pro' ),
				 'contact_form_option'     => __( 'Contact Form Section', 'newsmunch-pro' ),
				 'contact_map_option'     => __( 'Contact Map Section', 'newsmunch-pro' ),
			),
		) ) 
	);
	
}
add_action( 'customize_register', 'newsmunch_layout_options_customize' );