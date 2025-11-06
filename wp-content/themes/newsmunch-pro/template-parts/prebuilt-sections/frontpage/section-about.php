<?php  
$newsmunch_about_ttl		= get_theme_mod('newsmunch_about_ttl','WHO WE ARE');
$newsmunch_about_subttl		= get_theme_mod('newsmunch_about_subttl','More Than 25+ Years We Provide True News');
$newsmunch_about_text		= get_theme_mod('newsmunch_about_text','Nec nascetur mus vicolor rhoncus augue quisque parturient etiam imperdet sit nisi tellus veni faucibus orcimperdiet venena nullam rhoncus curabitur monteante.
                                <br><br>
                                Nec nascetur mus vicolor rhoncus augue quisque parturient etiam imperdet sit nisi tellus veni faucibus orcimperdiet venena nullam rhoncus curabitur monteante.');
$newsmunch_about_btn_lbl	= get_theme_mod('newsmunch_about_btn_lbl','Contact Now');
$newsmunch_about_btn_link	= get_theme_mod('newsmunch_about_btn_link','#');
$newsmunch_about_img	= get_theme_mod('newsmunch_about_img',esc_url(get_template_directory_uri() .'/assets/img/other/about.png'));
$newsmunch_about_content	= get_theme_mod('newsmunch_about_content','<div class="dt_section_hr"></div>
                            <ul class="dt_section_list">
                                <li>Company and research</li>
                                <li>Endless possibilities</li>
                                <li>Business and research</li>
                                <li>Awesome projects</li>
                            </ul>');
do_action('newsmunch_about_option_before');							
?>	
<div class="dt-row dt-g-5 hm-about">
	<?php if ( ! empty( $newsmunch_about_img ) ) : ?>
		<div class="dt-col-lg-6">
			<img decoding="async" loading="lazy" src="<?php echo esc_url($newsmunch_about_img); ?>" class="attachment-full size-full" alt="" style="width:100%;" />
		</div>
	<?php endif; ?>
	<div class="dt-col-lg-<?php if ( ! empty( $newsmunch_about_img ) ) : echo '6'; else: echo '12'; endif; ?>">
		<?php if ( ! empty( $newsmunch_about_ttl ) ) : ?>
			<div class="widget-header">
				<h4 class="widget-title"><?php echo wp_kses_post($newsmunch_about_ttl); ?></h4>
			</div>
		<?php endif; ?>
		<div class="dt-section-header dt-my-4">
			<?php if ( ! empty( $newsmunch_about_subttl ) ) : ?>
				<h2 class="dt-section-title dt-my-0"><?php echo wp_kses_post($newsmunch_about_subttl); ?></h2>
			<?php endif; ?>
			
			<?php if ( ! empty( $newsmunch_about_text ) ) : ?>
				<div class="dt-mt-2 dt-mb-0">
					<?php echo wp_kses_post($newsmunch_about_text); ?>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $newsmunch_about_content ) ) : echo do_shortcode($newsmunch_about_content); endif;?>
		</div>
		<?php if ( ! empty( $newsmunch_about_btn_lbl ) ) : ?>
			<a href="<?php echo esc_url($newsmunch_about_btn_link); ?>" class="dt-btn dt-btn-primary" data-title="<?php echo wp_kses_post($newsmunch_about_btn_lbl); ?>"><?php echo wp_kses_post($newsmunch_about_btn_lbl); ?></a>
		<?php endif; ?>
	</div>
</div>
<?php do_action('newsmunch_about_option_after'); ?>
<div class="spacer" data-height="50"></div>
<hr>