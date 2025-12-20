<?php  
$newsmunch_you_missed_ttl			= get_theme_mod('newsmunch_you_missed_ttl','You Missed');
$newsmunch_you_missed_cat			= get_theme_mod('newsmunch_you_missed_cat','0');
$newsmunch_num_you_missed			= get_theme_mod('newsmunch_num_you_missed','6');
$newsmunch_posts					= newsmunch_get_posts($newsmunch_num_you_missed, $newsmunch_you_missed_cat);
$newsmunch_hs_you_missed_title		= get_theme_mod('newsmunch_hs_you_missed_title','1');
$newsmunch_hs_you_missed_cat_meta	= get_theme_mod('newsmunch_hs_you_missed_cat_meta','1');
$newsmunch_hs_you_missed_auth_meta	= get_theme_mod('newsmunch_hs_you_missed_auth_meta','1');
$newsmunch_hs_you_missed_date_meta	= get_theme_mod('newsmunch_hs_you_missed_date_meta','1');
$newsmunch_hs_you_missed_view_meta	= get_theme_mod('newsmunch_hs_you_missed_view_meta','1');
$newsmunch_hs_you_missed_comment_meta= get_theme_mod('newsmunch_hs_you_missed_comment_meta');
$newsmunch_hs_you_missed_pf			= get_theme_mod('newsmunch_hs_you_missed_pf','1');
?>
<section class="main-missed-section dt-mt-6">
	<div class="dt-container-md">
		<div class="dt-row">
			<div class="dt-col-12">
				<?php if(!empty($newsmunch_you_missed_ttl)): ?>
					<div class="widget-header ym-content">
						<h4 class="widget-title"><?php echo wp_kses_post($newsmunch_you_missed_ttl); ?></h4>
					</div>
				<?php endif; ?>
				<div class="post-carousel-missed post-carousel">  
					<?php 
						if ($newsmunch_posts->have_posts()) :
							while ($newsmunch_posts->have_posts()) : $newsmunch_posts->the_post();
							global $post;
							$format = get_post_format() ? : 'standard';	
					?>
						<div class="post post-over-content">
							<div class="details clearfix">
								<?php if($newsmunch_hs_you_missed_cat_meta=='1'): ?>	
									<?php newsmunch_getpost_categories('',''); ?>
								<?php endif; ?>
								<?php if($newsmunch_hs_you_missed_title=='1'): newsmunch_common_post_title('h4','post-title'); endif; ?>
								<ul class="meta list-inline dt-mt-0 dt-mb-0">
									<?php if($newsmunch_hs_you_missed_auth_meta=='1'): ?>
										<li class="list-inline-item"><i class="far fa-user-circle"></i> <?php esc_html_e('By','newsmunch');?> <a href="<?php echo esc_url(get_author_posts_url( absint(get_the_author_meta( 'ID' )) ));?>"><?php echo esc_html(get_the_author()); ?></a></li>
									<?php endif; ?>	
									
									<?php if($newsmunch_hs_you_missed_date_meta=='1'): ?>
										<?php do_action('newsmunch_common_post_date'); ?>
									<?php endif; ?>	
									
									<?php if($newsmunch_hs_you_missed_comment_meta=='1'): ?>
										<li class="list-inline-item"><i class="far fa-comments"></i> <?php echo esc_html(get_comments_number($post->ID)); ?></li>
									<?php endif; ?>
									
									<?php if($newsmunch_hs_you_missed_view_meta=='1'): ?>
										<li class="list-inline-item"><i class="far fa-eye"></i> <?php echo wp_kses_post(newsmunch_get_post_view()); ?></li>
									<?php endif; newsmunch_edit_post_link(); ?>
								</ul>
							</div>
							<a href="<?php echo esc_url(get_permalink()); ?>">
								<?php if ( $format !== 'standard' && $newsmunch_hs_you_missed_pf=='1'): ?>
									<span class="post-format-sm">
										<?php do_action('newsmunch_post_format_icon_type'); ?>
									</span>
								<?php endif; ?>
								<div class="thumb">
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="inner"> <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr(the_title()); ?>"></div>
									<?php else: ?>
										<div class="inner"></div>
									<?php endif; ?>
								</div>
							</a>
						</div>
					<?php endwhile;endif;wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</section>