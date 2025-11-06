<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package NewsMunch
 */

get_header();
$newsmunch_single_pg_sidebar_option = get_theme_mod('newsmunch_single_pg_sidebar_option', 'right_sidebar'); 
$newsmunch_hs_latest_post_title		= get_theme_mod('newsmunch_hs_latest_post_title','1');
$newsmunch_hs_latest_post_tag_meta	= get_theme_mod('newsmunch_hs_latest_post_tag_meta','1');
$newsmunch_hs_latest_post_auth_meta	= get_theme_mod('newsmunch_hs_latest_post_auth_meta','1');
$newsmunch_hs_latest_post_date_meta	= get_theme_mod('newsmunch_hs_latest_post_date_meta','1');
$newsmunch_hs_latest_post_comment_meta	= get_theme_mod('newsmunch_hs_latest_post_comment_meta','1');
$newsmunch_hs_latest_post_content_meta= get_theme_mod('newsmunch_hs_latest_post_content_meta','1');
$newsmunch_hs_latest_post_social_share= get_theme_mod('newsmunch_hs_latest_post_social_share','1');
$newsmunch_latest_post_rm_type= get_theme_mod('newsmunch_latest_post_rm_type','style-1');
$newsmunch_latest_post_rm_lbl= get_theme_mod('newsmunch_latest_post_rm_lbl','Continue reading');
$format = get_post_format() ? : 'standard';
?>
<div class="dt-container-md">
	<div class="dt-row">
		<?php if($newsmunch_single_pg_sidebar_option == 'left_sidebar'): get_sidebar(); endif; ?>
		<div class="dt-col-lg-8 content-right">
			<div class="post post-single">
				<?php if( have_posts() ): 
					// Start the loop.
					while( have_posts() ): the_post();
						newsmunch_set_post_view(); ?>
						<div class="post-header">
							<?php 
								if($newsmunch_hs_latest_post_title=='1'):
									newsmunch_common_post_title('h1','title dt-mt-0 dt-mb-3');
								endif;
							?>
							<ul class="meta list-inline dt-mt-0 dt-mb-0">
								<?php if($newsmunch_hs_latest_post_auth_meta=='1'): ?>
									<?php do_action('newsmunch_common_post_author'); ?>
								<?php endif; ?>
								
								<?php if($newsmunch_hs_latest_post_tag_meta=='1'): ?>
									<li class="list-inline-item">
										<?php the_category(', '); ?>
									</li>
								<?php endif; ?>

								<?php if($newsmunch_hs_latest_post_date_meta=='1'): ?>
									<li class="list-inline-item"><?php echo esc_html(get_the_date( 'F j, Y' )); ?></li>
								<?php endif; ?>
								<?php if($newsmunch_hs_latest_post_comment_meta=='1'): ?>
									<li class="list-inline-item"><i class="far fa-comments"></i> <?php echo esc_html(get_comments_number($post->ID)); ?> <?php esc_html_e('Comments','newsmunch-pro'); ?> </li>
								<?php endif; ?>
							</ul>
						</div>
						<article class="is-single post-content clearfix post has-post-thumbnail">
							<div class="clearfix">
								<?php if ( has_post_thumbnail() ) { ?>
									<div class="featured-image">
										<?php the_post_thumbnail(); ?>
									</div>
								<?php } ?>
								<?php if($newsmunch_hs_latest_post_content_meta=='1'): ?> 
									<?php
										the_content(
											sprintf(
												__( 'Read More', 'newsmunch-pro' ),
												'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>'
											)
										);
									?>
								<?php endif; ?>
							</div>
							<footer class="clearfix">
								<div class="post-bottom">
									<div class="dt-row dt-d-flex dt-align-items-center">
										<div class="dt-col-md-6 dt-col-12">
											<?php if($newsmunch_hs_latest_post_social_share=='1'): ?>
												<?php newsmunch_post_sharing(); ?>
											<?php endif; ?>
										</div>
										<div class="dt-col-md-6 dt-col-12 dt-text-center dt-text-md-right">
											<div class="tags">
												<?php if($newsmunch_hs_latest_post_tag_meta=='1'): ?>
													<li class="list-inline-item">
													<?php
														if($newsmunch_hs_latest_post_tag_meta=='1'): 
															$posttags = get_the_tags();
															if($posttags){
																foreach($posttags as $index=>$tag){
																	echo '<a href="'.esc_url(get_tag_link($tag->term_id)).'">' .$tag->name. '</a>'; // echos while $index == 0 & 1
																	// if($index>0){break;}  // second iteration ($index==1) breaks the loop
																}
															}
														endif;
													?>
													</li>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							</footer>
						</article>
				<?php endwhile; // End the loop.
					endif; 
					// Author Box
					$newsmunch_hs_single_author_option	= get_theme_mod('newsmunch_hs_single_author_option','1');
					if($newsmunch_hs_single_author_option == '1'){
						get_template_part('template-parts/content/content','author'); 
					}
					$newsmunch_hs_single_post_nav	= get_theme_mod('newsmunch_hs_single_post_nav','1');
					if($newsmunch_hs_single_post_nav == '1'){
				?>
				<div class="dt-row nextprev-post-wrapper">
					<?php
					  the_post_navigation(array(
						'prev_text' => '<div class="nextprev-post prev"><h5 class="post-title"><i class="fas fa-angle-left"></i> %title </h5></div>',
						'next_text' => '<div class="nextprev-post prev"><h5 class="post-title"> %title <i class="fas fa-angle-right"></i></h5></div>',
						'in_same_term' => true,
					  ));
					?>
				</div>
				 <?php }
				 $newsmunch_hs_single_related_post	= get_theme_mod('newsmunch_hs_single_related_post','1');
				 if($newsmunch_hs_single_related_post == '1'){
					get_template_part('template-parts/content/content','related'); 
				 }
				 comments_template( '', true ); // show comments  ?>
			</div>
		</div>
		<?php if($newsmunch_single_pg_sidebar_option == 'right_sidebar'): get_sidebar(); endif; ?>
	</div>
</div>
<?php get_footer(); ?>
