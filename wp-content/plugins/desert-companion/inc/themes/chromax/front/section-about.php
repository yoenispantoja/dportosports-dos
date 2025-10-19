<?php  
$chromax_about_options_hide_show  		= get_theme_mod('chromax_about_options_hide_show','1');
$chromax_about_left_ttl		= get_theme_mod('chromax_about_left_ttl','About us our company'); 
$chromax_about_left_subttl		= get_theme_mod('chromax_about_left_subttl','Smart & Cost-Efficient <i>Portals</i> with <span>Cutting-Edge</span> Tech');  
$chromax_about_left_content	= get_theme_mod('chromax_about_left_content',' <div class="text">Renowned as the premier IT services company in the city, our organic nation stands out for its unparalleled expertise, commitment to excellence.</div>
        <div class="about-buttons dt-mt-5">
            <a href="#" class="dt-btn dt-btn-primary">Discover More</a>
        </div>');
$chromax_about_right_content = get_theme_mod('chromax_about_right_content','<div class="about-image"><img src="'.esc_url(desert_companion_plugin_url) .'/inc/themes/chromax/assets/images/about-1.jpg" alt="" /></div>');
if($chromax_about_options_hide_show=='1'):								
?>	
<section id="dt_about" class="dt_about dt_about--one dt-py-default front-about">
	<div class="bg-shape-image" data-background="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/pattern-1.png"></div>
	<div class="dt-container">
		<div class="dt-row dt-g-4 justify-content-center">
			<div class="dt-col-lg-<?php if(!empty($chromax_about_right_content)):  esc_attr_e('6','desert-companion'); else: esc_attr_e('12','desert-companion'); endif; ?> dt-col-sm-12 dt-col-12">
				<div class="section-title dt-mb-6">
					<?php if(!empty($chromax_about_left_ttl)): ?>
						<div class="sub-title">
							<span class="text-animate"><?php echo wp_kses_post($chromax_about_left_ttl); ?></span>
							<div class="anime-dots"><span></span></div>
						</div>
					<?php endif; ?>
					
					<?php if(!empty($chromax_about_left_subttl)): ?>
						<h2 class="title text-animate"><?php echo wp_kses_post($chromax_about_left_subttl); ?></h2>
					<?php endif; ?>
				</div>
				
				<?php if(!empty($chromax_about_left_content)):  echo do_shortcode($chromax_about_left_content);  endif; ?>
			</div>
			
			<?php if(!empty($chromax_about_right_content)): ?>
				<div class="dt-col-lg-6 dt-col-sm-12 dt-col-12">
					<div class="about-image-outer">
						<?php echo do_shortcode($chromax_about_right_content); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>