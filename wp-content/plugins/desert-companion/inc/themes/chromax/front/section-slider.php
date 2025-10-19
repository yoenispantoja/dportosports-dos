<?php  
$chromax_slider_options_hide_show  		= get_theme_mod('chromax_slider_options_hide_show','1');
$chromax_slider_option 		= get_theme_mod('chromax_slider_option',chromax_slider_options_default());
if($chromax_slider_options_hide_show=='1'):	
?>
<section id="dt_slider" class="dt_slider dt_slider--thumbnav dt_slider--two" role="banner" aria-label="<?php esc_attr_e('Main Promotional Banner','desert-companion'); ?>">
	<div class="dt_owl_carousel owl-theme owl-carousel slider" data-owl-options='{
		"loop": true,
		"items": 1,
		"autoplay": true,
		"autoplayTimeout": 7000,
		"autoplaySpeed": 1000,
		"smartSpeed": 1000,
		"nav": true,
		"navText": [
		"<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\"><path fill=\"currentColor\" d=\"M23.29 12.5H4.05c.461.232.91.484 1.329.74l.353.22c1.752 1.13 3.284 2.565 4.577 4.186l.398.513c.394.523.773 1.075 1.08 1.613.396.698.712 1.447.712 2.106h-1c0-.385-.2-.94-.582-1.612a14.352 14.352 0 0 0-1.008-1.503l-.382-.493c-1.233-1.546-2.685-2.904-4.337-3.968l-.333-.21c-.677-.412-1.416-.812-2.143-1.107-.733-.296-1.421-.473-2.004-.473v-1.025c.583 0 1.271-.177 2.004-.473.545-.221 1.098-.5 1.626-.801l.517-.307c1.678-1.025 3.159-2.35 4.421-3.87l.25-.307c.514-.647 1.018-1.342 1.389-1.996.382-.671.582-1.227.582-1.612h1c0 .66-.316 1.408-.713 2.107-.407.717-.945 1.458-1.476 2.125l-.262.32C8.723 8.27 7.16 9.672 5.378 10.76l-.543.321c-.255.145-.52.285-.787.419h19.241v1Z\"></svg>",
		"<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\"><path fill=\"currentColor\" d=\"M.71 12.5h19.24c-.461.232-.91.484-1.329.74l-.353.22c-1.753 1.13-3.284 2.565-4.578 4.186l-.397.513a15.354 15.354 0 0 0-1.08 1.613c-.396.698-.712 1.447-.712 2.106h1c0-.385.2-.94.582-1.612.279-.49.632-1.004 1.008-1.503l.382-.493c1.233-1.546 2.685-2.904 4.337-3.968l.333-.21c.677-.412 1.416-.812 2.143-1.107.733-.296 1.421-.473 2.004-.473v-1.025c-.583 0-1.271-.177-2.004-.473a13.85 13.85 0 0 1-1.626-.801l-.517-.307c-1.678-1.025-3.159-2.35-4.421-3.87l-.25-.307c-.514-.647-1.018-1.342-1.389-1.996-.382-.671-.582-1.227-.582-1.612h-1c0 .66.316 1.408.713 2.107.407.717.945 1.458 1.476 2.125l.262.32c1.325 1.597 2.888 2.998 4.67 4.087l.543.321c.256.145.52.285.787.419H.711v1Z\"></svg>"
		],
		"dots": true,
		"margin": 0
		}'>
		<?php
			if ( ! empty( $chromax_slider_option ) ) {
				$allowed_html = array(
					'br'     => array(),
					'em'     => array(),
					'strong' => array(),
					'span'   => array(
						'class' => array()
					),
					'b'      => array(),
					'i'      => array(),
				);
			$chromax_slider_option = json_decode( $chromax_slider_option );
			foreach ( $chromax_slider_option as $item ) {
				$title = ! empty( $item->title ) ? apply_filters( 'chromax_translate_single_string', $item->title, 'slider section' ) : '';
				$subtitle = ! empty( $item->subtitle ) ? apply_filters( 'chromax_translate_single_string', $item->subtitle, 'slider section' ) : '';
				$text = ! empty( $item->text ) ? apply_filters( 'chromax_translate_single_string', $item->text, 'slider section' ) : '';
				$button = ! empty( $item->text2) ? apply_filters( 'chromax_translate_single_string', $item->text2,'slider section' ) : '';
				$link = ! empty( $item->link ) ? apply_filters( 'chromax_translate_single_string', $item->link, 'slider section' ) : '';
				$image = ! empty( $item->image_url ) ? apply_filters( 'chromax_translate_single_string', $item->image_url, 'slider section' ) : '';
				$align = ! empty( $item->slide_align ) ? apply_filters( 'chromax_translate_single_string', $item->slide_align, 'slider section' ) : '';
		?>
			<div class="dt_slider-item">
				<?php if ( ! empty( $image ) ) : ?>
					<img src="<?php echo esc_url($image); ?>" loading="lazy" alt="<?php if ( ! empty( $title ) ) : echo wp_kses( html_entity_decode( $title ), $allowed_html ); endif; ?>"/>
				<?php endif; ?>	
				<div class="dt_slider-wrapper">
					<div class="dt_slider-inner">
						<div class="dt_slider-innercell">
							<div class="dt-container">
								<div class="dt-row dt-text-<?php echo esc_attr($align); ?>">
									<div class="dt-col-lg-12 dt-col-md-12 first dt-my-auto">
										<div class="dt_slider-content">
											<?php if ( ! empty( $title ) ) : ?>
												<h5 class="subtitle animate-subtitle"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></h5>
											<?php endif; ?>	
											
											<?php if ( ! empty( $subtitle ) ) : ?>
												<h2 class="title animate-title" data-text="<?php echo esc_attr(wp_kses( html_entity_decode( $subtitle ), $allowed_html )); ?>"></h2>
											<?php endif; ?>	
											
											<?php if ( ! empty( $text ) ) : ?>
												<p class="text animate-text"><?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?></p>
											<?php endif; ?>	
											<div class="dt_btn-group animate-buttons">
												<?php if ( ! empty( $button )) : ?>
													<a href="<?php echo esc_url($link); ?>" class="dt-btn dt-btn-primary"><?php echo wp_kses( html_entity_decode( $button ), $allowed_html ); ?></a>
												<?php endif; ?>	
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } } ?>
	</div>
</section>
<?php endif; ?>