<?php
function newsmunch_skill_customize_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Skill Section Panel
	=========================================*/
	$wp_customize->add_section(
		'skill_options', array(
			'title' => esc_html__( 'Skill Section', 'newsmunch-pro' ),
			'panel' => 'newsmunch_frontpage_options',
			'priority' => 8,
		)
	);
	
	/*=========================================
	Skill Content 
	=========================================*/
	$wp_customize->add_setting(
		'skill_options_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 4,
		)
	);

	$wp_customize->add_control(
	'skill_options_head',
		array(
			'type' => 'hidden',
			'label' => __('Skill Content','newsmunch-pro'),
			'section' => 'skill_options',
		)
	);
	
	//  Title // 
	$wp_customize->add_setting(
    	'newsmunch_skill_ttl',
    	array(
	        'default'			=> __('Progress','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_skill_ttl',
		array(
		    'label'   => __('Title','newsmunch-pro'),
		    'section' => 'skill_options',
			'type'           => 'text',
		)  
	);
	
	//  Subtitle // 
	$wp_customize->add_setting(
    	'newsmunch_skill_subttl',
    	array(
	        'default'			=> __('We Develop & Create Digital Future.','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_skill_subttl',
		array(
		    'label'   => __('Subtitle','newsmunch-pro'),
		    'section' => 'skill_options',
			'type'           => 'text',
		)  
	);
	
	//  Description // 
	$wp_customize->add_setting(
    	'newsmunch_skill_text',
    	array(
	        'default'			=> __('Nec nascetur mus vicideolor rhoncus augue quisque parturientet imperdet sit nisi tellus veni faucibus orcimperdietenatis nullam rhoncus curabitur monteante.','newsmunch-pro'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_html',
			'transport'         => $selective_refresh,
			'priority' => 3,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_skill_text',
		array(
		    'label'   => __('Description','newsmunch-pro'),
		    'section' => 'skill_options',
			'type'           => 'textarea',
		)  
	);
	
	
	// Content
	if ( class_exists( 'NewsMunch_Page_Editor' ) ) {
		$wp_customize->add_setting(
			'newsmunch_skill_content', array(
				'default' => '<div class="dt_skillbars">
                            <div class="dt_skillbars-item">
                                <div class="dt_skillbars-heading">UI/UX Design</div>
                                <div class="dt_skillbars-main" data-percent="70%">
                                    <div class="dt_skillbars-percent"><span class="dt_skillbars-count">70</span>%</div>
                                    <div class="dt_skillbars-line"></div>
                                </div>
                            </div>
                            <div class="dt_skillbars-item">
                                <div class="dt_skillbars-heading">Development</div>
                                <div class="dt_skillbars-main" data-percent="88%">
                                    <div class="dt_skillbars-percent"><span class="dt_skillbars-count">82</span>%</div>
                                    <div class="dt_skillbars-line"></div>
                                </div>
                            </div>
                            <div class="dt_skillbars-item">
                                <div class="dt_skillbars-heading">Success</div>
                                <div class="dt_skillbars-main" data-percent="92%">
                                    <div class="dt_skillbars-percent"><span class="dt_skillbars-count">92</span>%</div>
                                    <div class="dt_skillbars-line"></div>
                                </div>
                            </div>
                            <div class="dt_skillbars-item">
                                <div class="dt_skillbars-heading">Finished Projects</div>
                                <div class="dt_skillbars-main" data-percent="92%">
                                    <div class="dt_skillbars-percent"><span class="dt_skillbars-count">92</span>%</div>
                                    <div class="dt_skillbars-line"></div>
                                </div>
                            </div>
                        </div>',
				'sanitize_callback' => 'wp_kses_post',
				'priority' => 3,
				
			)
		);

		$wp_customize->add_control(
			new NewsMunch_Page_Editor(
				$wp_customize, 'newsmunch_skill_content', array(
					'label' => esc_html__( 'Content', 'newsmunch-pro' ),
					'section' => 'skill_options',
					'needsync' => true,
				)
			)
		);
	}
	
	//  Image // 
    $wp_customize->add_setting( 
    	'newsmunch_skill_img' , 
    	array(
			'default' 			=> esc_url(get_template_directory_uri() .'/assets/img/other/about2.webp'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_url',	
			'priority' => 4,
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'newsmunch_skill_img' ,
		array(
			'label'          => esc_html__( 'Image', 'newsmunch-pro'),
			'section'        => 'skill_options',
		) 
	));
	
	// icon // 
	$wp_customize->add_setting(
    	'newsmunch_skill_icon',
    	array(
	        'default' => 'fas fa-play',
			'sanitize_callback' => 'sanitize_text_field',
			'capability' => 'edit_theme_options',
			'priority' => 4,
		)
	);	

	$wp_customize->add_control(new NewsMunch_Icon_Picker_Control($wp_customize, 
		'newsmunch_skill_icon',
		array(
		    'label'   		=> __('Icon','newsmunch-pro'),
		    'section' 		=> 'skill_options'
			
		))  
	);	
	
	//  Link // 
	$wp_customize->add_setting(
    	'newsmunch_skill_btn_link',
    	array(
	        'default'			=> 'https://www.youtube.com/watch?v=XHOmBV4js_E',
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_url',
			'priority' => 4,
		)
	);	
	
	$wp_customize->add_control( 
		'newsmunch_skill_btn_link',
		array(
		    'label'   => __('Video Link','newsmunch-pro'),
		    'section' => 'skill_options',
			'type'           => 'text',
		)  
	);
	
	/*=========================================
	Skill After Before
	=========================================*/
	$wp_customize->add_setting(
		'skill_option_before_after'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'newsmunch_sanitize_text',
			'priority' => 12,
		)
	);

	$wp_customize->add_control(
	'skill_option_before_after',
		array(
			'type' => 'hidden',
			'label' => __('Before / After Content','newsmunch-pro'),
			'section' => 'skill_options',
		)
	);
	
	// Before
	$wp_customize->add_setting(
	'newsmunch_skill_option_before',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 13,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_skill_option_before',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For Before Section','newsmunch-pro'),
			'section'	=> 'skill_options',
		)
	);	
	
	// After
	$wp_customize->add_setting(
	'newsmunch_skill_option_after',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'newsmunch_sanitize_integer',
			'priority' => 14,
		)
	);
		
	$wp_customize->add_control(
	'newsmunch_skill_option_after',
		array(
			'type'	=> 'dropdown-pages',
			'allow_addition' => true,
			'label'	=> __('Select Page For After Section','newsmunch-pro'),
			'section'	=> 'skill_options',
		)
	);
}
add_action( 'customize_register', 'newsmunch_skill_customize_setting' );