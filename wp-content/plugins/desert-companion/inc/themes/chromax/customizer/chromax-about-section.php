<?php
function chromax_about_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	About  Section
	=========================================*/
	$wp_customize->add_section(
		'about_options', array(
			'title' => esc_html__( 'About Section', 'desert-companion' ),
			'priority' => 3,
			'panel' => 'chromax_frontpage_options',
		)
	);
	
	/*=========================================
	About Setting
	=========================================*/
	$wp_customize->add_setting(
		'about_options_setting_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'about_options_setting_head',
		array(
			'type' => 'hidden',
			'label' => __('About Setting','desert-companion'),
			'section' => 'about_options',
		)
	);

	// Hide/Show Setting
	$wp_customize->add_setting(
		'chromax_about_options_hide_show'
			,array(
			'default'     	=> '1',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_checkbox',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'chromax_about_options_hide_show',
		array(
			'type' => 'checkbox',
			'label' => __('Hide/Show Section','desert-companion'),
			'section' => 'about_options',
		)
	);
	
	/*=========================================
	Left  Section
	=========================================*/
	$wp_customize->add_setting(
		'chromax_about_left_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 5,
		)
	);

	$wp_customize->add_control(
	'chromax_about_left_options',
		array(
			'type' => 'hidden',
			'label' => __('Left Content','desert-companion'),
			'section' => 'about_options',
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'chromax_about_left_ttl',
    	array(
	        'default'			=> __('About us our company','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 6,
		)
	);	
	
	$wp_customize->add_control( 
		'chromax_about_left_ttl',
		array(
		    'label'   => __('Title','desert-companion'),
		    'section' => 'about_options',
			'type'           => 'text',
		)  
	);
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'chromax_about_left_subttl',
    	array(
	        'default'			=> __('Smart & Cost-Efficient <i>Portals</i> with <span>Cutting-Edge</span> Tech','desert-companion'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 7,
		)
	);	
	
	$wp_customize->add_control( 
		'chromax_about_left_subttl',
		array(
		    'label'   => __('Subtitle','desert-companion'),
		    'section' => 'about_options',
			'type'           => 'textarea',
		)  
	);
	//  Content
	if ( class_exists( 'Chromax_Page_Editor' ) ) {
		$chromax_page_editor_path = trailingslashit( get_template_directory() ) . 'inc/customizer/controls/code/editor/customizer-page-editor.php';
		if ( file_exists( $chromax_page_editor_path ) ) {
			require_once( $chromax_page_editor_path );
		}
		$wp_customize->add_setting(
			'chromax_about_left_content', array(
				'default' => ' <div class="text">Renowned as the premier IT services company in the city, our organic nation stands out for its unparalleled expertise, commitment to excellence.</div>
        <div class="about-buttons dt-mt-5">
            <a href="#" class="dt-btn dt-btn-primary">Discover More</a>
        </div>',
				'sanitize_callback' => 'wp_kses_post',
				'priority' => 9,
				
			)
		);

		$wp_customize->add_control(
			new Chromax_Page_Editor(
				$wp_customize, 'chromax_about_left_content', array(
					'label' => esc_html__( 'Content', 'desert-companion' ),
					'section' => 'about_options',
					'needsync' => true,
				)
			)
		);
	}

	/*=========================================
	Right  Section
	=========================================*/
	$wp_customize->add_setting(
		'chromax_about_right_options'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'chromax_sanitize_text',
			'priority' => 10,
		)
	);

	$wp_customize->add_control(
	'chromax_about_right_options',
		array(
			'type' => 'hidden',
			'label' => __('Right Content','desert-companion'),
			'section' => 'about_options',
		)
	);
	
	//  Content
	if ( class_exists( 'Chromax_Page_Editor' ) ) {
		$wp_customize->add_setting(
			'chromax_about_right_content', array(
				'default' => '<div class="about-image"><img src="'.esc_url(desert_companion_plugin_url) .'/inc/themes/chromax/assets/images/about-1.jpg" alt="" /></div>',
				'sanitize_callback' => 'wp_kses_post',
				'priority' => 11,
				
			)
		);

		$wp_customize->add_control(
			new Chromax_Page_Editor(
				$wp_customize, 'chromax_about_right_content', array(
					'label' => esc_html__( 'Content', 'desert-companion' ),
					'section' => 'about_options',
					'needsync' => true,
				)
			)
		);
	}
}
add_action( 'customize_register', 'chromax_about_customize_setting' );