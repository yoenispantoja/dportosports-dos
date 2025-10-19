<?php  
$chromax_information_options_hide_show  		= get_theme_mod('chromax_information_options_hide_show','1');
$chromax_information_option 	= get_theme_mod('chromax_information_option',chromax_information_options_default());
if($chromax_information_options_hide_show=='1'):	
?>
<section id="dt_information" class="dt_information dt_information--three dt-py-default front-info2">
	<div id="particles-js-1" class="particles-js-area"></div>
	<div class="dt-container">
		<div class="dt-row dt-g-4">
			<?php
				if ( ! empty( $chromax_information_option ) ) {
					$allowed_html = array(
						'br'     => array(),
						'em'     => array(),
						'strong' => array(),
						'span' => array(),
						'b'      => array(),
						'i'      => array(),
						);
				$chromax_information_option = json_decode( $chromax_information_option );
				foreach ( $chromax_information_option as $i=>$item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'chromax_translate_single_string', $item->title, 'Information section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'chromax_translate_single_string', $item->text, 'Information section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'chromax_translate_single_string', $item->link, 'Information section' ) : '';
					$icon = ! empty( $item->icon_value ) ? apply_filters( 'chromax_translate_single_string', $item->icon_value, 'Information section' ) : '';
					$image = ! empty( $item->image_url ) ? apply_filters( 'chromax_translate_single_string', $item->image_url, 'Information section' ) : '';
			?>
				<div class="dt-col-lg-3 dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="<?php echo esc_attr($i*100); ?>ms" data-wow-duration="1500ms">
					<div class="item-inner">
						<?php if ( ! empty( $image ) ) : ?><div class="item-image" data-background="<?php echo esc_url($image); ?>"></div><?php endif; ?>
						<div class="item-inside">
							<div class="item-inner-top">
								<?php if ( ! empty( $icon ) ) : ?>
								<div class="item-icon">
									<i aria-hidden="true" class="<?php echo esc_attr($icon); ?>"></i>
								</div>
								<?php endif; ?>
								<?php if ( ! empty( $title ) ) : ?>
									<?php if ( ! empty( $link ) ) : ?>
										<h4 class="title"><a href="<?php echo esc_url($link); ?>"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></a></h4>
									<?php else: ?>	
										<h4 class="title"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></h4>
									<?php endif; ?>
								<?php endif; ?>
							</div>
							<div class="item-content">							
								<?php if ( ! empty( $text ) ) : ?>
									<div class="text"><?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?></div>
								<?php endif; ?>							
								<?php if ( ! empty( $link ) ) : ?>
									<a class="dt-more" href="<?php echo esc_url($link); ?>"><i class="fal fa-arrow-right" aria-hidden="true"></i></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php } } ?>
		</div>
	</div>
</section>
<?php endif; ?>