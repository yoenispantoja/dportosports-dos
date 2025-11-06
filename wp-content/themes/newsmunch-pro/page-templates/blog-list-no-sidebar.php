<?php 
/**
Template Name: Blog List No Sidebar
*/

get_header();
?>
<div class="dt-container-md">
	<div class="dt-row">
		<div class="dt-col-lg-12 content-right">
			<div class="dt-posts-module">
				<div class="dt-row dt-g-4 dt-posts">
					<?php 
						$newsmunch_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
						$args = array( 'post_type' => 'post','paged'=>$newsmunch_paged );	
						$loop = new WP_Query( $args );
					?>
					<?php if( $loop->have_posts() ): ?>
					<?php  while( $loop->have_posts() ): $loop->the_post(); ?>
						<article class="dt-col-md-12">
							<?php get_template_part('template-parts/content/content','page-list'); ?>
						</article>
					<?php  endwhile; endif; ?>			
				</div>
				<div class="dt-text-center">
					<?php			
						$GLOBALS['wp_query']->max_num_pages = $loop->max_num_pages;						
						do_action('newsmunch_post_pagination');
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>