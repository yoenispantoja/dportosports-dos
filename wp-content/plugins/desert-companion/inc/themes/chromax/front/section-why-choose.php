<?php  
$chromax_why_choose_options_hide_show  		= get_theme_mod('chromax_why_choose_options_hide_show','1');
$chromax_hs_why_choose_left		  = get_theme_mod('chromax_hs_why_choose_left','1');
$chromax_why_choose_left_ttl	  = get_theme_mod('chromax_why_choose_left_ttl','What we offer'); 
$chromax_why_choose_left_subttl	  = get_theme_mod('chromax_why_choose_left_subttl','Small Smart Business Grow Faster Now'); 
$chromax_why_choose_left_text	  = get_theme_mod('chromax_why_choose_left_text','It is a long established fact that a reader will be distracted the readable content of a page when looking at layout the point.'); 
$chromax_why_choose_left_img	  = get_theme_mod('chromax_why_choose_left_img',esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/why_choose01.jpg'));	
$chromax_hs_why_choose_right	  = get_theme_mod('chromax_hs_why_choose_right','1');
$chromax_why_choose_right_option  = get_theme_mod('chromax_why_choose_right_option',chromax_why_choose_options_default());
$chromax_why_choose_bg_img	  = get_theme_mod('chromax_why_choose_bg_img',esc_url(desert_companion_plugin_url . '/inc/themes/chromax/assets/images/why_choose_us_bg.jpg'));
if($chromax_why_choose_options_hide_show=='1'):
?>
<section id="dt_why_choose_us" class="dt_why_choose_us dt_why_choose_us--one dt-py-default front-whychooseus" data-background="<?php echo esc_url($chromax_why_choose_bg_img); ?>">
	<div class="dt-container">
		<div class="dt-row dt-g-lg-5 dt-g-4 justify-content-center">
			<?php if($chromax_hs_why_choose_left=='1'): ?>
				<div class="dt-col-lg-6 dt-col-sm-12 dt-col-12">
					<?php if ( ! empty( $chromax_why_choose_left_ttl )  || ! empty( $chromax_why_choose_left_subttl )  || ! empty( $chromax_why_choose_left_text )) : ?>
						<div class="section-title text-white dt-mb-6">
							<?php if ( ! empty( $chromax_why_choose_left_ttl ) ) : ?>
								<div class="sub-title">
									<span class="text-animate"><?php echo wp_kses_post($chromax_why_choose_left_ttl); ?></span>
									<div class="anime-dots"><span></span></div>
								</div>
							<?php endif; ?>	
							
							<?php if ( ! empty( $chromax_why_choose_left_subttl ) ) : ?>
								<h2 class="title text-animate"><?php echo wp_kses_post($chromax_why_choose_left_subttl); ?></h2>
							<?php endif; ?>	
							
							<?php if ( ! empty( $chromax_why_choose_left_text ) ) : ?>
								<div class="desc"><?php echo wp_kses_post($chromax_why_choose_left_text); ?></div>
							<?php endif; ?>
						</div>
					<?php endif; ?>	
					
					<?php if ( ! empty( $chromax_why_choose_left_img ) ) : ?>
						<div class="why_choose_us-image-outer">
							<div class="why_choose_us-image">
								<img src="<?php echo esc_url($chromax_why_choose_left_img); ?>" alt="" />
							</div>
						</div>
					<?php endif; ?>	
				</div>
			<?php endif; ?>
			
			<?php if($chromax_hs_why_choose_right=='1'): ?>
			<div class="dt-col-lg-6 dt-col-sm-12 dt-col-12">
				<div class="why_choose_us-content gsap-fixed-yes start-40">
					<?php
						if ( ! empty( $chromax_why_choose_right_option ) ) {
							$allowed_html = array(
								'br'     => array(),
								'em'     => array(),
								'strong' => array(),
								'span' => array(),
								'b'      => array(),
								'i'      => array(),
								);
						$chromax_why_choose_right_option = json_decode( $chromax_why_choose_right_option );
						foreach ( $chromax_why_choose_right_option as $i=>$item ) {
							$title = ! empty( $item->title ) ? apply_filters( 'chromax_translate_single_string', $item->title, 'Why Choose section' ) : '';
							$text = ! empty( $item->text ) ? apply_filters( 'chromax_translate_single_string', $item->text, 'Why Choose section' ) : '';
							$link = ! empty( $item->link ) ? apply_filters( 'chromax_translate_single_string', $item->link, 'Why Choose section' ) : '';
							$icon = ! empty( $item->icon_value ) ? apply_filters( 'chromax_translate_single_string', $item->icon_value, 'Why Choose section' ) : '';
					?>
						<div class="item-inner">
							<?php if ( ! empty( $icon ) ) : ?>
								<div class="item-icon">
									<i aria-hidden="true" class="<?php echo esc_attr($icon); ?>"></i>
								</div>
							<?php endif; ?>	
							<div class="item-content">
								<?php if ( ! empty( $title ) ) : ?>
									<?php if ( ! empty( $link ) ) : ?>
										<h4 class="title"><a href="<?php echo esc_url($link); ?>"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></a></h4>
									<?php else: ?>	
										<h4 class="title"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></h4>
									<?php endif; ?>
								<?php endif; ?>	
								
								<?php if ( ! empty( $text ) ) : ?>
									<div class="text"><?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?></div>
								<?php endif; ?>	
							</div>
						</div>
					<?php } } ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>