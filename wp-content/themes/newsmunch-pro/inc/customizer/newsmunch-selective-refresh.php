<?php
function newsmunch_site_selective_partials( $wp_customize ){
	// newsmunch_hdr_left_ttl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_hdr_left_ttl', array(
		'selector'            => '.dt_header .dt_header-topbar .dt-news-headline .dt-news-heading',
		'settings'            => 'newsmunch_hdr_left_ttl',
		'render_callback'  => 'newsmunch_hdr_left_ttl_render_callback',
	) );

	// newsmunch_hdr_top_ads_title
	$wp_customize->selective_refresh->add_partial( 'newsmunch_hdr_top_ads_title', array(
		'selector'            => '.dt_header .dt_header-topbar .dt-address span',
		'settings'            => 'newsmunch_hdr_top_ads_title',
		'render_callback'  => 'newsmunch_hdr_top_ads_title_render_callback',
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
	
	// newsmunch_about_ttl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_about_ttl', array(
		'selector'            => '.hm-about .widget-header .widget-title',
		'settings'            => 'newsmunch_about_ttl',
		'render_callback'  => 'newsmunch_about_ttl_render_callback',
	) );
	
	// newsmunch_about_subttl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_about_subttl', array(
		'selector'            => '.hm-about .dt-section-header .dt-section-title',
		'settings'            => 'newsmunch_about_subttl',
		'render_callback'  => 'newsmunch_about_subttl_render_callback',
	) );
	
	// newsmunch_about_text
	$wp_customize->selective_refresh->add_partial( 'newsmunch_about_text', array(
		'selector'            => '.hm-about .dt-section-header .dt-mt-2.dt-mb-0',
		'settings'            => 'newsmunch_about_text',
		'render_callback'  => 'newsmunch_about_text_render_callback',
	) );
	
	// newsmunch_about_btn_lbl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_about_btn_lbl', array(
		'selector'            => '.hm-about .dt-btn',
		'settings'            => 'newsmunch_about_btn_lbl',
		'render_callback'  => 'newsmunch_about_btn_lbl_render_callback',
	) );
	
	// newsmunch_skill_ttl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_skill_ttl', array(
		'selector'            => '.hm-skill .widget-header .widget-title',
		'settings'            => 'newsmunch_skill_ttl',
		'render_callback'  => 'newsmunch_skill_ttl_render_callback',
	) );
	
	// newsmunch_skill_subttl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_skill_subttl', array(
		'selector'            => '.hm-skill .dt-section-title',
		'settings'            => 'newsmunch_skill_subttl',
		'render_callback'  => 'newsmunch_skill_subttl_render_callback',
	) );
	
	// newsmunch_skill_text
	$wp_customize->selective_refresh->add_partial( 'newsmunch_skill_text', array(
		'selector'            => '.hm-skill .dt-section-header .dt-mt-2.dt-mb-0',
		'settings'            => 'newsmunch_skill_text',
		'render_callback'  => 'newsmunch_skill_text_render_callback',
	) );
	
	// newsmunch_team_ttl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_team_ttl', array(
		'selector'            => '.hm-team .widget-header .widget-title',
		'settings'            => 'newsmunch_team_ttl',
		'render_callback'  => 'newsmunch_team_ttl_render_callback',
	) );
	
	// newsmunch_faq_ttl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_faq_ttl', array(
		'selector'            => '.hm-faq .widget-header .widget-title',
		'settings'            => 'newsmunch_faq_ttl',
		'render_callback'  => 'newsmunch_faq_ttl_render_callback',
	) );
	
	// newsmunch_contact_form_ttl
	$wp_customize->selective_refresh->add_partial( 'newsmunch_contact_form_ttl', array(
		'selector'            => '.hm-contact_form .widget-header .widget-title',
		'settings'            => 'newsmunch_contact_form_ttl',
		'render_callback'  => 'newsmunch_contact_form_ttl_render_callback',
	) );
	
	}
add_action( 'customize_register', 'newsmunch_site_selective_partials' );