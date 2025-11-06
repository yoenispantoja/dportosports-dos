<?php
if ( ! function_exists( 'newsmunch_top_tags_option_before' ) ) {
	function newsmunch_top_tags_option_before() {
		$newsmunch_page	= get_theme_mod('newsmunch_top_tags_option_before');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_top_tags_option_before','newsmunch_top_tags_option_before');
}


if ( ! function_exists( 'newsmunch_top_tags_option_after' ) ) {
	function newsmunch_top_tags_option_after() {
		$newsmunch_page	= get_theme_mod('newsmunch_top_tags_option_after');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_top_tags_option_after','newsmunch_top_tags_option_after');
}


if ( ! function_exists( 'newsmunch_slider_option_before' ) ) {
	function newsmunch_slider_option_before() {
		$newsmunch_page	= get_theme_mod('newsmunch_slider_option_before');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_slider_option_before','newsmunch_slider_option_before');
}


if ( ! function_exists( 'newsmunch_slider_option_after' ) ) {
	function newsmunch_slider_option_after() {
		$newsmunch_page	= get_theme_mod('newsmunch_slider_option_after');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_slider_option_after','newsmunch_slider_option_after');
}


if ( ! function_exists( 'newsmunch_featured_link_option_before' ) ) {
	function newsmunch_featured_link_option_before() {
		$newsmunch_page	= get_theme_mod('newsmunch_featured_link_option_before');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_featured_link_option_before','newsmunch_featured_link_option_before');
}


if ( ! function_exists( 'newsmunch_featured_link_option_after' ) ) {
	function newsmunch_featured_link_option_after() {
		$newsmunch_page	= get_theme_mod('newsmunch_featured_link_option_after');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_featured_link_option_after','newsmunch_featured_link_option_after');
}


if ( ! function_exists( 'newsmunch_you_missed_option_before' ) ) {
	function newsmunch_you_missed_option_before() {
		$newsmunch_page	= get_theme_mod('newsmunch_you_missed_option_before');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_you_missed_option_before','newsmunch_you_missed_option_before');
}


if ( ! function_exists( 'newsmunch_you_missed_option_after' ) ) {
	function newsmunch_you_missed_option_after() {
		$newsmunch_page	= get_theme_mod('newsmunch_you_missed_option_after');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_you_missed_option_after','newsmunch_you_missed_option_after');
}


if ( ! function_exists( 'newsmunch_about_option_before' ) ) {
	function newsmunch_about_option_before() {
		$newsmunch_page	= get_theme_mod('newsmunch_about_option_before');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_about_option_before','newsmunch_about_option_before');
}


if ( ! function_exists( 'newsmunch_about_option_after' ) ) {
	function newsmunch_about_option_after() {
		$newsmunch_page	= get_theme_mod('newsmunch_about_option_after');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_about_option_after','newsmunch_about_option_after');
}


if ( ! function_exists( 'newsmunch_skill_option_before' ) ) {
	function newsmunch_skill_option_before() {
		$newsmunch_page	= get_theme_mod('newsmunch_skill_option_before');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_skill_option_before','newsmunch_skill_option_before');
}


if ( ! function_exists( 'newsmunch_skill_option_after' ) ) {
	function newsmunch_skill_option_after() {
		$newsmunch_page	= get_theme_mod('newsmunch_skill_option_after');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_skill_option_after','newsmunch_skill_option_after');
}


if ( ! function_exists( 'newsmunch_team_option_before' ) ) {
	function newsmunch_team_option_before() {
		$newsmunch_page	= get_theme_mod('newsmunch_team_option_before');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_team_option_before','newsmunch_team_option_before');
}


if ( ! function_exists( 'newsmunch_team_option_after' ) ) {
	function newsmunch_team_option_after() {
		$newsmunch_page	= get_theme_mod('newsmunch_team_option_after');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_team_option_after','newsmunch_team_option_after');
}

if ( ! function_exists( 'newsmunch_faq_option_before' ) ) {
	function newsmunch_faq_option_before() {
		$newsmunch_page	= get_theme_mod('newsmunch_faq_option_before');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_faq_option_before','newsmunch_faq_option_before');
}


if ( ! function_exists( 'newsmunch_faq_option_after' ) ) {
	function newsmunch_faq_option_after() {
		$newsmunch_page	= get_theme_mod('newsmunch_faq_option_after');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_faq_option_after','newsmunch_faq_option_after');
}


if ( ! function_exists( 'newsmunch_contact_info_option_before' ) ) {
	function newsmunch_contact_info_option_before() {
		$newsmunch_page	= get_theme_mod('newsmunch_contact_info_option_before');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_contact_info_option_before','newsmunch_contact_info_option_before');
}


if ( ! function_exists( 'newsmunch_contact_info_option_after' ) ) {
	function newsmunch_contact_info_option_after() {
		$newsmunch_page	= get_theme_mod('newsmunch_contact_info_option_after');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_contact_info_option_after','newsmunch_contact_info_option_after');
}


if ( ! function_exists( 'newsmunch_contact_form_option_before' ) ) {
	function newsmunch_contact_form_option_before() {
		$newsmunch_page	= get_theme_mod('newsmunch_contact_form_option_before');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_contact_form_option_before','newsmunch_contact_form_option_before');
}


if ( ! function_exists( 'newsmunch_contact_form_option_after' ) ) {
	function newsmunch_contact_form_option_after() {
		$newsmunch_page	= get_theme_mod('newsmunch_contact_form_option_after');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_contact_form_option_after','newsmunch_contact_form_option_after');
}

if ( ! function_exists( 'newsmunch_contact_map_option_before' ) ) {
	function newsmunch_contact_map_option_before() {
		$newsmunch_page	= get_theme_mod('newsmunch_contact_map_option_before');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_contact_map_option_before','newsmunch_contact_map_option_before');
}


if ( ! function_exists( 'newsmunch_contact_map_option_after' ) ) {
	function newsmunch_contact_map_option_after() {
		$newsmunch_page	= get_theme_mod('newsmunch_contact_map_option_after');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page);
			if($newsmunch_page_query->have_posts() ){
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					//the_title();
					the_content();
				}
			} wp_reset_postdata();
		}
	}
	add_action('newsmunch_contact_map_option_after','newsmunch_contact_map_option_after');
}