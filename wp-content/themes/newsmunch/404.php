<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package NewsMunch
 */

get_header();
$newsmunch_pg_404_ttl		= get_theme_mod('newsmunch_pg_404_ttl','<b class="is_on">Page Not Found</b><b>Page Not Found</b><b>Page Not Found</b>');
$newsmunch_pg_404_subttl2	= get_theme_mod('newsmunch_pg_404_subttl2',"Oops! That page can't be found.");
$newsmunch_pg_404_btn_lbl	= get_theme_mod('newsmunch_pg_404_btn_lbl','Return To Home');
$newsmunch_pg_404_btn_link	= get_theme_mod('newsmunch_pg_404_btn_link',esc_url( home_url( '/' ) ));
?>
<div id="dt_not_found" class="dt_not_found dt-py-6">
	<div class="dt-container-md">
		<div class="dt-row">
			<div class="dt-col-xl-7 dt-col-lg-8 dt-col-md-9 dt-col-12 dt-mx-auto dt-mb-6">
				<div class="dt_siteheading dt-text-center">
					<?php if ( ! empty($newsmunch_pg_404_ttl) ) : ?>	
						<span class="subtitle">
							<span class="dt_heading dt_heading_8">
								<span class="dt_heading_inner">
									<?php echo wp_kses_post($newsmunch_pg_404_ttl); ?>
								</span>
							</span>
						</span>
					<?php endif; ?> 
					<div class="dt_siteheading_box">
						<h2 class="title">
							<i class="fas fa-4" aria-hidden="true"></i> <i class="fas fa-question" aria-hidden="true"></i> <i class="fas fa-4" aria-hidden="true"></i>
						</h2>
						
						<?php if ( ! empty($newsmunch_pg_404_subttl2) ) : ?>	
							<h3 class="dt-mt-4"><?php echo wp_kses_post($newsmunch_pg_404_subttl2); ?></h3>
						<?php endif; ?> 
						
						<?php if ( ! empty($newsmunch_pg_404_btn_lbl) ) : ?>	
							<a href="<?php echo esc_url($newsmunch_pg_404_btn_link); ?>" class="dt-btn dt-btn-primary dt-mt-5">
								<span class="dt-btn-text" data-text="<?php echo wp_kses_post($newsmunch_pg_404_btn_lbl); ?>"><?php echo wp_kses_post($newsmunch_pg_404_btn_lbl); ?></span>
							</a>
						<?php endif; ?> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
