<?php
$newsmunch_slider_right_type		= get_theme_mod('newsmunch_slider_right_type','style-1');
$newsmunch_slider_position		= get_theme_mod('newsmunch_slider_position','left') == 'left' ? '': 'dt-flex-row-reverse';
$newsmunch_slider_type			= get_theme_mod('newsmunch_slider_type','lg');
$newsmunch_hs_slider_left		= get_theme_mod('newsmunch_hs_slider_left','1');
$newsmunch_hs_slider_mdl		= get_theme_mod('newsmunch_hs_slider_mdl','1');
$newsmunch_hs_slider_right		= get_theme_mod('newsmunch_hs_slider_right','1');
$newsmunch_slider_bg_img		= get_theme_mod('newsmunch_slider_bg_img');
$newsmunch_slider_right_type	= get_theme_mod('newsmunch_slider_right_type','style-1');
do_action('newsmunch_slider_option_before');

// Custom CSS for mobile ordering - Applied globally to this section
echo '<style>
.main-banner-section { margin-top: 30px; }
@media (max-width: 1199px) {
    .main-banner-section .dt-row {
        display: flex !important;
        flex-direction: column !important;
    }
    .mobile-order-1 { order: 1 !important; }
    .mobile-order-2 { order: 2 !important; }
    .mobile-order-3 { order: 3 !important; }
}
</style>';

if($newsmunch_slider_right_type=='style-1'):
?>
<section class="main-banner-section clearfix <?php echo esc_attr($newsmunch_slider_right_type); ?> <?php if(!empty($newsmunch_slider_bg_img)): ?> overlay_bg<?php endif; ?>" <?php if(!empty($newsmunch_slider_bg_img)): ?> style="background-image: url(<?php echo esc_url($newsmunch_slider_bg_img); ?>);"<?php endif; ?>>
	<div class="dt-container-md">
		<div class="dt-row dt-g-4 <?php echo esc_attr($newsmunch_slider_position);?>">
			<?php if($newsmunch_hs_slider_left=='1'): ?>
				<div class="dt-col-xl-<?php if($newsmunch_hs_slider_mdl =='' && $newsmunch_hs_slider_right ==''): esc_attr_e('12','newsmunch-pro'); elseif($newsmunch_hs_slider_mdl =='' || $newsmunch_hs_slider_right ==''):  esc_attr_e('9','newsmunch-pro'); else: esc_attr_e('6','newsmunch-pro'); endif; ?> mobile-order-1">
					<?php do_action('newsmunch_site_slider_main');?>
				</div>
			<?php endif; ?>

			<?php if($newsmunch_hs_slider_mdl=='1'): ?>
				<div class="dt-col-xl-<?php if($newsmunch_hs_slider_left==''): esc_attr_e('8 dt-col-lg-8','newsmunch-pro'); else: esc_attr_e('3 dt-col-md-6','newsmunch-pro'); endif; ?> mobile-order-3">
					<?php do_action('newsmunch_site_slider_middle'); ?>
				</div>
			<?php endif; ?>

			<?php if($newsmunch_hs_slider_right=='1'): ?>
				<div class="dt-col-xl-<?php if($newsmunch_hs_slider_left==''): esc_attr_e('4 dt-col-lg-4','newsmunch-pro'); else: esc_attr_e('3 dt-col-md-6','newsmunch-pro'); endif; ?> mobile-order-2">
					<?php do_action('newsmunch_site_slider_right'); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php elseif($newsmunch_slider_right_type=='style-2'): ?>
<section class="main-banner-section clearfix style-1" <?php if(!empty($newsmunch_slider_bg_img)): ?> style="background-image: url(<?php echo esc_url($newsmunch_slider_bg_img); ?>);"<?php endif; ?>>
	<div class="dt-container-md">
		<div class="dt-row dt-g-4 <?php echo esc_attr($newsmunch_slider_position);?>">

			<?php if($newsmunch_hs_slider_mdl=='1'): ?>
				<div class="dt-col-xl-<?php if($newsmunch_hs_slider_left==''): esc_attr_e('8','newsmunch-pro'); else: esc_attr_e('3 dt-col-md-6','newsmunch-pro'); endif; ?> mobile-order-3">
					<?php do_action('newsmunch_site_slider_middle'); ?>
				</div>
			<?php endif; ?>

			<?php if($newsmunch_hs_slider_left=='1'): ?>
				<div class="dt-col-xl-<?php if($newsmunch_hs_slider_mdl =='' && $newsmunch_hs_slider_right ==''): esc_attr_e('12','newsmunch-pro'); elseif($newsmunch_hs_slider_mdl =='' || $newsmunch_hs_slider_right ==''):  esc_attr_e('9','newsmunch-pro'); else: esc_attr_e('6','newsmunch-pro'); endif; ?> mobile-order-1">
					<?php do_action('newsmunch_site_slider_main');?>
				</div>
			<?php endif; ?>

			<?php if($newsmunch_hs_slider_right=='1'): ?>
				<div class="dt-col-xl-<?php if($newsmunch_hs_slider_left==''): esc_attr_e('4','newsmunch-pro'); else: esc_attr_e('3 dt-col-md-6','newsmunch-pro'); endif; ?> mobile-order-2">
					<?php do_action('newsmunch_site_slider_right'); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php elseif($newsmunch_slider_right_type=='style-3'): ?>
<section class="main-banner-section clearfix style-1" <?php if(!empty($newsmunch_slider_bg_img)): ?> style="background-image: url(<?php echo esc_url($newsmunch_slider_bg_img); ?>);"<?php endif; ?>>
	<div class="dt-container-md">
		<div class="dt-row dt-g-4 <?php echo esc_attr($newsmunch_slider_position);?>">
			<?php if($newsmunch_hs_slider_right=='1'): ?>
				<div class="dt-col-xl-<?php if($newsmunch_hs_slider_left==''): esc_attr_e('4','newsmunch-pro'); else: esc_attr_e('3 dt-col-md-6','newsmunch-pro'); endif; ?> mobile-order-2">
					<?php do_action('newsmunch_site_slider_right'); ?>
				</div>
			<?php endif; ?>
			<?php if($newsmunch_hs_slider_left=='1'): ?>
				<div class="dt-col-xl-<?php if($newsmunch_hs_slider_mdl =='' && $newsmunch_hs_slider_right ==''): esc_attr_e('12','newsmunch-pro'); elseif($newsmunch_hs_slider_mdl =='' || $newsmunch_hs_slider_right ==''):  esc_attr_e('9','newsmunch-pro'); else: esc_attr_e('6','newsmunch-pro'); endif; ?> mobile-order-1">
					<?php do_action('newsmunch_site_slider_main');?>
				</div>
			<?php endif; ?>

			<?php if($newsmunch_hs_slider_mdl=='1'): ?>
				<div class="dt-col-xl-<?php if($newsmunch_hs_slider_left==''): esc_attr_e('8','newsmunch-pro'); else: esc_attr_e('3 dt-col-md-6','newsmunch-pro'); endif; ?> mobile-order-3">
					<?php do_action('newsmunch_site_slider_middle'); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>
<?php do_action('newsmunch_slider_option_after'); ?>