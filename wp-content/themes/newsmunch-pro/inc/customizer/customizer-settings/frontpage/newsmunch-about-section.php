<?php
function newsmunch_about_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	About Section Panel
	=========================================*/
	$wp_customize->add_section(
		'about_options', array(
			'title' => esc_html__( 'About Section', 'newsmunch-pro' ),
			'panel' => 'newsmunch_frontpage_options',
			'priority' => 8,
		)
	);
	
	/*=========================================
	About Content 
	=========================================*/
	$wp_customize->add_setting(
		'about_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'about_options_head',
		array(
			'type' => 'hidden',
			'label' => __('About Content','newsmunch-pro'),
			'section' => 'about_options',
		)
	);
	
	//  Image // 
    $wp_customize->add_setting( 
    	'newsmunch_about_img' , 
    	array(
			'default' 			=> esc_url(get_template_directory_uri() .'/assets/img/other/about.png'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_url',	
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'newsmunch_about_img' ,
		array(
			'label'          => esc_html__( 'Image', 'newsmunch-pro'),
			'section'        => 'about_options',
		) 
	));
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_about_ttl',
    	array(
	        'default'			=> __('WHO WE ARE','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_about_ttl',
		array(
		    'label'   => __('Title','newsmunch-pro'),
		    'section' => 'about_options',
			'type'           => 'text',
		)  
	);
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'newsmunch_about_subttl',
    	array(
	        'default'			=> __('More Than 25+ Years We Provide True News','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_about_subttl',
		array(
		    'label'   => __('Subtitle','newsmunch-pro'),
		    'section' => 'about_options',
			'type'           => 'text',
		)  
	);
	
	//  Description // 
	$wp_customize->add_setting(
    	'newsmunch_about_text',
    	array(
	        'default'			=> __('Nec nascetur mus vicolor rhoncus augue quisque parturient etiam imperdet sit nisi tellus veni faucibus orcimperdiet venena nullam rhoncus curabitur monteante.
                                <br><br>
                                Nec nascetur mus vicolor rhoncus augue quisque parturient etiam imperdet sit nisi tellus veni faucibus orcimperdiet venena nullam rhoncus curabitur monteante.','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_about_text',
		array(
		    'label'   => __('Description','newsmunch-pro'),
		    'section' => 'about_options',
			'type'           => 'textarea',
		)  
	);
	
	if ( class_exists( 'NewsMunch_Page_Editor' ) ) {
		$newsmunch_page_editor_path = trailingslashit( get_template_directory() ) . 'inc/customizer/controls/code/editor/customizer-page-editor.php';
		if ( file_exists( $newsmunch_page_editor_path ) ) {
			require_once( $newsmunch_page_editor_path );
		}
		$wp_customize->add_setting(
			'newsmunch_about_content', array(
				'default' => '<div class="dt_section_hr"></div>
                            <ul class="dt_section_list">
                                <li>Company and research</li>
                                <li>Endless possibilities</li>
                                <li>Business and research</li>
                                <li>Awesome projects</li>
                            </ul>',
				'sanitize_callback' => 'wp_kses_post',
				'priority' => 3,
				
			)
		);

		$wp_customize->add_control(
			new NewsMunch_Page_Editor(
				$wp_customize, 'newsmunch_about_content', array(
					'label' => esc_html__( 'Content', 'newsmunch-pro' ),
					'section' => 'about_options',
					'needsync' => true,
				)
			)
		);
	}
	
	//  Button Label // 
	$wp_customize->add_setting(
    	'newsmunch_about_btn_lbl',
    	array(
	        'default'			=> __('Contact Now','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_about_btn_lbl',
		array(
		    'label'   => __('Button Label','newsmunch-pro'),
		    'section' => 'about_options',
			'type'           => 'text',
		)  
	);
	
	
	//  Link // 
	$wp_customize->add_setting(
    	'newsmunch_about_btn_link',
    	array(
	        'default'			=> '#',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_url',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_about_btn_link',
		array(
		    'label'   => __('Link','newsmunch-pro'),
		    'section' => 'about_options',
			'type'           => 'text',
		)  
	);
	
	/*=========================================
	About After Before
	=========================================*/
	$wp_customize->add_setting(
		'about_option_before_after'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'about_option_before_after',
		array(
			'type' => 'hidden',
			'label' => __('Before / After Content','newsmunch-pro'),
			'section' => 'about_options',
		)
	);
	
	// Before
	$wp_customize->add_setting(
	'newsmunch_about_option_before',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 13,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_about_option_before',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For Before Section','newsmunch-pro'),
			'section'	=> 'about_options',
		)
	);	
	
	// After
	$wp_customize->add_setting(
	'newsmunch_about_option_after',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 14,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_about_option_after',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For After Section','newsmunch-pro'),
			'section'	=> 'about_options',
		)
	);
}
add_action( 'customize_register', 'newsmunch_about_customize_setting' );