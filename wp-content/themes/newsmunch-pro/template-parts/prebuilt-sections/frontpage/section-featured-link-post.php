<?php  
$newsmunch_featured_link_post_style		= get_theme_mod('newsmunch_featured_link_post_style','style-1');
$newsmunch_featured_link_ttl			= get_theme_mod('newsmunch_featured_link_ttl','Featured Story');
$newsmunch_featured_link_cat			= get_theme_mod('newsmunch_featured_link_cat','0');
$newsmunch_featured_link_column			= get_theme_mod('newsmunch_featured_link_column','5');
$newsmunch_num_featured_link			= get_theme_mod('newsmunch_num_featured_link','100');
$newsmunch_posts						= newsmunch_get_posts($newsmunch_num_featured_link,$newsmunch_featured_link_cat);
$newsmunch_hs_featured_link_title		= get_theme_mod('newsmunch_hs_featured_link_title','1');
$newsmunch_hs_featured_link_cat_meta	= get_theme_mod('newsmunch_hs_featured_link_cat_meta','1');
$newsmunch_hs_featured_link_auth_meta	= get_theme_mod('newsmunch_hs_featured_link_auth_meta','1');
$newsmunch_hs_featured_link_date_meta	= get_theme_mod('newsmunch_hs_featured_link_date_meta','1');
$newsmunch_hs_featured_link_comment_meta= get_theme_mod('newsmunch_hs_featured_link_comment_meta');
$newsmunch_hs_featured_link_views_meta	= get_theme_mod('newsmunch_hs_featured_link_views_meta');
$newsmunch_hs_featured_link_pf_icon		= get_theme_mod('newsmunch_hs_featured_link_pf_icon','1');
if($newsmunch_featured_link_post_style=='style-1'):
?>
<section class="main-featured-section dt-mt-6">
	<div class="dt-container-md">
		<div class="dt-row">
			<div class="dt-col-12">
				<?php if(!empty($newsmunch_featured_link_ttl)): ?>
					<div class="widget-header fl-content">
						<h4 class="widget-title"><?php echo wp_kses_post($newsmunch_featured_link_ttl); ?></h4>
					</div>
				<?php endif; ?>
				<div class="featured-posts-carousel post-carousel post-carousel-column<?php echo esc_attr($newsmunch_featured_link_column); ?>" data-slick='{"slidesToShow": <?php echo esc_attr($newsmunch_featured_link_column); ?>, "slidesToScroll": 1}'>
					<?php
						if ($newsmunch_posts->have_posts()) :
						while ($newsmunch_posts->have_posts()) : $newsmunch_posts->the_post();

						global $post;
						$format = get_post_format() ? : 'standard';	
					?>
						<div class="post">
							<div class="thumb">
								<?php if($newsmunch_hs_featured_link_cat_meta=='1'): newsmunch_getpost_categories('','position-absolute');  endif; ?>
								<?php if ( $format !== 'standard' && $newsmunch_hs_featured_link_pf_icon=='1'): ?>
									<span class="post-format-sm">
										<?php do_action('newsmunch_post_format_icon_type'); ?>
									</span>
								<?php endif; ?>
								
								<a href="<?php echo esc_url(get_permalink()); ?>">
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="inner"> <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr(the_title()); ?>"></div>
									<?php else: ?>
										<div class="inner"></div>
									<?php endif; ?>
								</a>
							</div>
							<div class="details bg-white shadow dt-p-3 clearfix">
								<?php if($newsmunch_hs_featured_link_title=='1'): newsmunch_common_post_title('h6','post-title dt-mb-0 dt-mt-0'); endif; ?> 
								<ul class="meta list-inline dt-mt-2 dt-mb-0">
									<?php if($newsmunch_hs_featured_link_auth_meta=='1'): ?>
										<?php do_action('newsmunch_common_post_author'); ?>
									<?php endif; ?>	
									
									<?php if($newsmunch_hs_featured_link_date_meta=='1'): ?>
										<?php do_action('newsmunch_common_post_date'); ?>
									<?php endif; ?>	
									
									<?php if($newsmunch_hs_featured_link_comment_meta=='1'): ?>
										<li class="list-inline-item"><i class="far fa-comments"></i> <?php echo esc_html(get_comments_number($post->ID)); ?></li>
									<?php endif; ?>	
									
									<?php if($newsmunch_hs_featured_link_views_meta=='1'): ?>
										<li class="list-inline-item"><i class="far fa-eye"></i> <?php echo wp_kses_post(newsmunch_get_post_view()); ?></li>
									<?php endif; newsmunch_edit_post_link(); ?>
								</ul>
							</div>
						</div>
					<?php endwhile;endif;wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php elseif($newsmunch_featured_link_post_style=='style-2'): ?>
<section class="main-featured-section dt-mt-6">
	<div class="dt-container-md">
		<div class="dt-row">
			<div class="dt-col-12">
				<div class="widget dt_widget_post_list_sm" style="background: var(--dt-white-color);padding: 20px;box-shadow: 0 1px 3px rgba(0,0,0,0.12);">
					<?php if(!empty($newsmunch_featured_link_ttl)): ?>
						<div class="widget-header fl-content">
							<h4 class="widget-title"><?php echo wp_kses_post($newsmunch_featured_link_ttl); ?></h4>
						</div>
					<?php endif; ?>
					<div class="widget-content post-carousel-post_list_sm post-carousel post-carousel-column<?php echo esc_attr($newsmunch_featured_link_column); ?>" data-slick='{"slidesToShow": <?php echo esc_attr($newsmunch_featured_link_column); ?>, "slidesToScroll": 1}'>
						<?php
							if ($newsmunch_posts->have_posts()) :
							$i=0;
							while ($newsmunch_posts->have_posts()) : $newsmunch_posts->the_post();

							global $post;
							$format = get_post_format() ? : 'standard';	
						?>
							<div class="post-item">
								<div class="post post-list-sm circle">
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="thumb">
											<span class="number"><?php  $i++; echo esc_html($i); ?></span>
											<a href="<?php echo esc_url(get_permalink()); ?>">
												<?php if ( has_post_thumbnail() ) : ?>
													<div class="inner"> <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr(the_title()); ?>"></div>
												<?php else: ?>
													<div class="inner"></div>
												<?php endif; ?>
											</a>
										</div>
									<?php endif; ?>
									<div class="details clearfix">
										<?php if($newsmunch_hs_featured_link_cat_meta=='1'): newsmunch_getpost_categories();  endif; ?>
										<?php if($newsmunch_hs_featured_link_title=='1'): newsmunch_common_post_title('h6','post-title dt-my-1'); endif; ?> 
										<ul class="meta list-inline dt-mt-1 dt-mb-0">
											<?php if($newsmunch_hs_featured_link_auth_meta=='1'): ?>
												<?php do_action('newsmunch_common_post_author'); ?>
											<?php endif; ?>	
											
											<?php if($newsmunch_hs_featured_link_date_meta=='1'): ?>
												<?php do_action('newsmunch_common_post_date'); ?>
											<?php endif; ?>	
											
											<?php if($newsmunch_hs_featured_link_comment_meta=='1'): ?>
												<li class="list-inline-item"><i class="far fa-comments"></i> <?php echo esc_html(get_comments_number($post->ID)); ?></li>
											<?php endif; ?>	
											
											<?php if($newsmunch_hs_featured_link_views_meta=='1'): ?>
												<li class="list-inline-item"><i class="far fa-eye"></i> <?php echo wp_kses_post(newsmunch_get_post_view()); ?></li>
											<?php endif; newsmunch_edit_post_link(); ?>
										</ul>
									</div>
								</div>
							</div>
						<?php endwhile;endif;wp_reset_postdata(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php else: ?>
<section class="main-featured-section dt-mt-6">
	<div class="dt-container-md">
		<div class="dt-row">
			<div class="dt-col-12">	
				<?php if(!empty($newsmunch_featured_link_ttl)): ?>
					<div class="widget-header fl-content">
						<h4 class="widget-title"><?php echo wp_kses_post($newsmunch_featured_link_ttl); ?></h4>
					</div>
				<?php endif; ?>
				<div class="post-carousel-missed post-carousel post-carousel-column<?php echo esc_attr($newsmunch_featured_link_column); ?>" data-slick='{"slidesToShow": <?php echo esc_attr($newsmunch_featured_link_column); ?>, "slidesToScroll": 1}'>  
					<?php
						if ($newsmunch_posts->have_posts()) :
						while ($newsmunch_posts->have_posts()) : $newsmunch_posts->the_post();

						global $post;
						$format = get_post_format() ? : 'standard';	
					?>
						<div class="post post-over-content">
							<div class="details clearfix">
								<?php if($newsmunch_hs_featured_link_cat_meta=='1'): newsmunch_getpost_categories();  endif; ?>
								<?php if($newsmunch_hs_featured_link_title=='1'): newsmunch_common_post_title('h4','post-title'); endif; ?> 
								<ul class="meta list-inline dt-mt-0 dt-mb-0">
									<?php if($newsmunch_hs_featured_link_auth_meta=='1'): ?>
										<li class="list-inline-item"><i class="far fa-user-circle"></i> <?php esc_html_e('By','newsmunch-pro');?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>" title="Posts by David" rel="author"><?php esc_html(the_author()); ?></a></li>
									<?php endif; ?>	
									
									<?php if($newsmunch_hs_featured_link_date_meta=='1'): ?>
										<?php do_action('newsmunch_common_post_date'); ?>
									<?php endif; ?>	
									
									<?php if($newsmunch_hs_featured_link_comment_meta=='1'): ?>
										<li class="list-inline-item"><i class="far fa-comments"></i> <?php echo esc_html(get_comments_number($post->ID)); ?></li>
									<?php endif; ?>	
									
									<?php if($newsmunch_hs_featured_link_views_meta=='1'): ?>
										<li class="list-inline-item"><i class="far fa-eye"></i> <?php echo wp_kses_post(newsmunch_get_post_view()); ?></li>
									<?php endif; newsmunch_edit_post_link(); ?>
								</ul>
							</div>
							<a href="blog-single.html">
								<?php if ( $format !== 'standard' && $newsmunch_hs_featured_link_pf_icon=='1'): ?>
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
<?php endif; ?>