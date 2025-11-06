<?php 
/**
Template Name: Author Page
*/

get_header();
$newsmunch_pg_author_cat			= get_theme_mod('newsmunch_pg_author_cat','0');
$author_pg_author_exclude			= get_theme_mod('author_pg_author_exclude','0');
$newsmunch_author_pg_sidebar_option = get_theme_mod('newsmunch_author_pg_sidebar_option', 'right_sidebar');
$newsmunch_archives_post_layout 	= get_theme_mod('newsmunch_archives_post_layout', 'list');
?>
<div class="dt-container-md">
	<div class="dt-row dt-mb-4">
		<div class="dt-col-lg-12">
			<?php
				 $args = array(
					 'exclude'  => $author_pg_author_exclude,
				);
				$users = get_users($args);
				foreach ($users as $user) 
				{
			?>
			<div class="post">
				<div class="about-author padding-30">
					<div class="thumb">
						<a href="<?php echo esc_url(get_author_posts_url( $user->ID ));?>"><?php echo get_avatar( $user->ID, 200); ?></a>
					</div>
					<div class="details">
						<h4 class="name"><a href="<?php echo esc_url(get_author_posts_url( $user->ID ));?>"><?php echo $user->display_name; ?></a></h4>
						<p><?php echo $user->description; ?></p>
						<div class="social-share">
							<ul class="icons list-unstyled list-inline dt-mt-0 dt-mb-0">
								<?php $facebook_profile = $user->facebook_profile; 
								if ( $facebook_profile != '' ): ?>
									<li class="list-inline-item"><a href="<?php echo esc_url($facebook_profile); ?>" target="_blank" rel="noopener" class="fa-brands fa-facebook"></a></li>
								<?php endif; ?>
								
								<?php $instagram_profile = $user->instagram_profile; 
								if ( $instagram_profile != '' ): ?>
									<li class="list-inline-item"><a href="<?php echo esc_url($facebook_profile); ?>" target="_blank" rel="noopener" class="fa-brands fa-instagram"></a></li>
								<?php endif; ?>
								
								<?php $linkedin_profile = $user->linkedin_profile; 
								if ( $linkedin_profile != '' ): ?>
									<li class="list-inline-item"><a href="<?php echo esc_url($facebook_profile); ?>" target="_blank" rel="noopener" class="fa-brands fa-linkedin"></a></li>
								<?php endif; ?>
								
								<?php $twitter_profile = $user->twitter_profile; 
								if ( $twitter_profile != '' ): ?>
									<li class="list-inline-item"><a href="<?php echo esc_url($twitter_profile); ?>" target="_blank" rel="noopener" class="fa-brands fa-twitter"></a></li>
								<?php endif; ?>
								
								<?php $youtube_profile = $user->youtube_profile; 
								if ( $youtube_profile != '' ): ?>
									<li class="list-inline-item"><a href="<?php echo esc_url($youtube_profile); ?>" target="_blank" rel="noopener" class="fa-brands fa-youtube"></a></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="dt-row dt-gx-4 dt-gy-5">
		<?php if($newsmunch_author_pg_sidebar_option == 'left_sidebar'): get_sidebar(); endif; ?>
		<?php if($newsmunch_author_pg_sidebar_option == 'no_sidebar'): ?>
			<div class="dt-col-lg-12 content-right">
		<?php else: ?>	
			<div id="dt-main" class="dt-col-lg-8 content-right">
		<?php endif; ?>
			<div class="dt-posts-module">
				<div class="dt-row dt-g-4 dt-posts">
				<?php 
					$newsmunch_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
					$newsmunch_blog_args = array( 'post_type' => 'post', 'category__in' => $newsmunch_pg_author_cat,'paged'=>$newsmunch_paged) ; 	
					$newsmunch_wp_query = new WP_Query($newsmunch_blog_args);
					if($newsmunch_wp_query)
					{	
					 while($newsmunch_wp_query->have_posts()):$newsmunch_wp_query->the_post();
				?>	
					<?php if($newsmunch_archives_post_layout=='grid'): ?>
						<div class="dt-col-sm-6">
							<?php get_template_part('template-parts/content/content','page'); ?>
						</div>
					<?php elseif($newsmunch_archives_post_layout=='list'): ?>
						<div class="dt-col-md-12 dt-col-sm-6">
							<?php get_template_part('template-parts/content/content','page-list'); ?>
						</div>
					<?php endif; ?>
				<?php endwhile; } wp_reset_postdata(); ?>
					<?php			
						$GLOBALS['wp_query']->max_num_pages = $newsmunch_wp_query->max_num_pages;						
						// Previous/next page navigation.
						the_posts_pagination( array(
						'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
						'next_text'          => '<i class="fa fa-angle-double-right"></i>',
						) ); 
					?>
				</div>
			</div>
		</div>
		<?php if($newsmunch_author_pg_sidebar_option == 'right_sidebar'): get_sidebar(); endif; ?>
	</div>
</div>
<?php get_footer(); ?>