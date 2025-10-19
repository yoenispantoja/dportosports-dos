<?php
$newsmunch_related_post_ttl		= get_theme_mod('newsmunch_related_post_ttl','Related Posts');
$newsmunch_archives_post_layout = get_theme_mod('newsmunch_archives_post_layout', 'list');
?>
<div class="spacer" data-height="50" style="height: 50px;"></div>
<div class="dt-container-md">
	<?php if ( ! empty( $newsmunch_related_post_ttl ) ) : ?>
		<div class="widget-header">
			<h4 class="widget-title"><?php echo wp_kses_post($newsmunch_related_post_ttl); ?></h4>
		</div>
	<?php endif; ?>
	<div class="dt-row">
		<div class="dt-col-lg-12 content-right">
			<?php if($newsmunch_archives_post_layout=='grid'): ?>
			<div class="padding-30">
				<div class="dt-row">
			<?php endif; ?>
					<?php global $post;
						$categories = get_the_category($post->ID);
						$number_of_related_posts = 2; 
						if ($categories) {
							$cat_ids = array();
                        foreach ($categories as $category) $cat_ids[] = $category->term_id;
                        $args = array(
                            'category__in' => $cat_ids,
                            'post__not_in' => array($post->ID),
                            'posts_per_page' => $number_of_related_posts,
                            'ignore_sticky_posts' => 1
                        );
                        $related_posts = new wp_query($args);
                        while ($related_posts->have_posts()) {
                            $related_posts->the_post();
                            global $post;
                            ?>
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
					<?php }}wp_reset_postdata(); ?>
			<?php if($newsmunch_archives_post_layout=='grid'): ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>