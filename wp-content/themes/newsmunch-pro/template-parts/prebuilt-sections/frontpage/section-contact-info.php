<?php  
$newsmunch_contact_info_option	= get_theme_mod('newsmunch_contact_info_option',newsmunch_contact_info_options_default());
do_action('newsmunch_contact_info_option_before');
?>	
<div class="dt-row dt-g-4 dt-mb-6 dt-pb-2 hm-contact_info">
	<?php
		if ( ! empty( $newsmunch_contact_info_option ) ) {
			$allowed_html = array(
				'br'     => array(),
				'em'     => array(),
				'strong' => array(),
				'span' => array(),
				'b'      => array(),
				'i'      => array(),
				);	
		$newsmunch_contact_info_option = json_decode( $newsmunch_contact_info_option );
		foreach ( $newsmunch_contact_info_option as $i=>$item ) {
			$title = ! empty( $item->title ) ? apply_filters( 'newsmunch_translate_single_string', $item->title, 'Contact Info section' ) : '';	
			$text = ! empty( $item->text ) ? apply_filters( 'newsmunch_translate_single_string', $item->text, 'Contact Info section' ) : '';
			$icon = ! empty( $item->icon_value ) ? apply_filters( 'newsmunch_translate_single_string', $item->icon_value, 'Contact Info section' ) : '';
			$link = ! empty( $item->link ) ? apply_filters( 'newsmunch_translate_single_string', $item->link, 'Contact Info section' ) : '';
	?>
		<div class="dt-col-lg-3">
			<div class="contact-info-box">
				<div class="contact-info-item">
					<?php if ( ! empty( $icon ) ) : ?>
						<i aria-hidden="true" class="<?php echo esc_attr( $icon ); ?>"></i>
					<?php endif; ?>     
					<div class="info-value">
						<?php if ( ! empty( $title ) ) : ?>
							<h4 class="tilte dt-mt-0 dt-mb-0">
								<?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?>
							</h4>
						<?php endif; ?>
						<?php if ( ! empty( $text ) ) : ?>
							<p class="dt-mt-1 dt-mb-0">
								<?php if ( ! empty( $link ) ) : ?><a href="<?php echo esc_url($link); ?>"><?php endif; ?>
								<?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?>
								<?php if ( ! empty( $link ) ) : ?></a><?php endif; ?>
							</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php } } ?>
</div>
<?php do_action('newsmunch_contact_info_option_after'); ?>