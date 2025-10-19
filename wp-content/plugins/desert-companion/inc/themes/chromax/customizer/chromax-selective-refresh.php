<?php
function desert_chromax_site_selective_partials( $wp_customize ){		
	// chromax_about_left_ttl
	$wp_customize->selective_refresh->add_partial( 'chromax_about_left_ttl', array(
		'selector'            => '.front-about .section-title .sub-title .text-animate',
		'settings'            => 'chromax_about_left_ttl',
		'render_callback'  => 'chromax_about_left_ttl_render_callback',
	) );
	
	// chromax_about_left_subttl
	$wp_customize->selective_refresh->add_partial( 'chromax_about_left_subttl', array(
		'selector'            => '.front-about .section-title .title',
		'settings'            => 'chromax_about_left_subttl',
		'render_callback'  => 'chromax_about_left_subttl_render_callback',
	) );
	
	// chromax_service_ttl
	$wp_customize->selective_refresh->add_partial( 'chromax_service_ttl', array(
		'selector'            => '.front-service .section-title .sub-title .text-animate',
		'settings'            => 'chromax_service_ttl',
		'render_callback'  => 'chromax_service_ttl_render_callback',
	) );
	
	// chromax_service_subttl
	$wp_customize->selective_refresh->add_partial( 'chromax_service_subttl', array(
		'selector'            => '.front-service .section-title .title',
		'settings'            => 'chromax_service_subttl',
		'render_callback'  => 'chromax_service_subttl_render_callback',
	) );
	
	// chromax_service_text
	$wp_customize->selective_refresh->add_partial( 'chromax_service_text', array(
		'selector'            => '.front-service .dt-mt-5.dt-text-center .text',
		'settings'            => 'chromax_service_text',
		'render_callback'  => 'chromax_service_text_render_callback',
	) );
	
	// chromax_service_btn_lbl
	$wp_customize->selective_refresh->add_partial( 'chromax_service_btn_lbl', array(
		'selector'            => '.front-service .dt-mt-5.dt-text-center .dt-btn',
		'settings'            => 'chromax_service_btn_lbl',
		'render_callback'  => 'chromax_service_btn_lbl_render_callback',
	) );
	
	// chromax_service_option
	$wp_customize->selective_refresh->add_partial( 'chromax_service_option', array(
		'selector'            => '.front-service .dt-row.dt-g-4',
	) );
	
	// chromax_why_choose_left_ttl
	$wp_customize->selective_refresh->add_partial( 'chromax_why_choose_left_ttl', array(
		'selector'            => '.front-whychooseus .section-title .sub-title .text-animate',
		'settings'            => 'chromax_why_choose_left_ttl',
		'render_callback'  => 'chromax_why_choose_left_ttl_render_callback',
	) );
	
	// chromax_why_choose_left_subttl
	$wp_customize->selective_refresh->add_partial( 'chromax_why_choose_left_subttl', array(
		'selector'            => '.front-whychooseus .section-title .title',
		'settings'            => 'chromax_why_choose_left_subttl',
		'render_callback'  => 'chromax_why_choose_left_subttl_render_callback',
	) );
	
	// chromax_why_choose_left_text
	$wp_customize->selective_refresh->add_partial( 'chromax_why_choose_left_text', array(
		'selector'            => '.front-whychooseus .section-title .desc',
		'settings'            => 'chromax_why_choose_left_text',
		'render_callback'  => 'chromax_why_choose_left_text_render_callback',
	) );
	
	// chromax_blog_ttl
	$wp_customize->selective_refresh->add_partial( 'chromax_blog_ttl', array(
		'selector'            => '.front-posts .section-title .sub-title .text-animate',
		'settings'            => 'chromax_blog_ttl',
		'render_callback'  => 'chromax_blog_ttl_render_callback',
	) );
	
	// chromax_blog_subttl
	$wp_customize->selective_refresh->add_partial( 'chromax_blog_subttl', array(
		'selector'            => '.front-posts .section-title .title',
		'settings'            => 'chromax_blog_subttl',
		'render_callback'  => 'chromax_blog_subttl_render_callback',
	) );
	}
add_action( 'customize_register', 'desert_chromax_site_selective_partials' );