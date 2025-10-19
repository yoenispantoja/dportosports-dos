<?php  
$chromax_service_options_hide_show  = get_theme_mod('chromax_service_options_hide_show','1');
$chromax_service_ttl		  = get_theme_mod('chromax_service_ttl','Empowering'); 
$chromax_service_subttl	  	  = get_theme_mod('chromax_service_subttl','Your Business Growth Through IT Solutions.'); 
$chromax_service_text	  	  = get_theme_mod('chromax_service_text','Ever find yourself staring at your computer screen a good consulting slogan to come to mind? Oftentimes.'); 
$chromax_service_btn_lbl	  = get_theme_mod('chromax_service_btn_lbl','See All Service');	
$chromax_service_btn_url	  = get_theme_mod('chromax_service_btn_url','#');
$chromax_service_option    	  = get_theme_mod('chromax_service_option',chromax_service_options_default());
do_action('chromax_service_option_before');
if($chromax_service_options_hide_show=='1'):
?>
<section id="dt_service" class="dt_information dt_information--one dt-py-default front-service">
	<div class="bg-shape-image" data-background="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/bg_one.png"></div>
	<div class="dt-container">
		<?php if ( ! empty( $chromax_service_ttl )  || ! empty( $chromax_service_subttl )) : ?>
			<div class="dt-row justify-content-center">
				<div class="dt-col-lg-8 dt-col-sm-12 dt-col-12">
					<div class="section-title dt-text-center dt-mb-6">
						<?php if ( ! empty( $chromax_service_ttl ) ) : ?>
							<div class="sub-title">
								<div class="anime-dots"><span></span></div>
								<span class="text-animate"><?php echo wp_kses_post($chromax_service_ttl); ?></span>
								<div class="anime-dots"><span></span></div>
							</div>
						<?php endif; ?>	
						
						<?php if ( ! empty( $chromax_service_subttl ) ) : ?>
							<h2 class="title text-animate"><?php echo wp_kses_post($chromax_service_subttl); ?></h2>
						<?php endif; ?>	
					</div>
				</div>
			</div>
		<?php endif; ?>	
		<div class="dt-row dt-g-4">
			<?php
				if ( ! empty( $chromax_service_option ) ) {
					$allowed_html = array(
						'br'     => array(),
						'em'     => array(),
						'strong' => array(),
						'span' => array(),
						'b'      => array(),
						'i'      => array(),
						);
				$chromax_service_option = json_decode( $chromax_service_option );
				foreach ( $chromax_service_option as $i=>$item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'chromax_translate_single_string', $item->title, 'Service section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'chromax_translate_single_string', $item->text, 'Service section' ) : '';
					$button = ! empty( $item->text2 ) ? apply_filters( 'chromax_translate_single_string', $item->text2, 'Service section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'chromax_translate_single_string', $item->link, 'Service section' ) : '';
					$image = ! empty( $item->image_url ) ? apply_filters( 'chromax_translate_single_string', $item->image_url, 'Service section' ) : '';
					$icon = ! empty( $item->icon_value ) ? apply_filters( 'chromax_translate_single_string', $item->icon_value, 'Service section' ) : '';
			?>
				<div class="dt-col-xl dt-col-lg-4 dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="<?php echo esc_attr($i*100); ?>ms" data-wow-duration="1500ms">
					<div class="item-inner">
						<div class="item-image">
							<?php if ( ! empty( $image ) ) : ?>
								<img src="<?php echo esc_url($image); ?>" alt="">
							<?php endif; ?>	
							
							<?php if ( ! empty( $icon ) ) : ?>
								<div class="item-icon">
									<i aria-hidden="true" class="<?php echo esc_attr($icon); ?>"></i>
								</div>
							<?php endif; ?>	
						</div>
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
				</div>
			<?php } } ?>
		</div>
		<?php if ( ! empty( $chromax_service_btn_lbl )  || ! empty( $chromax_service_text )) : ?>
			<div class="dt-row justify-content-center">
				<div class="dt-col-lg-8 dt-col-sm-12 dt-col-12">
					<div class="dt-mt-5 dt-text-center">
						<?php if ( ! empty( $chromax_service_text ) ) : ?>
							<div class="text"><?php echo wp_kses_post($chromax_service_text); ?></div>
						<?php endif; ?>	
						
						<?php if ( ! empty( $chromax_service_btn_lbl ) ) : ?>
							<a href="<?php echo esc_url($chromax_service_btn_url); ?>" class="dt-btn dt-btn-primary dt-mt-5"><?php echo wp_kses_post($chromax_service_btn_lbl); ?></a>
						<?php endif; ?>	
					</div>
				</div>
			</div>
		<?php endif; ?>	
	</div>
</section>
<?php endif; ?>
<?php do_action('chromax_service_option_after'); ?>