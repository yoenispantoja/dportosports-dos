<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NewsMunch
 */
get_header();
$newsmunch_archives_post_layout 		= get_theme_mod('newsmunch_archives_post_layout', 'list');
$newsmunch_archives_post_layout_list = $newsmunch_archives_post_layout == 'list' ? 'dt-posts-module' : 'padding-no dt-posts-module';
$newsmunch_archives_post_layouts_row = ( $newsmunch_archives_post_layout == 'list' || $newsmunch_archives_post_layout == 'grid' || $newsmunch_archives_post_layout == 'classic') ? 'dt-row dt-g-4 listgrid dt-posts' : 'dt-row-no dt-posts';
?>
<div class="dt-container-md">
	<div class="dt-row">
		<?php if (  !is_active_sidebar( 'newsmunch-sidebar-primary' ) ): ?>
			<div class="dt-col-lg-12 content-right">
		<?php else: ?>	
			<div id="dt-main" class="dt-col-lg-8 content-right">
		<?php endif; ?>	
			<div class="<?php echo esc_attr($newsmunch_archives_post_layout_list) ?>">
				<div class="<?php echo esc_attr($newsmunch_archives_post_layouts_row) ?>">
					<?php if( have_posts() ): ?>
					<?php 
					// Start the loop.
					while( have_posts() ) : the_post(); ?>
						<?php if($newsmunch_archives_post_layout=='grid'): ?>
							<div class="dt-col-sm-6">
								<?php get_template_part('template-parts/content','page'); ?>
							</div>
						<?php elseif($newsmunch_archives_post_layout=='classic'): ?>
							<div class="dt-col-md-12 dt-col-sm-12">
								<?php get_template_part('template-parts/content','page'); ?>
							</div>		
						<?php elseif($newsmunch_archives_post_layout=='list'): ?>
							<div class="dt-col-md-12 dt-col-sm-6">
								<?php get_template_part('template-parts/content','page-list'); ?>
							</div>
						<?php endif; ?>
					<?php endwhile; 
					// End the loop.
					
					 // Pagination.
						the_posts_pagination( array(
							'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
							'next_text'          => '<i class="fa fa-angle-double-right"></i>'
						) );
						
						// If no content, include the "No posts found" template.
					else: 
						get_template_part('template-parts/content','none'); 
					endif; ?>		
				</div>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
