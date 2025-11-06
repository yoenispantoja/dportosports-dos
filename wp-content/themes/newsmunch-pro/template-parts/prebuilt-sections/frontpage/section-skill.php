<?php  
$newsmunch_skill_ttl		= get_theme_mod('newsmunch_skill_ttl','Progress');
$newsmunch_skill_subttl		= get_theme_mod('newsmunch_skill_subttl','We Develop & Create Digital Future.');
$newsmunch_skill_text		= get_theme_mod('newsmunch_skill_text','Nec nascetur mus vicideolor rhoncus augue quisque parturientet imperdet sit nisi tellus veni faucibus orcimperdietenatis nullam rhoncus curabitur monteante.');
$newsmunch_skill_content	= get_theme_mod('newsmunch_skill_content','<div class="dt_skillbars">
                            <div class="dt_skillbars-item">
                                <div class="dt_skillbars-heading">UI/UX Design</div>
                                <div class="dt_skillbars-main" data-percent="70%">
                                    <div class="dt_skillbars-percent"><span class="dt_skillbars-count">70</span>%</div>
                                    <div class="dt_skillbars-line"></div>
                                </div>
                            </div>
                            <div class="dt_skillbars-item">
                                <div class="dt_skillbars-heading">Development</div>
                                <div class="dt_skillbars-main" data-percent="88%">
                                    <div class="dt_skillbars-percent"><span class="dt_skillbars-count">82</span>%</div>
                                    <div class="dt_skillbars-line"></div>
                                </div>
                            </div>
                            <div class="dt_skillbars-item">
                                <div class="dt_skillbars-heading">Success</div>
                                <div class="dt_skillbars-main" data-percent="92%">
                                    <div class="dt_skillbars-percent"><span class="dt_skillbars-count">92</span>%</div>
                                    <div class="dt_skillbars-line"></div>
                                </div>
                            </div>
                            <div class="dt_skillbars-item">
                                <div class="dt_skillbars-heading">Finished Projects</div>
                                <div class="dt_skillbars-main" data-percent="92%">
                                    <div class="dt_skillbars-percent"><span class="dt_skillbars-count">92</span>%</div>
                                    <div class="dt_skillbars-line"></div>
                                </div>
                            </div>
                        </div>');
$newsmunch_skill_btn_link	= get_theme_mod('newsmunch_skill_btn_link','https://www.youtube.com/watch?v=XHOmBV4js_E');
$newsmunch_skill_img	= get_theme_mod('newsmunch_skill_img',esc_url(get_template_directory_uri() .'/assets/img/other/about2.webp'));
$newsmunch_skill_icon	= get_theme_mod('newsmunch_skill_icon','fas fa-play');
do_action('newsmunch_skill_option_before');	
?>	
<div class="spacer" data-height="50"></div>
<div class="dt-row dt-g-5 hm-skill">
	<div class="dt-col-lg-<?php if ( ! empty( $newsmunch_skill_img ) ) : echo '6'; else: echo '12'; endif; ?>">
		<?php if ( ! empty( $newsmunch_skill_ttl ) ) : ?>
			<div class="widget-header">
				<h4 class="widget-title"><?php echo wp_kses_post($newsmunch_skill_ttl); ?></h4>
			</div>
		<?php endif; ?>
		<div class="dt-section-header dt-my-4">
			<?php if ( ! empty( $newsmunch_skill_subttl ) ) : ?>
				<h2 class="dt-section-title dt-my-0"><?php echo wp_kses_post($newsmunch_skill_subttl); ?></h2>
			<?php endif; ?>
			
			<?php if ( ! empty( $newsmunch_skill_text ) ) : ?>
				<p class="dt-mt-2 dt-mb-0">
					<?php echo wp_kses_post($newsmunch_skill_text); ?>
				</p>
			<?php endif; ?>
		</div>
		<?php if ( ! empty( $newsmunch_skill_content ) ) : ?>
			<?php echo do_shortcode($newsmunch_skill_content); ?>
		<?php endif; ?>
	</div>
	<?php if ( ! empty( $newsmunch_skill_img ) ) : ?>
		<div class="dt-col-lg-6">
			<div class="video-layout">
				<div class="video">
					<div class="img">
						<img decoding="async" loading="lazy" src="<?php echo esc_url($newsmunch_skill_img); ?>" class="attachment-full size-full" alt="" style="width:100%;" />
					</div>
					<?php if ( ! empty( $newsmunch_skill_icon ) ) : ?>
						<div class="icon">
							<a class="play video-popup" href="<?php echo esc_url($newsmunch_skill_btn_link); ?>"><i class="<?php echo esc_attr($newsmunch_skill_icon); ?>"></i></a>
						</div>
					<?php endif; ?>
				</div>
				<div class="element"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/other/element_1.png" class="attachment-full size-full" alt="" /></div>
			</div>
		</div>
	<?php endif; ?>
</div>
<?php do_action('newsmunch_skill_option_after'); ?>
<div class="spacer" data-height="50"></div>
<hr>