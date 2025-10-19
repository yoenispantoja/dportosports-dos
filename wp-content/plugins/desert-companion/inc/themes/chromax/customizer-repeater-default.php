<?php
if ( ! function_exists( 'chromax_after_before' ) ) { 
	function chromax_after_before($chromax_page) {	
		if( !empty($chromax_page)){
			?>
			<div class="dt-container">
				<?php 
					$chromax_page_query = new wp_query('page_id='.$chromax_page); 
					if($chromax_page_query->have_posts() ){ 
					   while( $chromax_page_query->have_posts() ) { $chromax_page_query->the_post();
							//the_title();
							the_content();
						}
					} wp_reset_postdata(); 
				?>
			</div>
		<?php }
	}
}

if ( ! function_exists( 'chromax_service_option_before' ) ) { 
	function chromax_service_option_before() {	
		$chromax_page	= get_theme_mod('chromax_service_option_before');
		chromax_after_before($chromax_page);
	}
	add_action('chromax_service_option_before','chromax_service_option_before');
}	


if ( ! function_exists( 'chromax_service_option_after' ) ) { 
	function chromax_service_option_after() {	
		$chromax_page	= get_theme_mod('chromax_service_option_after');
		chromax_after_before($chromax_page);
	}
	add_action('chromax_service_option_after','chromax_service_option_after');
}

/*
 *
 * Slider Default
 */
 function chromax_slider_options_default() {
	return apply_filters(
		'chromax_slider_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/slider01.jpg'),
					'title'           => esc_html__( 'Welcome to IT Solutions !', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Affordable Big IT & Technology <span class="text-primary">Solutions</span>', 'desert-companion' ),
					'text'            => esc_html__( 'The goal of IT services is to provide efficient and effective technology solutions that help businesses achieve their objectives.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Get Started', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "left", 
					'id'              => 'chromax_customizer_repeater_slider_001',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/slider02.jpg'),
					'title'           => esc_html__( 'We’re 100% Trusted Agency', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Bridging the Gap in Your IT <span class="text-primary">Solutions</span>', 'desert-companion' ),
					'text'            => esc_html__( 'The goal of IT services is to provide efficient and effective technology solutions that help businesses achieve their objectives.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Get Started', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "center", 
					'id'              => 'chromax_customizer_repeater_slider_002',
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/slider03.jpg'),
					'title'           => esc_html__( 'Experience the best IT Solution', 'desert-companion' ),
					'subtitle'         => esc_html__( 'Affordable Big IT & Technology <span class="text-primary">Solutions</span>', 'desert-companion' ),
					'text'            => esc_html__( 'The goal of IT services is to provide efficient and effective technology solutions that help businesses achieve their objectives.', 'desert-companion' ),
					'text2'	  =>  esc_html__( 'Get Started', 'desert-companion' ),
					'link'	  =>  esc_html__( '#', 'desert-companion' ),
					"slide_align" => "right", 
					'id'              => 'chromax_customizer_repeater_slider_003',
				)
			)
		)
	);
}

/*
 *
 * Chromax Information Default
 */
$desert_activated_theme = wp_get_theme(); // gets the current theme
if ( 'Chrowix' == $desert_activated_theme->name || 'Chromica' == $desert_activated_theme->name){ 
 function chromax_information_options_default() {
	return apply_filters(
		'chromax_information_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/services01.jpg'),
					'icon_value'       => 'fas fa-compass',
					'title'           => esc_html__( 'Tech Innovation', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Developing a comprehensive IT strategy that aligns.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_information_001'					
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/services02.jpg'),
					'icon_value'       => 'fas fa-users',
					'title'           => esc_html__( 'Market Analysis', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Developing a comprehensive IT strategy that aligns.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_information_002'
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/services03.jpg'),
					'icon_value'       => 'fas fa-life-ring',
					'title'           => esc_html__( 'Web & App Design', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Developing a comprehensive IT strategy that aligns.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_information_003'
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/services04.jpg'),
					'icon_value'       => 'fas fa-chart-pie',
					'title'           => esc_html__( 'Data Security', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Developing a comprehensive IT strategy that aligns.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_information_004'	
				)
			)
		)
	);
}
}else{
	function chromax_information_options_default() {
	return apply_filters(
		'chromax_information_options_default', json_encode(
				 array(
				array(
					'icon_value'       => 'fas fa-compass',
					'title'           => esc_html__( 'Tech Innovation', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Developing a comprehensive IT strategy that aligns.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_information_001'					
				),
				array(
					'icon_value'       => 'fas fa-users',
					'title'           => esc_html__( 'Market Analysis', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Developing a comprehensive IT strategy that aligns.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_information_002'
				),
				array(
					'icon_value'       => 'fas fa-life-ring',
					'title'           => esc_html__( 'Web & App Design', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Developing a comprehensive IT strategy that aligns.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_information_003'
				),
				array(
					'icon_value'       => 'fas fa-chart-pie',
					'title'           => esc_html__( 'Data Security', 'desert-companion' ),
					'text'	  =>  esc_html__( 'Developing a comprehensive IT strategy that aligns.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_information_004'	
				)
			)
		)
	);
}
}
/*
 *
 * Chromax Service Default
 */
$desert_activated_theme = wp_get_theme(); // gets the current theme
if ( 'Chrowix' == $desert_activated_theme->name){
 function chromax_service_options_default() {
	return apply_filters(
		'chromax_service_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/services01.jpg'),
					'icon_value'       => 'fas fa-compass',
					'title'           => esc_html__( 'Tech Innovation', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We are web designers, developers, project managers.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_service_001'					
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/services02.jpg'),
					'icon_value'       => 'fas fa-users',
					'title'           => esc_html__( 'Market Analysis', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We are web designers, developers, project managers.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_service_002'
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/services03.jpg'),
					'icon_value'       => 'fas fa-life-ring',
					'title'           => esc_html__( 'Web & App Design', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We are web designers, developers, project managers.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_service_003'
				)
			)
		)
	);
}
}else{
	function chromax_service_options_default() {
	return apply_filters(
		'chromax_service_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/services01.jpg'),
					'icon_value'       => 'fas fa-compass',
					'title'           => esc_html__( 'Tech Innovation', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We are web designers, developers, project managers.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_service_001'					
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/services02.jpg'),
					'icon_value'       => 'fas fa-users',
					'title'           => esc_html__( 'Market Analysis', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We are web designers, developers, project managers.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_service_002'
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/services03.jpg'),
					'icon_value'       => 'fas fa-life-ring',
					'title'           => esc_html__( 'Web & App Design', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We are web designers, developers, project managers.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_service_003'
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/services04.jpg'),
					'icon_value'       => 'fas fa-chart-pie',
					'title'           => esc_html__( 'Data Security', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We are web designers, developers, project managers.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_service_004'	
				),
				array(
					'image_url'       => esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/services05.jpg'),
					'icon_value'       => 'fas fa-lightbulb',
					'title'           => esc_html__( 'Business Consulting', 'desert-companion' ),
					'text'	  =>  esc_html__( 'We are web designers, developers, project managers.', 'desert-companion' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_service_005'	
				)
			)
		)
	);
}
}
/*
 *
 * Chromax Why Choose Default
 */
 function chromax_why_choose_options_default() {
	return apply_filters(
		'chromax_why_choose_options_default', json_encode(
				 array(
				array(
					'icon_value'       => 'fas fa-people-arrows',
					'title'           => esc_html__( 'Industry Experience', 'chromax-pro' ),
					'text'	  =>  esc_html__( 'The wise man therefore always doing holding these matters to this business principles sunt offer data.', 'chromax-pro' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_why_choose_001'					
				),
				array(
					'icon_value'       => 'fas fa-phone',
					'title'           => esc_html__( '24/7 Customer Support', 'chromax-pro' ),
					'text'	  =>  esc_html__( 'The wise man therefore always doing holding these matters to this business principles sunt offer data.', 'chromax-pro' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_why_choose_002'
				),
				array(
					'icon_value'       => 'fas fa-hand-holding-heart',
					'title'           => esc_html__( 'Trust & Reliability', 'chromax-pro' ),
					'text'	  =>  esc_html__( 'The wise man therefore always doing holding these matters to this business principles sunt offer data.', 'chromax-pro' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_why_choose_003'
				),
				array(
					'icon_value'       => 'fas fa-laptop-house',
					'title'           => esc_html__( 'Quality Service', 'chromax-pro' ),
					'text'	  =>  esc_html__( 'The wise man therefore always doing holding these matters to this business principles sunt offer data.', 'chromax-pro' ),
					'link'            => '#',
					'id'              => 'chromax_customizer_repeater_why_choose_004'
				)
			)
		)
	);
}