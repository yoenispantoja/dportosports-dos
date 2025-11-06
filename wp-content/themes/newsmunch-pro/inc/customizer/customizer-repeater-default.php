<?php
/*
 *
 * Social Icon
 */
function newsmunch_get_social_icon_default() {
	return apply_filters(
		'newsmunch_get_social_icon_default', json_encode(
				 array(
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-facebook-f', 'newsmunch-pro' ),
					'link'	  =>  esc_html__( '#', 'newsmunch-pro' ),
					'id'              => 'customizer_repeater_header_social_001',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-instagram', 'newsmunch-pro' ),
					'link'	  =>  esc_html__( '#', 'newsmunch-pro' ),
					'id'              => 'customizer_repeater_header_social_002',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-twitter', 'newsmunch-pro' ),
					'link'	  =>  esc_html__( '#', 'newsmunch-pro' ),
					'id'              => 'customizer_repeater_header_social_003',
				),				
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-youtube', 'newsmunch-pro' ),
					'link'	  =>  esc_html__( '#', 'newsmunch-pro' ),
					'id'              => 'customizer_repeater_header_social_005',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-tiktok', 'newsmunch-pro' ),
					'link'	  =>  esc_html__( '#', 'newsmunch-pro' ),
					'id'              => 'customizer_repeater_header_social_004',
				)
			)
		)
	);
}

/*
 *
 * Featured Link Default
 */
 function newsmunch_featured_link_custom_options_default() {
	return apply_filters(
		'newsmunch_featured_link_custom_options_default', json_encode(
				 array(
				array(
					'image_url'       => esc_url(NEWSMUNCH_THEME_URI . '/assets/img/posts/newsmunch_1.webp'),
					'title'           => esc_html__( 'Technology', 'newsmunch-pro' ),
					'subtitle'        => esc_html__( '4', 'newsmunch-pro' ),
					'subtitle2'       => esc_html__( 'Articles', 'newsmunch-pro' ),
					'link'		  	  =>  esc_html__( '#', 'newsmunch-pro' ),
					'color'           => '#ffae25',
					'id'              => 'newsmunch_customizer_repeater_featured_link_001',
				),
				array(
					'image_url'       => esc_url(NEWSMUNCH_THEME_URI . '/assets/img/posts/newsmunch_2.webp'),
					'title'           => esc_html__( 'Travel', 'newsmunch-pro' ),
					'subtitle'        => esc_html__( '3', 'newsmunch-pro' ),
					'subtitle2'       => esc_html__( 'Articles', 'newsmunch-pro' ),
					'link'	  		  =>  esc_html__( '#', 'newsmunch-pro' ),
					'color'           => '#52a815',
					'id'              => 'newsmunch_customizer_repeater_featured_link_002',
				),
				array(
					'image_url'       => esc_url(NEWSMUNCH_THEME_URI . '/assets/img/posts/newsmunch_3.webp'),
					'title'           => esc_html__( 'Health', 'newsmunch-pro' ),
					'subtitle'        => esc_html__( '2', 'newsmunch-pro' ),
					'subtitle2'       => esc_html__( 'Articles', 'newsmunch-pro' ),
					'link'	  		  =>  esc_html__( '#', 'newsmunch-pro' ),
					'color'           => '#007bff',
					'id'              => 'newsmunch_customizer_repeater_featured_link_003',
				),
				array(
					'image_url'       => esc_url(NEWSMUNCH_THEME_URI . '/assets/img/posts/newsmunch_4.webp'),
					'title'           => esc_html__( 'Lifestyle', 'newsmunch-pro' ),
					'subtitle'        => esc_html__( '3', 'newsmunch-pro' ),
					'subtitle2'       => esc_html__( 'Articles', 'newsmunch-pro' ),
					'link'	  		  =>  esc_html__( '#', 'newsmunch-pro' ),
					'color'           => '#ff002a',
					'id'              => 'newsmunch_customizer_repeater_featured_link_004',
				),
				array(
					'image_url'       => esc_url(NEWSMUNCH_THEME_URI . '/assets/img/posts/newsmunch_5.webp'),
					'title'           => esc_html__( 'Inspiration', 'newsmunch-pro' ),
					'subtitle'        => esc_html__( '7', 'newsmunch-pro' ),
					'subtitle2'       => esc_html__( 'Articles', 'newsmunch-pro' ),
					'link'	  		  =>  esc_html__( '#', 'newsmunch-pro' ),
					'color'           => '#00baff',
					'id'              => 'newsmunch_customizer_repeater_featured_link_005',
				),
				array(
					'image_url'       => esc_url(NEWSMUNCH_THEME_URI . '/assets/img/posts/newsmunch_6.webp'),
					'title'           => esc_html__( 'Fashion', 'newsmunch-pro' ),
					'subtitle'        => esc_html__( '5', 'newsmunch-pro' ),
					'subtitle2'       => esc_html__( 'Articles', 'newsmunch-pro' ),
					'link'	  		  =>  esc_html__( '#', 'newsmunch-pro' ),
					'color'           => '#7e0ad1',
					'id'              => 'newsmunch_customizer_repeater_featured_link_006',
				)
			)
		)
	);
}


/*
 *
 * Team Default
 */
 function newsmunch_team_options_default() {
	return apply_filters(
		'newsmunch_team_options_default', json_encode(
					  array(
				array(
					'image_url'       => esc_url(NEWSMUNCH_THEME_URI . '/assets/img/other/team_1.webp'),
					'title'           => esc_html__( 'James Stone', 'newsmunch-pro' ),
					'subtitle'        => esc_html__( 'Creative Director','newsmunch-pro' ),
					'id'              => 'newsmunch_customizer_repeater_team_0001',
					'social_repeater' => json_encode(
						array(
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_001',
								'link' => 'facebook.com',
								'icon' => 'fab fa-facebook-f',
							),
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_003',
								'link' => 'twitter.com',
								'icon' => 'fab fa-x-twitter',
							),
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_004',
								'link' => 'instagram.com',
								'icon' => 'fab fa-instagram',
							),
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_005',
								'link' => 'linkedin.com',
								'icon' => 'fab fa-linkedin',
							),
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_00566',
								'link' => 'behance.com',
								'icon' => 'fab fa-behance',
							)
						)
					),
				),
				array(
					'image_url'       => esc_url(NEWSMUNCH_THEME_URI . '/assets/img/other/team_2.webp'),
					'title'           => esc_html__( 'Ashley Riordan', 'newsmunch-pro' ),
					'subtitle'        => esc_html__( 'Art Director','newsmunch-pro' ),
					'id'              => 'newsmunch_customizer_repeater_team_0002',
					'social_repeater' => json_encode(
						array(
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_0011',
								'link' => 'facebook.com',
								'icon' => 'fab fa-facebook-f',
							),
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_0012',
								'link' => 'twitter.com',
								'icon' => 'fab fa-x-twitter',
							),
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_0013',
								'link' => 'pinterest.com',
								'icon' => 'fab fa-instagram',
							),
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_0014',
								'link' => 'linkedin.com',
								'icon' => 'fab fa-linkedin',
							),
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_00567',
								'link' => 'behance.com',
								'icon' => 'fab fa-behance',
							)
						)
					),
				),
				array(
					'image_url'       => esc_url(NEWSMUNCH_THEME_URI . '/assets/img/other/team_3.webp'),
					'title'           => esc_html__( 'Albert Coleman', 'newsmunch-pro' ),
					'subtitle'        => esc_html__( 'Marketing Head','newsmunch-pro' ),
					'id'              => 'newsmunch_customizer_repeater_team_0003',
					'social_repeater' => json_encode(
						array(
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_0021',
								'link' => 'facebook.com',
								'icon' => 'fab fa-facebook-f',
							),
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_0022',
								'link' => 'twitter.com',
								'icon' => 'fab fa-twitter',
							),
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_0023',
								'link' => 'linkedin.com',
								'icon' => 'fab fa-instagram',
							),
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_0024',
								'link' => 'linkedin.com',
								'icon' => 'fab fa-linkedin',
							),
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_00568',
								'link' => 'behance.com',
								'icon' => 'fab fa-behance',
							)
						)
					),
				),
				array(
					'image_url'       => esc_url(NEWSMUNCH_THEME_URI . '/assets/img/other/team_4.webp'),
					'title'           => esc_html__( 'Clemens Steiner', 'newsmunch-pro' ),
					'subtitle'        => esc_html__( 'Manager & QC','newsmunch-pro' ),
					'id'              => 'newsmunch_customizer_repeater_team_0004',
					'social_repeater' => json_encode(
						array(
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_0031',
								'link' => 'facebook.com',
								'icon' => 'fab fa-facebook-f',
							),
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_0032',
								'link' => 'twitter.com',
								'icon' => 'fab fa-x-twitter',
							),
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_0033',
								'link' => 'instagram.com',
								'icon' => 'fab fa-instagram',
							),
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_0034',
								'link' => 'linkedin.com',
								'icon' => 'fab fa-linkedin',
							),
							array(
								'id'   => 'newsmunch-customizer-repeater-social-repeater-team_00569',
								'link' => 'behance.com',
								'icon' => 'fab fa-behance',
							)
						)
					),
				)
			)
		)
	);
}



/*
 *
 * Contact Info Default
 */
 function newsmunch_contact_info_options_default() {
	return apply_filters(
		'newsmunch_contact_info_options_default', json_encode(
				 array(
				array(
					'icon_value'       => 'fas fa-phone-volume',
					'title'           => esc_html__( 'Call Now', 'newsmunch-pro' ),
					'text'           => esc_html__( '8 (800) 123 4567<br>8 (800) 123 4568', 'newsmunch-pro' ),
					'id'              => 'newsmunch_customizer_repeater_contact_info_001',
				),
				array(
					'icon_value'       => 'far fa-envelope-open',
					'title'           => esc_html__( 'Email', 'newsmunch-pro' ),
					'text'           => esc_html__( 'info@example.com <br> support@example.com', 'newsmunch-pro' ),
					'id'              => 'newsmunch_customizer_repeater_contact_info_002',
				),
				array(
					'icon_value'       => 'fas fa-clock',
					'title'           => esc_html__( 'Opening Hours', 'newsmunch-pro' ),
					'text'           => esc_html__( '7 AM to 7 PM <br> 7 AM to 7 PM', 'newsmunch-pro' ),
					'id'              => 'newsmunch_customizer_repeater_contact_info_003',
				),
				array(
					'icon_value'       => 'fas fa-map-marker-alt',
					'title'           => esc_html__( 'Location', 'newsmunch-pro' ),
					'text'           => esc_html__( '8281 Street, Road Edinburgh, UK <br> 8281 Street, Road Edinburgh, UK', 'newsmunch-pro' ),
					'id'              => 'newsmunch_customizer_repeater_contact_info_003',
				),
			)
		)
	);
}


/*
 *
 * FAQ Default
 */
 function newsmunch_faq_options_default() {
	return apply_filters(
		'newsmunch_faq_options_default', json_encode(
				 array(
				array(
					'title'           => esc_html__( 'Can I offer my items for promotional basis?', 'newsmunch-pro' ),
					'text'           => esc_html__( 'Creating an engaging and user-friendly site has the ability to reduce churn rate and create more conversions consisting of both new and returning users.<br /> This depends on your goals, but there are a few digital marketing tools which are relevant business.', 'newsmunch-pro' ),
					'id'              => 'newsmunch_customizer_repeater_faq_001'
				),
				array(
					'title'           => esc_html__( 'How can I safely use My Business?', 'newsmunch-pro' ),
					'text'           => esc_html__( 'Creating an engaging and user-friendly site has the ability to reduce churn rate and create more conversions consisting of both new and returning users.<br /> This depends on your goals, but there are a few digital marketing tools which are relevant business.', 'newsmunch-pro' ),
					'id'              => 'newsmunch_customizer_repeater_faq_002'
				),
				array(
					'title'           => esc_html__( 'What type of company is measured?', 'newsmunch-pro' ),
					'text'           => esc_html__( 'Creating an engaging and user-friendly site has the ability to reduce churn rate and create more conversions consisting of both new and returning users.<br /> This depends on your goals, but there are a few digital marketing tools which are relevant business.', 'newsmunch-pro' ),
					'id'              => 'newsmunch_customizer_repeater_faq_003'
				),
				array(
					'title'           => esc_html__( 'Where should I incorporate my business?', 'newsmunch-pro' ),
					'text'           => esc_html__( 'Creating an engaging and user-friendly site has the ability to reduce churn rate and create more conversions consisting of both new and returning users.<br /> This depends on your goals, but there are a few digital marketing tools which are relevant business.', 'newsmunch-pro' ),
					'id'              => 'newsmunch_customizer_repeater_faq_004'
				),
				array(
					'title'           => esc_html__( 'Where should I incorporate my business?', 'newsmunch-pro' ),
					'text'           => esc_html__( 'Creating an engaging and user-friendly site has the ability to reduce churn rate and create more conversions consisting of both new and returning users.<br /> This depends on your goals, but there are a few digital marketing tools which are relevant business.', 'newsmunch-pro' ),
					'id'              => 'newsmunch_customizer_repeater_faq_005'
				),
				array(
					'title'           => esc_html__( 'Can I offer my items for promotional basis?', 'newsmunch-pro' ),
					'text'           => esc_html__( 'Creating an engaging and user-friendly site has the ability to reduce churn rate and create more conversions consisting of both new and returning users.<br /> This depends on your goals, but there are a few digital marketing tools which are relevant business.', 'newsmunch-pro' ),
					'id'              => 'newsmunch_customizer_repeater_faq_006'
				)
			)
		)
	);
}