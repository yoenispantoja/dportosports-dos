<?php  
$newsmunch_featured_link_type			= get_theme_mod('newsmunch_featured_link_type','category');
$newsmunch_featured_link_ttl			= get_theme_mod('newsmunch_featured_link_ttl','Featured Story');
$newsmunch_featured_link_custom			= get_theme_mod('newsmunch_featured_link_custom',newsmunch_featured_link_custom_options_default());
$newsmunch_featured_link_column			= get_theme_mod('newsmunch_featured_link_column','5');
$newsmunch_featured_link_option_before	= get_theme_mod('newsmunch_featured_link_option_before');
$newsmunch_featured_link_option_after	= get_theme_mod('newsmunch_featured_link_option_after');
$newsmunch_category_options=array('itemsCount'=>$newsmunch_featured_link_column);
wp_register_script('newsmunch-popular-category',get_template_directory_uri().'/assets/js/frontpage/popular-categories.js',array('jquery'));
wp_localize_script('newsmunch-popular-category','newsmunch_category_options',$newsmunch_category_options);
wp_enqueue_script('newsmunch-popular-category');
?>	
<?php if($newsmunch_featured_link_type=='category'): ?>
	<section class="hero-carousel popular-categories dt-mt-6">
		<div class="dt-container-md">
			<div class="dt-row">
				<?php if(!empty($newsmunch_featured_link_ttl)): ?>
					<div class="dt-col-12">
						<div class="widget-header fl-content">
							<h4 class="widget-title"><?php echo wp_kses_post($newsmunch_featured_link_ttl); ?></h4>
						</div>
					</div>
				<?php endif; ?>
				<div class="dt-col-12 popular-categories-carousel post-carousel">
					<?php
						$categories = get_categories( array(
							'orderby' => 'name',
							'order'   => 'ASC'
						) );
						foreach( $categories as $category ) {
							 $thumbnail_id = get_term_meta( $category->term_id, 'category-image-id', true );
							 $image = wp_get_attachment_url( $thumbnail_id );
							 $newsmunch_cat_article_lbl = get_term_meta( $category->term_id, 'newsmunch_cat_article_lbl', true );
					?>
						<div class="post featured-post-md">
							<div class="details clearfix">
								<h4 class="post-title"><a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo esc_html($category->name ); ?></a></h4>
								
								<p class="post-number dt-mt-2"><?php echo esc_html($category->count); ?> &nbsp;<span class="dot small"></span> <?php echo esc_html($newsmunch_cat_article_lbl ); ?></p>
							</div>
							<a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
								<div class="thumb">
									<div class="overlay decoration-border"></div>
									<?php if ( $image ) : ?>
									<div class="inner data-bg-image" data-bg-image="<?php echo esc_url($image); ?>"></div>
									<?php else: ?>
									<div class="inner"></div>
									<?php endif; ?>
								</div>
							</a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
<?php else: ?>
<section class="hero-carousel popular-categories dt-mt-6">
	<div class="dt-container-md">
		<div class="dt-row">
			<div class="dt-col-12 popular-categories-carousel post-carousel">
				<?php
					if ( ! empty( $newsmunch_featured_link_custom ) ) {
					$allowed_html = array(
					'br'     => array(),
					'em'     => array(),
					'strong' => array(),
					'span' => array(),
					'b'      => array(),
					'i'      => array(),
					);
					$newsmunch_featured_link_custom = json_decode( $newsmunch_featured_link_custom );
					foreach ( $newsmunch_featured_link_custom as $i=>$item ) {
						$title = ! empty( $item->title ) ? apply_filters( 'softme_translate_single_string', $item->title, 'Featured Link section' ) : '';
						$subtitle = ! empty( $item->subtitle ) ? apply_filters( 'softme_translate_single_string', $item->subtitle, 'Featured Link section' ) : '';
						$subtitle2 = ! empty( $item->subtitle2 ) ? apply_filters( 'softme_translate_single_string', $item->subtitle2, 'Featured Link section' ) : '';
						$link = ! empty( $item->link ) ? apply_filters( 'softme_translate_single_string', $item->link, 'Featured Link section' ) : '';
						$image = ! empty( $item->image_url ) ? apply_filters( 'softme_translate_single_string', $item->image_url, 'Featured Link section' ) : '';
						$color = ! empty( $item->color ) ? apply_filters( 'softme_translate_single_string', $item->color, 'Featured Link section' ) : '';
				?>
					<div class="post featured-post-md">
						<div class="details clearfix">
							<?php if ( ! empty( $title ) ) : ?>
								<h4 class="post-title"><a href="<?php echo esc_url($link); ?>"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></a></h4>
							<?php endif; ?>
							
							<?php if ( ! empty( $subtitle )  || ! empty( $subtitle2 )) : ?>
								<p class="post-number dt-mt-2"><?php echo wp_kses( html_entity_decode( $subtitle ), $allowed_html ); ?> &nbsp;<span class="dot small"></span> <?php echo wp_kses( html_entity_decode( $subtitle2 ), $allowed_html ); ?></p>
							<?php endif; ?>
						</div>
						<a href="<?php echo esc_url($link); ?>">
							<div class="thumb">
								<div class="overlay decoration-border"></div>
								<?php if ( $image ) : ?>
								<div class="inner data-bg-image" data-bg-image="<?php echo esc_url($image); ?>"></div>
								<?php else: ?>
								<div class="inner"></div>
								<?php endif; ?>
							</div>
						</a>
					</div>
				<?php } } ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>