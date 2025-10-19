<?php
function newsmunch_site_selective_partials( $wp_customize ){
	// newsmunch_hdr_left_ttl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_hdr_left_ttl', array(
		'selector'            => '.dt_header .dt_header-topbar .dt-news-headline .dt-news-heading',
		'settings'            => 'newsmunch_hdr_left_ttl',
		'render_callback'  => 'newsmunch_hdr_left_ttl_render_callback',
	) );
	
	// newsmunch_hdr_btn_lbl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_hdr_btn_lbl', array(
		'selector'            => '.dt_header .dt_navbar-button-item .dt-btn',
		'settings'            => 'newsmunch_hdr_btn_lbl',
		'render_callback'  => 'newsmunch_hdr_btn_lbl_render_callback',
	) );
	
	// newsmunch_top_tags_ttl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_top_tags_ttl', array(
		'selector'            => '.exclusive-tags .title',
		'settings'            => 'newsmunch_top_tags_ttl',
		'render_callback'  => 'newsmunch_top_tags_ttl_render_callback',
	) );
	
	// newsmunch_hlatest_story_ttl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_hlatest_story_ttl', array(
		'selector'            => '.exclusive-posts .title',
		'settings'            => 'newsmunch_hlatest_story_ttl',
		'render_callback'  => 'newsmunch_hlatest_story_ttl_render_callback',
	) );
	
	// newsmunch_slider_ttl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_slider_ttl', array(
		'selector'            => '.sl-main .widget-title',
		'settings'            => 'newsmunch_slider_ttl',
		'render_callback'  => 'newsmunch_slider_ttl_render_callback',
	) );
	
	// newsmunch_slider_mdl_ttl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_slider_mdl_ttl', array(
		'selector'            => '.sl-mid .widget-title',
		'settings'            => 'newsmunch_slider_mdl_ttl',
		'render_callback'  => 'newsmunch_slider_mdl_ttl_render_callback',
	) );
	
	// newsmunch_slider_right_ttl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_slider_right_ttl', array(
		'selector'            => '.sl-right .widget-title',
		'settings'            => 'newsmunch_slider_right_ttl',
		'render_callback'  => 'newsmunch_slider_right_ttl_render_callback',
	) );
	
	// newsmunch_featured_link_ttl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_featured_link_ttl', array(
		'selector'            => '.fl-content .widget-title',
		'settings'            => 'newsmunch_featured_link_ttl',
		'render_callback'  => 'newsmunch_featured_link_ttl_render_callback',
	) );
	
	// newsmunch_you_missed_ttl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_you_missed_ttl', array(
		'selector'            => '.ym-content .widget-title',
		'settings'            => 'newsmunch_you_missed_ttl',
		'render_callback'  => 'newsmunch_you_missed_ttl_render_callback',
	) );
	
	}
add_action( 'customize_register', 'newsmunch_site_selective_partials' );