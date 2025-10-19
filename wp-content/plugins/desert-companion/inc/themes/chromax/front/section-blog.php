<?php  
$chromax_blog_options_hide_show= get_theme_mod('chromax_blog_options_hide_show','1');
$chromax_blog_ttl		= get_theme_mod('chromax_blog_ttl','Blog & News'); 
$chromax_blog_subttl	= get_theme_mod('chromax_blog_subttl','Get Update Blog & News');
$chromax_blog_cat	    = get_theme_mod('chromax_blog_cat'); 
$chromax_blog_num		= get_theme_mod('chromax_blog_num','3');
if($chromax_blog_options_hide_show=='1'):	
?>
<section id="dt_posts" class="dt_posts dt-py-default front-posts">
	<div class="dt-container">
		<?php if ( ! empty( $chromax_blog_ttl )  || ! empty( $chromax_blog_subttl )) : ?>
			<div class="dt-row justify-content-center">
				<div class="dt-col-lg-8 dt-col-sm-12 dt-col-12">
					<div class="section-title dt-text-center dt-mb-6">
						<?php if ( ! empty( $chromax_blog_ttl ) ) : ?>
							<div class="sub-title">
								<div class="anime-dots"><span></span></div>
								<span class="text-animate"><?php echo wp_kses_post($chromax_blog_ttl); ?></span>
								<div class="anime-dots"><span></span></div>
							</div>
						<?php endif; ?>	
						
						<?php if ( ! empty( $chromax_blog_subttl ) ) : ?>
							<h2 class="title text-animate"><?php echo wp_kses_post($chromax_blog_subttl); ?></h2>
						<?php endif; ?>	
					</div>
				</div>
			</div>
		<?php endif; ?>	
		<div class="dt-row dt-g-4">
			<?php 
				$chromax_post_args = array( 'post_type' => 'post', 'category__in' => $chromax_blog_cat, 'posts_per_page' => $chromax_blog_num,'post__not_in'=>get_option("sticky_posts")) ; 	
				
				$chromax_wp_query = new WP_Query($chromax_post_args);
				if($chromax_wp_query)
				{	
				$i = 0;
				while($chromax_wp_query->have_posts()):$chromax_wp_query->the_post();
			?>
				<div class="dt-col-lg-4 dt-col-sm-6 dt-col-12 wow fadeInUp animated" data-wow-delay="<?php echo esc_attr(($i+1)*100); ?>ms" data-wow-duration="1500ms">
					<?php get_template_part('template-parts/content','page');  ?>
				</div>
			<?php $i=(int)$i + 1; endwhile; } wp_reset_postdata(); ?>
		</div>
	</div>
</section>
<?php endif; ?>