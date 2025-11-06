<?php  
$newsmunch_faq_ttl		= get_theme_mod('newsmunch_faq_ttl','Frequently Asked Questions');
$newsmunch_faq_option	= get_theme_mod('newsmunch_faq_option',newsmunch_faq_options_default());
do_action('newsmunch_faq_option_before');	
?>	
<div class="spacer" data-height="30"></div>      
<div class="dt-row hm-faq">
	<div class="dt-col-lg-12 dt_faq">                        
		<div class="dt_content_block">
			<div class="dt_content_inner">
				<?php if ( ! empty( $newsmunch_faq_ttl ) ) : ?>
					<div class="widget-header">
						<h4 class="widget-title"><?php echo wp_kses_post($newsmunch_faq_ttl); ?></h4>
					</div>
				<?php endif; ?>
				<div class="dt_content_box">
					<?php
						if ( ! empty( $newsmunch_faq_option ) ) {
							$allowed_html = array(
								'br'     => array(),
								'em'     => array(),
								'strong' => array(),
								'span' => array(),
								'b'      => array(),
								'i'      => array(),
								);	
						$newsmunch_faq_option = json_decode( $newsmunch_faq_option );
						foreach ( $newsmunch_faq_option as $i=>$item ) {
							$title = ! empty( $item->title ) ? apply_filters( 'newsmunch_translate_single_string', $item->title, 'FAQ section' ) : '';
							$text = ! empty( $item->text ) ? apply_filters( 'newsmunch_translate_single_string', $item->text, 'FAQ section' ) : '';
					?>
						<div class="accordion <?php if($i==0): esc_attr_e('accordion--open','newsmunch-pro'); endif; ?>">
							<h4 class="accordion__title">
								<?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?> <i class="accordion__icon"><span class="line-01"></span><span class="line-02"></span></i>
							</h4>
							<div class="accordion__content" <?php if($i==0): ?>style="display: block"<?php endif; ?>>
								<p>
									<?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?>
								</p>
							</div>
						</div>
					<?php } } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php do_action('newsmunch_faq_option_after'); ?>
<div class="spacer" data-height="30"></div>

