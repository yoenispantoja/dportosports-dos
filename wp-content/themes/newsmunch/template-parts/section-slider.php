<?php 
$newsmunch_hs_slider_left		= get_theme_mod('newsmunch_hs_slider_left','1');
$newsmunch_hs_slider_mdl		= get_theme_mod('newsmunch_hs_slider_mdl','1');
$newsmunch_hs_slider_right		= get_theme_mod('newsmunch_hs_slider_right','1');
$newsmunch_slider_bg_img		= get_theme_mod('newsmunch_slider_bg_img');
?>	
<section class="main-banner-section clearfix style-1" <?php if(!empty($newsmunch_slider_bg_img)): ?> style="background-image: url(<?php echo esc_url($newsmunch_slider_bg_img); ?>);"<?php endif; ?>>
	<div class="dt-container-md">
		<div class="dt-row dt-g-4">  
			<?php if($newsmunch_hs_slider_left=='1'): ?>
				<div class="dt-col-xl-<?php if($newsmunch_hs_slider_mdl =='' && $newsmunch_hs_slider_right ==''): esc_attr_e('12','newsmunch'); elseif($newsmunch_hs_slider_mdl =='' || $newsmunch_hs_slider_right ==''):  esc_attr_e('9','newsmunch'); else: esc_attr_e('6','newsmunch'); endif; ?>">
					<?php do_action('newsmunch_site_slider_main');?>
				</div>
			<?php endif; ?>	
			
			<?php if($newsmunch_hs_slider_mdl=='1'): ?>
				<div class="dt-col-xl-<?php if($newsmunch_hs_slider_left==''): esc_attr_e('8 dt-col-lg-8','newsmunch'); else: esc_attr_e('3 dt-col-md-6','newsmunch'); endif; ?>">
					<?php do_action('newsmunch_site_slider_middle'); ?>
				</div>
			<?php endif; ?>
			
			<?php if($newsmunch_hs_slider_right=='1'): ?>
				<div class="dt-col-xl-<?php if($newsmunch_hs_slider_left==''): esc_attr_e('4 dt-col-lg-4','newsmunch'); else: esc_attr_e('3 dt-col-md-6','newsmunch'); endif; ?>">
					<?php do_action('newsmunch_site_slider_right'); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
