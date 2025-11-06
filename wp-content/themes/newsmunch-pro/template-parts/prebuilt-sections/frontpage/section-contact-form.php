<?php  
$newsmunch_contact_form_ttl		= get_theme_mod('newsmunch_contact_form_ttl','Send Message');
$newsmunch_contact_form_shortcode= get_theme_mod('newsmunch_contact_form_shortcode');
$newsmunch_contact_form_img		= get_theme_mod('newsmunch_contact_form_img',esc_url(get_template_directory_uri() .'/assets/img/other/contact.webp'));
do_action('newsmunch_contact_form_option_before');
?>	
<div class="dt-row hm-contact_form">
	<div class="dt-col-lg-<?php if ( ! empty( $newsmunch_contact_form_img ) ) : echo '6'; else: echo '12'; endif; ?>">
		<div class="dt_contact_form padding-20">
			<?php if ( ! empty( $newsmunch_contact_form_ttl ) ) : ?>
				<div class="widget-header">
					<h4 class="widget-title"><?php echo wp_kses_post($newsmunch_contact_form_ttl); ?></h4>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $newsmunch_contact_form_shortcode ) ) : echo do_shortcode($newsmunch_contact_form_shortcode); else: ?>
			<div class="wpcf7 no-js" id="wpcf7-f147-o1" lang="en-US" dir="ltr">
				<div class="screen-reader-response">
					<p role="status" aria-live="polite" aria-atomic="true"></p>
					<ul></ul>
				</div>
				<form action="" method="post" class="wpcf7-form init" aria-label="Contact form" novalidate="novalidate" data-status="init">
					<div style="display: none;">
						<input type="hidden" name="_wpcf7" value="147" />
						<input type="hidden" name="_wpcf7_version" value="5.8.5" />
						<input type="hidden" name="_wpcf7_locale" value="en_US" />
						<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f147-o1" />
						<input type="hidden" name="_wpcf7_container_post" value="0" />
						<input type="hidden" name="_wpcf7_posted_data_hash" value="" />
					</div>
					<p><span class="wpcf7-form-control-wrap" data-name="your-name"><input size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Your name" value="" type="text" name="your-name" /></span>
					</p>
					<p><span class="wpcf7-form-control-wrap" data-name="your-email"><input size="40" class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Your Email" value="" type="email" name="your-email" /></span>
					</p>
					<p><span class="wpcf7-form-control-wrap" data-name="your-subject"><input size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Your Subject" value="" type="text" name="your-subject" /></span>
					</p>
					<p><span class="wpcf7-form-control-wrap" data-name="your-message"><textarea cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" placeholder="Your message (optional)" name="your-message"></textarea></span>
					</p>
					<p><button class="dt-btn dt-btn-primary" data-title="Send Now">Send Now</button></p>
					<div class="wpcf7-response-output" aria-hidden="true"></div>
				</form>
			</div>
			<?php endif; ?>
		</div>
	</div>    
	<?php if ( ! empty( $newsmunch_contact_form_img ) ) : ?>	
		<div class="dt-col-lg-6">
			<img decoding="async" loading="lazy" src="<?php echo esc_url($newsmunch_contact_form_img); ?>" class="attachment-full size-full" style="width:100%;">                        
		</div>
	<?php endif; ?>
</div>
<?php do_action('newsmunch_contact_form_option_after'); ?>