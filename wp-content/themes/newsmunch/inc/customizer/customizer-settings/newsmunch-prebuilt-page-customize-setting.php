<?php
function newsmunch_prebuilt_pg_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	NewsMunch Page Templates
	=========================================*/
	$wp_customize->add_panel(
		'newsmunch_pages_options', array(
			'priority' => 33,
			'title' => esc_html__( 'Theme Prebuilt Pages', 'newsmunch' ),
		)
	);
	/*=========================================
	404 Page
	=========================================*/
	$wp_customize->add_section(
		'404_pg_options', array(
			'title' => esc_html__( '404 Page', 'newsmunch' ),
			'priority' => 4,
			'panel' => 'newsmunch_pages_options',
		)
	);
	
	/*=========================================
	404 Page
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_pg_404_head_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_404_head_options',
		array(
			'type' => 'hidden',
			'label' => __('404 Page','newsmunch'),
			'section' => '404_pg_options',
		)
	);
	
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_pg_404_ttl',
    	array(
	        'default'			=> __('<b class="is_on">Page Not Found</b><b>Page Not Found</b><b>Page Not Found</b>','newsmunch'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_pg_404_ttl',
		array(
		    'label'   => __('Title','newsmunch'),
		    'section' => '404_pg_options',
			'type'           => 'text',
		)  
	);
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'newsmunch_pg_404_subttl2',
    	array(
	        'default'			=> __("Oops! That page can't be found.",'newsmunch'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'priority' => 2,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_pg_404_subttl2',
		array(
		    'label'   => __('Subtitle','newsmunch'),
		    'section' => '404_pg_options',
			'type'           => 'text',
		)  
	);
	
	
	//  Button Label // 
	$wp_customize->add_setting(
    	'newsmunch_pg_404_btn_lbl',
    	array(
	        'default'			=> __('Return To Home','newsmunch'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_pg_404_btn_lbl',
		array(
		    'label'   => __('Button Label','newsmunch'),
		    'section' => '404_pg_options',
			'type'           => 'text',
		)  
	);
	
	//  Button Link // 
	$wp_customize->add_setting(
    	'newsmunch_pg_404_btn_link',
    	array(
	        'default'			=> esc_url( home_url( '/' ) ),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_url',
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_pg_404_btn_link',
		array(
		    'label'   => __('Button Link','newsmunch'),
		    'section' => '404_pg_options',
			'type'           => 'text',
		)  
	);
	
	
	
	
	/*=========================================
	Single Page
	=========================================*/
	$wp_customize->add_section(
		'single_pg_options', array(
			'title' => esc_html__( 'Single Page', 'newsmunch' ),
			'priority' => 4,
			'panel' => 'newsmunch_pages_options',
		)
	);
	
	/*=========================================
	Single Page Author
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_pg_single_head_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_single_head_options',
		array(
			'type' => 'hidden',
			'label' => __('Single Page','newsmunch'),
			'section' => 'single_pg_options',
		)
	);
	
	// Hide/Show
	$wp_customize->add_setting(
		'newsmunch_hs_single_author_option'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hs_single_author_option',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Single Post Author?','newsmunch'),
			'section' => 'single_pg_options',
		)
	);
	
	// Hide/Show
	$wp_customize->add_setting(
		'newsmunch_hs_single_post_nav'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hs_single_post_nav',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Single Post Navigation?','newsmunch'),
			'section' => 'single_pg_options',
		)
	);
	
	/*=========================================
	Related Post
	=========================================*/
	$wp_customize->add_setting(
		'newsmunch_pg_single_related_post_head_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_pg_single_related_post_head_options',
		array(
			'type' => 'hidden',
			'label' => __('Related Post','newsmunch'),
			'section' => 'single_pg_options',
		)
	);
	
	// Hide/Show
	$wp_customize->add_setting(
		'newsmunch_hs_single_related_post'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_checkbox',
			'priority' => 1,
		)
	);

	$wp_customize->add_control(
	'newsmunch_hs_single_related_post',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Related Post?','newsmunch'),
			'section' => 'single_pg_options',
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_related_post_ttl',
    	array(
	        'default'			=> __('Related Posts','newsmunch'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_related_post_ttl',
		array(
		    'label'   => __('Title','newsmunch'),
		    'section' => 'single_pg_options',
			'type'           => 'text',
		)  
	);
}
add_action( 'customize_register', 'newsmunch_prebuilt_pg_customize_setting' );