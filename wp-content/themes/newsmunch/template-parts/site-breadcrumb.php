<?php 
$newsmunch_display_top_tags		= get_theme_mod( 'newsmunch_display_top_tags', 'front_post');
$newsmunch_display_slider 		= get_theme_mod( 'newsmunch_display_slider', 'front_post');
$newsmunch_display_featured_link= get_theme_mod( 'newsmunch_display_featured_link', 'front_post');
$newsmunch_site_hero				= get_theme_mod( 'newsmunch_site_hero', 'front_post');
if (((!is_front_page() && !is_home()) && ($newsmunch_display_slider=='post' || $newsmunch_display_slider=='front_post')) || ((!is_front_page() && !is_home()) && ($newsmunch_display_featured_link=='post' || $newsmunch_display_featured_link=='front_post')) || ((!is_front_page() && !is_home()) && ($newsmunch_site_hero=='post' || $newsmunch_site_hero=='front_post')) || ((!is_front_page() && !is_home()) && ($newsmunch_display_top_tags=='post' || $newsmunch_display_top_tags=='front_post'))):
$newsmunch_hs_site_breadcrumb    = get_theme_mod('newsmunch_hs_site_breadcrumb','1');
$newsmunch_breadcrumb_type    = get_theme_mod('newsmunch_breadcrumb_type','theme');
if($newsmunch_hs_site_breadcrumb == '1'):	
?>
<section class="page-header <?php if($newsmunch_breadcrumb_type=='theme3'): esc_attr_e('style-2','newsmunch'); else: esc_attr_e('dt-py-3','newsmunch'); endif; ?>">
	<div class="dt-container-md">
		<div class="dt-row">
			<div class="dt-col-12">
				<?php if($newsmunch_breadcrumb_type == 'yoast' && (function_exists('yoast_breadcrumb'))): ?> 
					<div class="dt-text-center dt-py-4">	
						<?php yoast_breadcrumb(); ?>
					</div>
				<?php elseif($newsmunch_breadcrumb_type == 'rankmath' && (function_exists('rank_math_the_breadcrumbs'))): ?> 
					<div class="dt-text-center dt-py-4">	
						<?php  rank_math_the_breadcrumbs(); ?>	
					</div>	
				<?php elseif($newsmunch_breadcrumb_type == 'navxt' && (function_exists('bcn_display'))): ?>
					<div class="dt-text-center dt-py-4">
						<?php bcn_display(); ?>
					</div>	
				<?php else: ?>
					<div class="dt-text-left dt-py-0">
						<nav class="breadcrumbs">
							<ol class="breadcrumb dt-justify-content-left dt-mt-0 dt-mb-0">
								<?php newsmunch_page_header_breadcrumbs(); ?>
							</ol>
						</nav>
					</div>
				<?php endif; ?>	
			</div>
		</div>
	</div>
</section>
<?php endif; endif;?>	