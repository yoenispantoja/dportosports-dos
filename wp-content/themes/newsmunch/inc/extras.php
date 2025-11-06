<?php
/*=========================================
NewsMunch Main Slider
=========================================*/
if ( ! function_exists( 'newsmunch_site_slider_main' ) ) :
function newsmunch_site_slider_main() {
	$newsmunch_slider_position		= get_theme_mod('newsmunch_slider_position','left') == 'left' ? '': 'dt-flex-row-reverse'; 
	$newsmunch_slider_ttl			= get_theme_mod('newsmunch_slider_ttl','Main Story');
	$newsmunch_slider_cat			= get_theme_mod('newsmunch_slider_cat','0');
	$newsmunch_num_slides			= get_theme_mod('newsmunch_num_slides','6');
	$newsmunch_slider_posts			= newsmunch_get_posts($newsmunch_num_slides, $newsmunch_slider_cat);
	$newsmunch_hs_slider_title		= get_theme_mod('newsmunch_hs_slider_title','1');
	$newsmunch_hs_slider_cat_meta	= get_theme_mod('newsmunch_hs_slider_cat_meta','1');
	$newsmunch_hs_slider_auth_meta	= get_theme_mod('newsmunch_hs_slider_auth_meta','1');
	$newsmunch_hs_slider_date_meta	= get_theme_mod('newsmunch_hs_slider_date_meta','1');
	$newsmunch_hs_slider_comment_meta= get_theme_mod('newsmunch_hs_slider_comment_meta','1');
	$newsmunch_hs_slider_views_meta	= get_theme_mod('newsmunch_hs_slider_views_meta','1');
	if(!empty($newsmunch_slider_ttl)):
	 ?>
		<div class="widget-header sl-main">
			<h4 class="widget-title"><?php echo wp_kses_post($newsmunch_slider_ttl); ?></h4>
		</div>
	<?php endif; ?>
	<div class="post-carousel-banner">
		<?php
			if ($newsmunch_slider_posts->have_posts()) :
			while ($newsmunch_slider_posts->have_posts()) : $newsmunch_slider_posts->the_post();

			global $post;
			$format = get_post_format() ? : 'standard';	
		?>
			<div class="post featured-post-lg">
				<div class="details clearfix">
					<?php if($newsmunch_hs_slider_cat_meta=='1'): newsmunch_getpost_categories();  endif; ?>
					<?php if($newsmunch_hs_slider_title=='1'): newsmunch_common_post_title('h2','post-title'); endif; ?> 
					<ul class="meta list-inline dt-mt-0 dt-mb-0 dt-mt-3">
						<?php if($newsmunch_hs_slider_auth_meta=='1'): ?>
							<li class="list-inline-item"><i class="far fa-user-circle"></i> <?php esc_html_e('By','newsmunch');?> <a href="<?php echo esc_url(get_author_posts_url( absint(get_the_author_meta( 'ID' )) ));?>"><?php echo esc_html(get_the_author()); ?></a></li>
						<?php endif; ?>	
						
						<?php if($newsmunch_hs_slider_date_meta=='1'): ?>
							<li class="list-inline-item"><i class="far fa-calendar-alt"></i> <?php echo esc_html(get_the_date( 'F j, Y' )); ?></li>
						<?php endif; ?>	
						
						<?php if($newsmunch_hs_slider_comment_meta=='1'): ?>
							<li class="list-inline-item"><i class="far fa-comments"></i> <?php echo esc_html(get_comments_number($post->ID)); ?></li>
						<?php endif; ?>	
						
						<?php if($newsmunch_hs_slider_views_meta=='1'): ?>
							<li class="list-inline-item"><i class="far fa-eye"></i> <?php echo wp_kses_post(newsmunch_get_post_view()); ?></li>
						<?php endif; newsmunch_edit_post_link(); ?>
					</ul>
				</div>
				<div class="thumb">
					<?php if ( $format !== 'standard'): ?>
						<span class="post-format-sm">
							<?php do_action('newsmunch_post_format_icon_type'); ?>
						</span>
					<?php endif; ?>
					<a href="<?php echo esc_url(get_permalink()); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="inner data-bg-image" data-bg-image="<?php echo esc_url(get_the_post_thumbnail_url()); ?>"></div>
						<?php else: ?>
							<div class="inner"></div>
						<?php endif; ?>
					</a>
				</div>
			</div>
		<?php endwhile;endif;wp_reset_postdata(); ?>
	</div>
	<?php
	} 
endif;
add_action( 'newsmunch_site_slider_main', 'newsmunch_site_slider_main' );



/*=========================================
NewsMunch Slider Middle
=========================================*/
if ( ! function_exists( 'newsmunch_site_slider_middle' ) ) :
function newsmunch_site_slider_middle() {
	$newsmunch_slider_mdl_ttl			= get_theme_mod('newsmunch_slider_mdl_ttl','Today Post');
	$newsmunch_slider_mdl_cat			= get_theme_mod('newsmunch_slider_mdl_cat','0');
	$newsmunch_num_slides_mdl_tab		= get_theme_mod('newsmunch_num_slides_mdl_tab','2');
	$newsmunch_posts					= newsmunch_get_posts($newsmunch_num_slides_mdl_tab, $newsmunch_slider_mdl_cat);
	$newsmunch_hs_slider_mdl_title		= get_theme_mod('newsmunch_hs_slider_mdl_title','1');
	$newsmunch_hs_slider_mdl_cat_meta	= get_theme_mod('newsmunch_hs_slider_mdl_cat_meta','1');
	$newsmunch_hs_slider_mdl_auth_meta	= get_theme_mod('newsmunch_hs_slider_mdl_auth_meta','1');
	$newsmunch_hs_slider_mdl_date_meta	= get_theme_mod('newsmunch_hs_slider_mdl_date_meta','1');
	$newsmunch_hs_slider_mdl_comment_meta= get_theme_mod('newsmunch_hs_slider_mdl_comment_meta','1');
	$newsmunch_hs_slider_mdl_views_meta	= get_theme_mod('newsmunch_hs_slider_mdl_views_meta','1');
	if(!empty($newsmunch_slider_mdl_ttl)):
	 ?>
		<div class="widget-header sl-mid">
			<h4 class="widget-title"><?php echo wp_kses_post($newsmunch_slider_mdl_ttl); ?></h4>
		</div>
	<?php endif; ?>
	<div class="post_columns-grid">
		<?php
			if ($newsmunch_posts->have_posts()) :
			while ($newsmunch_posts->have_posts()) : $newsmunch_posts->the_post();

			global $post;
			$format = get_post_format() ? : 'standard';	
		?>
			<div class="post featured-post-lg">
				<div class="details clearfix">
					<?php if($newsmunch_hs_slider_mdl_cat_meta=='1'): newsmunch_getpost_categories();  endif; ?>
					<?php if($newsmunch_hs_slider_mdl_title=='1'): newsmunch_common_post_title('h2','post-title'); endif; ?> 
					<ul class="meta list-inline dt-mt-0 dt-mb-0 dt-mt-3">
						<?php if($newsmunch_hs_slider_mdl_auth_meta=='1'): ?>
							<li class="list-inline-item"><i class="far fa-user-circle"></i> <?php esc_html_e('By','newsmunch');?> <a href="<?php echo esc_url(get_author_posts_url( absint(get_the_author_meta( 'ID' )) ));?>"><?php echo esc_html(get_the_author()); ?></a></li>
						<?php endif; ?>	
						
						<?php if($newsmunch_hs_slider_mdl_date_meta=='1'): ?>
							<li class="list-inline-item"><i class="far fa-calendar-alt"></i> <?php echo esc_html(get_the_date( 'F j, Y' )); ?></li>
						<?php endif; ?>	
						
						<?php if($newsmunch_hs_slider_mdl_comment_meta=='1'): ?>
							<li class="list-inline-item"><i class="far fa-comments"></i> <?php echo esc_html(get_comments_number($post->ID)); ?></li>
						<?php endif; ?>	
						
						<?php if($newsmunch_hs_slider_mdl_views_meta=='1'): ?>
							<li class="list-inline-item"><i class="far fa-eye"></i> <?php echo wp_kses_post(newsmunch_get_post_view()); ?></li>
						<?php endif; newsmunch_edit_post_link(); ?>
					</ul>
				</div>
				<div class="thumb">
					<?php if ( $format !== 'standard' ): ?>
						<span class="post-format-sm">
							<?php do_action('newsmunch_post_format_icon_type'); ?>
						</span>
					<?php endif; ?>
					<a href="<?php echo esc_url(get_permalink()); ?>">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="inner data-bg-image" data-bg-image="<?php echo esc_url(get_the_post_thumbnail_url()); ?>"></div>
						<?php else: ?>
							<div class="inner"></div>
						<?php endif; ?>
					</a>
				</div>
			</div>
		<?php endwhile;endif;wp_reset_postdata(); ?>
	</div>
	<?php
	} 
endif;
add_action( 'newsmunch_site_slider_middle', 'newsmunch_site_slider_middle' );

/*=========================================
NewsMunch Slider Right
=========================================*/
if ( ! function_exists( 'newsmunch_site_slider_right' ) ) :
function newsmunch_site_slider_right() {
	$newsmunch_slider_right_type	= get_theme_mod('newsmunch_slider_right_type','style-1');
	$newsmunch_slider_right_ttl		= get_theme_mod('newsmunch_slider_right_ttl','Today Update');
	$newsmunch_tabfirst_cat			= get_theme_mod('newsmunch_tabfirst_cat','0');
	$newsmunch_tabsecond_cat		= get_theme_mod('newsmunch_tabsecond_cat','0');
	$newsmunch_tabthird_cat			= get_theme_mod('newsmunch_tabthird_cat','0');
	$newsmunch_hs_slider_tab_meta	= get_theme_mod('newsmunch_hs_slider_tab_meta','1');
	$newsmunch_hs_slider_tab_title	= get_theme_mod('newsmunch_hs_slider_tab_title','1');
	$newsmunch_hs_slider_tab_cat_meta= get_theme_mod('newsmunch_hs_slider_tab_cat_meta','1');
	$newsmunch_hs_slider_tab_date_meta= get_theme_mod('newsmunch_hs_slider_tab_date_meta','1');
	$newsmunch_num_slides_tab		= get_theme_mod('newsmunch_num_slides_tab','3');
	$newsmunch_slider_tab1_posts		= newsmunch_get_posts($newsmunch_num_slides_tab, $newsmunch_tabfirst_cat);
	$newsmunch_slider_tab2_posts		= newsmunch_get_posts($newsmunch_num_slides_tab, $newsmunch_tabsecond_cat);	
	$newsmunch_slider_tab3_posts		= newsmunch_get_posts($newsmunch_num_slides_tab, $newsmunch_tabthird_cat);		
if(!empty($newsmunch_slider_right_ttl)):
 ?>
	<div class="widget-header sl-right">
		<h4 class="widget-title"><?php echo wp_kses_post($newsmunch_slider_right_ttl); ?></h4>
	</div>
<?php endif; ?>
<div class="dt_tabs post-tabs">
	<ul class="dt_tabslist" id="postsTab" role="tablist">
		<?php 
			$newsmunch_tabfirst_cat = (int) $newsmunch_tabfirst_cat;
			$newsmunch_tabsecond_cat = (int) $newsmunch_tabsecond_cat;
			$newsmunch_tabthird_cat = (int) $newsmunch_tabthird_cat;
			
			if(!empty($newsmunch_tabfirst_cat) && !empty($newsmunch_tabsecond_cat) && !empty($newsmunch_tabthird_cat)):
				$catFirst = str_replace(" ","-", strtolower(get_cat_name( $newsmunch_tabfirst_cat )));
				$catSecond = str_replace(" ","-", strtolower(get_cat_name( $newsmunch_tabsecond_cat )));	
				$catThird = str_replace(" ","-", strtolower(get_cat_name( $newsmunch_tabthird_cat )));	
			else:
				$catFirst = esc_html('popular','newsmunch');
				$catSecond = esc_html('trending','newsmunch');
				$catThird = esc_html('recent','newsmunch');
			endif;			
		?>
		
		<?php if(!empty($newsmunch_tabfirst_cat)):?>
			<li role="presentation"><button aria-controls='<?php echo esc_attr($catFirst); ?>' aria-selected="true" class="nav-link active" data-tab="<?php echo esc_attr($catFirst); ?>" role="tab" type="button"><i class="fas fa-bolt" aria-hidden="true"></i><?php echo esc_html(get_cat_name( $newsmunch_tabfirst_cat )); ?></button></li>
		<?php else: ?>
			<li role="presentation"><button aria-controls='<?php echo esc_attr($catFirst); ?>' aria-selected="true" class="nav-link active" data-tab="<?php echo esc_attr($catFirst); ?>" role="tab" type="button"><i class="fas fa-bolt" aria-hidden="true"></i><?php esc_html_e('Popular','newsmunch'); ?></button></li>
		<?php endif; ?>	
		
		<?php if(!empty($newsmunch_tabsecond_cat)):?>
			<li role="presentation"><button aria-controls="<?php echo esc_attr($catSecond); ?>" aria-selected="false" class="nav-link" data-tab="<?php echo esc_attr($catSecond); ?>" role="tab" type="button"><i class="fas fa-fire-alt" aria-hidden="true"></i><?php echo esc_html(get_cat_name( $newsmunch_tabsecond_cat )); ?></button></li>
		<?php else: ?>
			<li role="presentation"><button aria-controls='<?php echo esc_attr($catSecond); ?>' aria-selected="false" class="nav-link" data-tab="<?php echo esc_attr($catSecond); ?>" role="tab" type="button"><i class="fas fa-fire-alt" aria-hidden="true"></i><?php esc_html_e('Trending','newsmunch'); ?></button></li>
		<?php endif; ?>	
		
		<?php if(!empty($newsmunch_tabthird_cat)):?>
			<li role="presentation"><button aria-controls="<?php echo esc_attr($catThird); ?>" aria-selected="false" class="nav-link" data-tab="<?php echo esc_attr($catThird); ?>" role="tab" type="button"><i class="fas fa-clock" aria-hidden="true"></i><?php echo esc_html(get_cat_name( $newsmunch_tabthird_cat )); ?></button></li>
		<?php else: ?>
			<li role="presentation"><button aria-controls='<?php echo esc_attr($catThird); ?>' aria-selected="false" class="nav-link" data-tab="<?php echo esc_attr($catThird); ?>" role="tab" type="button"><i class="fas fa-clock" aria-hidden="true"></i><?php esc_html_e('Recent','newsmunch'); ?></button></li>
		<?php endif; ?>		
	</ul>
	<div class="tab-content" id="postsTabContent">
		<div class="lds-dual-ring"></div>
		<div aria-labelledby="<?php echo esc_attr($catFirst); ?>-tab" class="tab-pane fade active show" id="<?php echo esc_attr($catFirst); ?>" role="tabpanel">
			<?php
			if ($newsmunch_slider_tab1_posts->have_posts()) :
				while ($newsmunch_slider_tab1_posts->have_posts()) : $newsmunch_slider_tab1_posts->the_post();

				global $post;
			?>
				<div class="post post-list-sm square bg-white shadow dt-p-2">
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="thumb">
							<a href="<?php echo esc_url(get_permalink()); ?>">
								<div class="inner"><img width="60" height="60" src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" class="wp-post-image" alt="<?php echo esc_attr(the_title()); ?>" /></div>
							</a>
						</div>
					<?php } ?>
					<div class="details clearfix">
						<?php if($newsmunch_hs_slider_tab_cat_meta=='1'): newsmunch_getpost_categories(); endif; ?>	
						<?php if($newsmunch_hs_slider_tab_title=='1'):	newsmunch_common_post_title('h6','post-title dt-my-1'); endif; ?> 
						<?php if($newsmunch_hs_slider_tab_date_meta=='1'): ?>	
							<ul class="meta list-inline dt-mt-1 dt-mb-0">
								<?php do_action('newsmunch_common_post_date'); ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile;endif;wp_reset_postdata(); ?>
		</div>
		<div aria-labelledby="<?php echo esc_attr($catSecond); ?>-tab" class="tab-pane fade" id="<?php echo esc_attr($catSecond); ?>" role="tabpanel">
			<?php
			if ($newsmunch_slider_tab2_posts->have_posts()) :
				while ($newsmunch_slider_tab2_posts->have_posts()) : $newsmunch_slider_tab2_posts->the_post();

				global $post;
			?>
				<div class="post post-list-sm square bg-white shadow dt-p-2">
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="thumb">
							<a href="<?php echo esc_url(get_permalink()); ?>">
								<div class="inner"><img width="60" height="60" src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" class="wp-post-image" alt="<?php echo esc_attr(the_title()); ?>" /></div>
							</a>
						</div>
					<?php } ?>
					<div class="details clearfix">
						<?php if($newsmunch_hs_slider_tab_cat_meta=='1'): newsmunch_getpost_categories(); endif; ?>	
						<?php if($newsmunch_hs_slider_tab_title=='1'):	newsmunch_common_post_title('h6','post-title dt-my-1'); endif; ?> 
						<?php if($newsmunch_hs_slider_tab_date_meta=='1'): ?>	
							<ul class="meta list-inline dt-mt-1 dt-mb-0">
								<?php do_action('newsmunch_common_post_date'); ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile;endif;wp_reset_postdata(); ?>
		</div>
		<div aria-labelledby="<?php echo esc_attr($catThird); ?>-tab" class="tab-pane fade" id="<?php echo esc_attr($catThird); ?>" role="tabpanel">
			<?php
			if ($newsmunch_slider_tab3_posts->have_posts()) :
				while ($newsmunch_slider_tab3_posts->have_posts()) : $newsmunch_slider_tab3_posts->the_post();

				global $post;
			?>
				<div class="post post-list-sm square bg-white shadow dt-p-2">
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="thumb">
							<a href="<?php echo esc_url(get_permalink()); ?>">
								<div class="inner"><img width="60" height="60" src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" class="wp-post-image" alt="<?php echo esc_attr(the_title()); ?>" /></div>
							</a>
						</div>
					<?php } ?>
					<div class="details clearfix">
						<?php if($newsmunch_hs_slider_tab_cat_meta=='1'): newsmunch_getpost_categories(); endif; ?>	
						<?php if($newsmunch_hs_slider_tab_title=='1'):	newsmunch_common_post_title('h6','post-title dt-my-1'); endif; ?> 
						<?php if($newsmunch_hs_slider_tab_date_meta=='1'): ?>	
							<ul class="meta list-inline dt-mt-1 dt-mb-0">
								<?php do_action('newsmunch_common_post_date'); ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile;endif;wp_reset_postdata(); ?>
		</div>
	</div>
</div>
	<?php
	} 
endif;
add_action( 'newsmunch_site_slider_right', 'newsmunch_site_slider_right' );

/*=========================================
NewsMunch Slider
=========================================*/
if ( ! function_exists( 'newsmunch_site_slider' ) ) :
function newsmunch_site_slider() {
	 if (is_front_page() || is_home()) {
		$newsmunch_display_slider 	= get_theme_mod( 'newsmunch_display_slider', 'front_post');
		$newsmunch_hs_slider 		= get_theme_mod( 'newsmunch_hs_slider', '1');
		if($newsmunch_hs_slider=='1'):
			if (is_home() && ($newsmunch_display_slider=='post' || $newsmunch_display_slider=='front_post')):
				get_template_part('template-parts/section','slider');
			elseif (is_front_page() && ($newsmunch_display_slider=='front' || $newsmunch_display_slider=='front_post')):
				get_template_part('template-parts/section','slider');
			endif;
		endif;
	 }
	} 
endif;
add_action( 'newsmunch_site_front_main', 'newsmunch_site_slider' );


/*=========================================
NewsMunch Featured Link
=========================================*/
if ( ! function_exists( 'newsmunch_site_featured_link' ) ) :
function newsmunch_site_featured_link() {
	 if (is_front_page() || is_home()) {
		$newsmunch_display_featured_link = get_theme_mod( 'newsmunch_display_featured_link', 'front_post');
		$newsmunch_hs_featured_link 	 = get_theme_mod( 'newsmunch_hs_featured_link', '1');
		if($newsmunch_hs_featured_link=='1'):
			if (is_home() && ($newsmunch_display_featured_link=='post' || $newsmunch_display_featured_link=='front_post')):
				get_template_part('template-parts/section','featured-link'); 
			elseif (is_front_page() && ($newsmunch_display_featured_link=='front' || $newsmunch_display_featured_link=='front_post')):
				get_template_part('template-parts/section','featured-link'); 
			endif;
		endif;
	 }
	} 
endif;
add_action( 'newsmunch_site_front_main2', 'newsmunch_site_featured_link' );

/*=========================================
NewsMunch Footer Widget
=========================================*/
if ( ! function_exists( 'newsmunch_footer_widget' ) ) :
function newsmunch_footer_widget() {
	$newsmunch_footer_widget_column	= get_theme_mod('newsmunch_footer_widget_column','4'); 
		if ($newsmunch_footer_widget_column == '4') {
				$column = '3';
			} 
	if($newsmunch_footer_widget_column !==''): 
	?>
	<div class="dt_footer-widgets">
		<div class="dt-row dt-g-lg-5 dt-g-5">
			<?php if ( is_active_sidebar( 'newsmunch-footer-widget-1' ) ) : ?>
				<div class="dt-col-lg-<?php echo esc_attr($column); ?> dt-col-sm-6 dt-col-12">
					<?php dynamic_sidebar( 'newsmunch-footer-widget-1'); ?>
				</div>
			<?php endif; ?>
			
			<?php if ( is_active_sidebar( 'newsmunch-footer-widget-2' ) ) : ?>
				<div class="dt-col-lg-<?php echo esc_attr($column); ?> dt-col-sm-6 dt-col-12">
					<?php dynamic_sidebar( 'newsmunch-footer-widget-2'); ?>
				</div>
			<?php endif; ?>
			
			<?php if ( is_active_sidebar( 'newsmunch-footer-widget-3' ) ) : ?>
				<div class="dt-col-lg-<?php echo esc_attr($column); ?> dt-col-sm-6 dt-col-12">
					<?php dynamic_sidebar( 'newsmunch-footer-widget-3'); ?>
				</div>
			<?php endif; ?>
			
			<?php if ( is_active_sidebar( 'newsmunch-footer-widget-4' ) ) : ?>
				<div class="dt-col-lg-<?php echo esc_attr($column); ?> dt-col-sm-6 dt-col-12">
					<?php dynamic_sidebar( 'newsmunch-footer-widget-4'); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php 
	endif; } 
endif;
add_action( 'newsmunch_footer_widget', 'newsmunch_footer_widget' );


/*=========================================
NewsMunch Footer Bottom
=========================================*/
if ( ! function_exists( 'newsmunch_footer_bottom' ) ) :
function newsmunch_footer_bottom() {
	?>
	<div class="dt_footer-inner">
		<div class="dt-row dt-align-items-center dt-gy-4">
			<div class="dt-col-md-6 dt-text-md-left dt-text-center">
				<?php do_action('newsmunch_footer_copyright_data'); ?>
			</div>
			<div class="dt-col-md-6 dt-text-md-right dt-text-center">
				<?php do_action('newsmunch_footer_copyright_social'); ?>
			</div>
		</div>
	</div>
	<?php
	} 
endif;
add_action( 'newsmunch_footer_bottom', 'newsmunch_footer_bottom' );

/*=========================================
NewsMunch Footer Copyright
=========================================*/
if ( ! function_exists( 'newsmunch_footer_copyright_data' ) ) :
function newsmunch_footer_copyright_data() {
	$newsmunch_footer_copyright_text = get_theme_mod('newsmunch_footer_copyright_text','Copyright &copy; [current_year] [site_title] | Powered by [theme_author]');
	?>
	<?php if(!empty($newsmunch_footer_copyright_text)): 
			$newsmunch_copyright_allowed_tags = array(
				'[current_year]' => date_i18n('Y'),
				'[site_title]'   => get_bloginfo('name'),
				'[theme_author]' => sprintf(__('<a href="#">Desert Themes</a>', 'newsmunch')),
			);
	?>
		 <span class="copyright">
			<?php
				echo apply_filters('newsmunch_footer_copyright', wp_kses_post(newsmunch_str_replace_assoc($newsmunch_copyright_allowed_tags, $newsmunch_footer_copyright_text)));
			?>
         </span>
<?php endif;
	} 
endif;
add_action( 'newsmunch_footer_copyright_data', 'newsmunch_footer_copyright_data' );


/*=========================================
NewsMunch Footer Copyright Social
=========================================*/
if ( ! function_exists( 'newsmunch_footer_copyright_social' ) ) :
function newsmunch_footer_copyright_social() {
	$newsmunch_footer_copyright_social_hs 	= get_theme_mod( 'newsmunch_footer_copyright_social_hs','1'); 
	$newsmunch_footer_copyright_social 		= get_theme_mod( 'newsmunch_footer_copyright_social',newsmunch_get_social_icon_default());
	if($newsmunch_footer_copyright_social_hs=='1'): ?>
		<div class="widget widget_social">
			<?php
				$newsmunch_footer_copyright_social = json_decode($newsmunch_footer_copyright_social);
				if( $newsmunch_footer_copyright_social!='' )
				{
				foreach($newsmunch_footer_copyright_social as $item){	
				$social_icon = ! empty( $item->icon_value ) ? apply_filters( 'newsmunch_translate_single_string', $item->icon_value, 'Footer Social' ) : '';	
				$social_link = ! empty( $item->link ) ? apply_filters( 'newsmunch_translate_single_string', $item->link, 'Footer Social' ) : '';
			?>
				<a href="<?php echo esc_url( $social_link ); ?>"><i class="<?php echo esc_attr( $social_icon ); ?>"></i></a>
			<?php }} ?>
		</div>
	<?php endif;
	} 
endif;
add_action( 'newsmunch_footer_copyright_social', 'newsmunch_footer_copyright_social' );

function newsmunch_get_post_view() {
    $count = get_post_meta( get_the_ID(), 'post_views_count', true );
	if(!empty($count)):
		return "$count views";
	else:
		return "0 views";
	endif;	
}
function newsmunch_set_post_view() {
    $key = 'post_views_count';
    $post_id = get_the_ID();
    $count = (int) get_post_meta( $post_id, $key, true );
    $count++;
    update_post_meta( $post_id, $key, $count );
}
function newsmunch_posts_column_views( $columns ) {
    $columns['post_views'] = 'Views';
    return $columns;
}
function newsmunch_posts_custom_column_views( $column ) {
    if ( $column === 'post_views') {
        echo newsmunch_get_post_view();
    }
}
add_filter( 'manage_posts_columns', 'newsmunch_posts_column_views' );
add_action( 'manage_posts_custom_column', 'newsmunch_posts_custom_column_views' );




if (!function_exists('newsmunch_get_post_categories')) :
    function newsmunch_getpost_categories($separator = '&nbsp',$class = '')
    {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {

            global $post;
            ?>

            <div class="category-badge <?php echo esc_attr($class); ?>">

            <?php $post_categories = get_the_category($post->ID);
            if ($post_categories) {
                $output = '';
                foreach ($post_categories as $post_category) {
					$t_id = $post_category->term_id;
                    $color_id = "category_color_" . $t_id;

                    // retrieve the existing value(s) for this meta field. This returns an array
                    $term_meta = get_option($color_id);
					$color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'color-1';
					if($color_class=='color-2'):
						$color='#ffae25';
					elseif($color_class=='color-3'):
						$color='#52a815';
					elseif($color_class=='color-4'):
						$color='#007bff';
					else:
						$color='#00baff';
					endif;
                    $output .= '<a href="' . esc_url(get_category_link($post_category)) . '" alt="' . esc_attr(sprintf(__('View all posts in %s', 'newsmunch'), $post_category->name)) . '"> 
                                 ' . esc_html($post_category->name) . '
                             </a>';
                }
                $output .= '';
                echo $output;

            }
            ?>

        	</div>
			
        <?php }
    }
endif;

/**
 * NewsMunch Post Title
 */
if (!function_exists('newsmunch_common_post_title')):
    function newsmunch_common_post_title($tag,$class)
    {
        if ( is_single() ) :
							
		the_title('<'.$tag.' class="'.$class.'">', '</'.$tag.'>' );
		
		else:
		
		the_title( sprintf( '<'.$tag.' class="'.$class.'"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></'.$tag.'>' );
		
		endif;
    }
add_action('newsmunch_common_post_title','newsmunch_common_post_title');	
endif;

/**
 * NewsMunch Post Author
 */
if (!function_exists('newsmunch_common_post_author')):
    function newsmunch_common_post_author()
    { ?>
		<li class="list-inline-item"><a href="<?php echo esc_url(get_author_posts_url( absint(get_the_author_meta( 'ID' )) ));?>"><img src="<?php echo esc_url( get_avatar_url( absint(get_the_author_meta( 'ID' )) ) ); ?>" width="32" height="32" class="author" alt="<?php echo esc_attr(get_the_author()); ?>"/><?php echo esc_html(get_the_author()); ?></a></li>
   <?php }
add_action('newsmunch_common_post_author','newsmunch_common_post_author');	
endif;


/**
 * NewsMunch Post Date
 */
if (!function_exists('newsmunch_common_post_date')):
    function newsmunch_common_post_date()
    {
	?>
		<li class="list-inline-item"><i class="far fa-calendar-alt"></i> <?php echo esc_html(get_the_date( 'F j, Y' )); ?></li>
   <?php }
add_action('newsmunch_common_post_date','newsmunch_common_post_date');	
endif;


/**
 * NewsMunch post-format select type of icons
 */
if (!function_exists('newsmunch_post_format_icon_type')):
    function newsmunch_post_format_icon_type()
    {
        $format = get_post_format() ? : 'standard';

        if ( $format == 'aside' ) : ?>
			<i class="far fa-file-text"></i>
		<?php elseif ( $format == 'gallery' ) : ?>
			<i class="far fa-images"></i>
		<?php elseif ( $format == 'link' ) : ?>
			<i class="fas fa-link"></i>
		<?php elseif ( $format == 'image' ) : ?>
			<i class="far fa-image"></i>
		<?php elseif ( $format == 'quote' ) : ?>
			<i class="fas fa-quote-left"></i>
		<?php elseif ( $format == 'video' ) : ?>
			<i class="fas fa-video"></i>
		<?php elseif ( $format == 'audio' ) : ?>
				<i class="fas fa-headphones-simple"></i>
		<?php elseif ( $format == 'status' ) : ?>
			<i class="fab fa-rocketchat"></i>
		<?php elseif ( $format == 'chat' ) : ?>
			<i class="far fa-comment"></i>
		<?php endif;
    }
add_action('newsmunch_post_format_icon_type','newsmunch_post_format_icon_type');	
endif;


/**
 * NewsMunch post-format Image Video
 */
if (!function_exists('newsmunch_post_format_image_video')):
    function newsmunch_post_format_image_video()
    {
        $format = get_post_format() ? : 'standard';
		global $post;
		
        if ( $format == 'video' || $format == 'audio' ) : 
			$media = get_media_embedded_in_content( 
						apply_filters( 'the_content', get_the_content() )
					);
					
			if(!empty($media)): ?>
				<div class="inner">
					<?php echo $media['0']; ?>
				</div>
			<?php endif;	
			
		 elseif ( $format == 'gallery' ) :
			
			global $post;				
				$gallery = get_post_gallery( $post, false );
				if( ! empty($gallery) && has_block('gallery', $post->post_content)){ //if gallery was found
				  //strangely, IDs are served as a STRING (at least in WP 4.5)
				  if( !is_array($gallery['ids']) ) $gallery['ids'] = explode(',', $gallery['ids']); ?>
				  <div class="post-gallery">
					 <?php  foreach( $gallery['ids'] as $order => &$image_attachment_id ){ ?>
						<div class="item"><img width="1600" height="1067" src="<?php echo wp_get_attachment_image_src($image_attachment_id, 'full')[0]; ?>" class="attachment-full size-full" alt="" /></div>
					 <?php  } ?>			  
				  </div>
			<?php } 
			// if there is not a gallery block do this
			else { ?>
				<a href="<?php echo esc_url(get_permalink()); ?>">
					<div class="inner">
						<?php the_post_thumbnail(); ?>
					</div>
				</a>
		<?php }
	
				
		 else: ?>
				<a href="<?php echo esc_url(get_permalink()); ?>">
					<div class="inner">
						<?php the_post_thumbnail(); ?>
					</div>
				</a>
		<?php endif;
    }
endif;
add_action( 'newsmunch_post_format_image_video', 'newsmunch_post_format_image_video' );



/**
 * NewsMunch post-format Image Video content
 */
if (!function_exists('newsmunch_post_format_content')):
    function newsmunch_post_format_content()
    {
        $format = get_post_format() ? : 'standard';

        if ( $format == 'video' || $format == 'audio' || $format == 'gallery' ) :
			the_excerpt();
			//echo"video";
		elseif ( $format == 'quote' ) :
			?>
			<blockquote><?php the_excerpt(); ?></blockquote>
		<?php
		elseif ( $format == 'link' ) :
			?>
			<div class="post-linking">
				<?php
					$post_link = get_the_permalink();
					if ( preg_match('/<a (.+?)>/', get_the_content(), $match) ) {
						$link = array();
						foreach ( wp_kses_hair($match[1], array('https','http')) as $attr) {
							$link[$attr['name']] = $attr['value'];
						}
						$post_link = $link['href'];
						echo '<a href="'.$post_link.'">'.$post_link.'</a>';
					}
				?>
			</div>
			<?php

		else : 
			
			$newsmunch_enable_post_excerpt= get_theme_mod('newsmunch_enable_post_excerpt','1');
			if($newsmunch_enable_post_excerpt == '1'):
				global $post;
				the_excerpt();
				if ( function_exists( 'newsmunch_execerpt_btn' ) ) : newsmunch_execerpt_btn(); endif; 
			else:	
				the_content(
					sprintf( 
						__( 'Read More', 'newsmunch' ), 
						'<span class="screen-reader-text">  '.esc_html(get_the_title()).'</span>' 
					)
				);
			endif;		
			
		 endif;
    }
endif;
add_action( 'newsmunch_post_format_content', 'newsmunch_post_format_content' );



if ( ! function_exists( 'newsmunch_post_sharing' ) ) { 
	function newsmunch_post_sharing() {	
	
	global $post; ?>
	
	<div class="social-share dt-mr-auto">
		<button class="toggle-button fas fa-share-nodes"></button>
		<ul class="icons list-unstyled list-inline dt-mb-0">
			<?php $facebook_link = 'https://www.facebook.com/sharer/sharer.php?u='.esc_url( get_the_permalink() ); ?>
			<li class="list-inline-item"><a href="<?php echo esc_url ( $facebook_link ); ?>"><i class="fab fa-facebook-f"></i></a></li>
			
			<?php $twitter_link = 'https://twitter.com/intent/tweet?url='. esc_url( get_the_permalink() ); ?>
			<li class="list-inline-item"><a href="<?php echo esc_url ( $twitter_link ); ?>"><i class="fab fa-x-twitter"></i></a></li>
			
			<?php $linkedin_link = 'http://www.linkedin.com/shareArticle?url='.esc_url( get_the_permalink() ).'&amp;title='.get_the_title(); ?>
			<li class="list-inline-item"><a href="<?php echo esc_url( $linkedin_link ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
			
			<?php $pinterest_link = 'https://pinterest.com/pin/create/button/?url='.esc_url( get_the_permalink() ).'&amp;media='.esc_url( wp_get_attachment_url( get_post_thumbnail_id($post->ID)) ).'&amp;description='.get_the_title(); ?>
			<li class="list-inline-item"><a href="<?php echo esc_url( $pinterest_link ); ?>"><i class="fab fa-pinterest"></i></a></li>
			
			<?php $whatsapp_link = 'https://api.whatsapp.com/send?text=*'. get_the_title() .'*\n'. esc_html( get_the_excerpt() ) .'\n'. esc_url( get_the_permalink() ); ?>
			<li class="list-inline-item"><a href="<?php echo esc_url( $whatsapp_link ); ?>"><i class="fab fa-whatsapp"></i></a></li>
			
			<?php $tumblr_link = 'http://www.tumblr.com/share/link?url='. urlencode( esc_url(get_permalink()) ) .'&amp;name='.urlencode( get_the_title() ).'&amp;description='.urlencode( wp_trim_words( get_the_excerpt(), 50 ) ); ?>
			<li class="list-inline-item"><a href="<?php echo esc_url( $tumblr_link ); ?>"><i class="fab fa-tumblr"></i></a></li>
			
			<?php $reddit_link = 'http://reddit.com/submit?url='. esc_url( get_the_permalink() ) .'&amp;title='.get_the_title(); ?>
			<li class="list-inline-item"><a href="<?php echo esc_url( $reddit_link ); ?>"><i class="fab fa-reddit"></i></a></li>
		</ul>
	</div>	
	<?php
	}
}

/**
 * Top Tags
 */
function newsmunch_list_top_tags($taxonomy = 'post_tag', $number = 8)
{
	if (is_front_page() || is_home()) {
		$newsmunch_display_top_tags			= get_theme_mod( 'newsmunch_display_top_tags', 'front_post');
		if ((is_home() && ($newsmunch_display_top_tags=='post' || $newsmunch_display_top_tags=='front_post')) || (is_front_page() && ($newsmunch_display_top_tags=='front' || $newsmunch_display_top_tags=='front_post'))):
			$newsmunch_hs_top_tags 				= get_theme_mod('newsmunch_hs_top_tags','1');
			$newsmunch_hs_hlatest_story 		= get_theme_mod('newsmunch_hs_hlatest_story','1');
			$newsmunch_top_tags_ttl 			= get_theme_mod('newsmunch_top_tags_ttl','Top Tags');
			$newsmunch_hlatest_story_ttl 		= get_theme_mod('newsmunch_hlatest_story_ttl','Latest Story');
			$newsmunch_hlatest_story_cat		= get_theme_mod('newsmunch_hlatest_story_cat','0');
			$newsmunch_hlatest_story_posts		= newsmunch_get_posts($newsmunch_hlatest_story_cat);
			
				$top_tags = get_terms(array(
					'taxonomy' => $taxonomy,
					'number' => absint($number),
					'orderby' => 'count',
					'order' => 'DESC',
					'hide_empty' => true,
				));

				$html = '';

				//if (isset($top_tags) && !empty($top_tags)):
					$html .= '<section class="exclusive-wrapper clearfix"><div class="dt-container-md">';
					if($newsmunch_hs_top_tags == '1'){
						$html .= '<div class="exclusive-tags"><div class="exclusive-tags-inner clearfix">';
						if (!empty($newsmunch_top_tags_ttl)):
							$html .= '<h5 class="title">';
							$html .= esc_html($newsmunch_top_tags_ttl);
							$html .= '</h5>';
						endif;
						$html .= '<ul>';
						foreach ($top_tags as $tax_term):
							$html .= '<li>';
							$html .= '<a href="' . esc_url(get_term_link($tax_term)) . '">';
							$html .= $tax_term->name;
							$html .= '</a>';
							$html .= '</li>';
						endforeach;
						$html .= '</ul>';
						$html .= '</div></div>';
					}
					
					if($newsmunch_hs_hlatest_story == '1'){
						$html .= '<div class="exclusive-posts clearfix">';
						if (!empty($newsmunch_hlatest_story_ttl)):
							$html .= '<h5 class="title"><i class="fas fa-spinner fa-spin dt-mr-1"></i>';
							$html .= esc_html($newsmunch_hlatest_story_ttl);
							$html .= '</h5>';
						endif;
						$html .= ' <div class="exclusive-slides" dir="ltr"><div class="marquee flash-slide-left" data-speed="80000" data-gap="0" data-duplicated="true" data-direction="left">';
						if ($newsmunch_hlatest_story_posts->have_posts()) :
							while ($newsmunch_hlatest_story_posts->have_posts()) : $newsmunch_hlatest_story_posts->the_post();
							global $post;
							$html .= '<a href="' . esc_url(get_permalink()) . '">';
							if ( has_post_thumbnail() ) {
								$html .= '<img src="' . esc_url(get_the_post_thumbnail_url()) . '"/>';
							}
							$html .= esc_html(get_the_title());
							$html .= '</a>';	
						endwhile;endif;wp_reset_postdata();		
						$html .= '</div></div>';
						$html .= '</div>';
					}
					$html .= '</div></section>';
				//endif;
				echo $html;
			//}
		endif;	
	}
}


/**
 * NewsMunch Post Pagination
 */
if (!function_exists('newsmunch_post_pagination')):
    function newsmunch_post_pagination()
    {
        $newsmunch_post_pagination_type 	= get_theme_mod('newsmunch_post_pagination_type', 'default');
		if(  $newsmunch_post_pagination_type == 'next' ):
			 the_posts_navigation();
		else: 
			the_posts_pagination( array(
				'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
				'next_text'          => '<i class="fa fa-angle-double-right"></i>'
			) );
		endif;
    }
endif;
add_action( 'newsmunch_post_pagination', 'newsmunch_post_pagination' );



if (!function_exists('newsmunch_edit_post_link')) :

    function newsmunch_edit_post_link()
    {
        global $post;
            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'newsmunch'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-post-link"><i class="fas fa-edit dt-mr-1"></i>',
                '</span>'
            );

    } 
endif;


/**
 * Calculate reading time by content length
 *
 * @param string  $text Content to calculate
 * @return int Number of minutes
 */
if ( !function_exists( 'newsmunch_read_time' ) ):
	function newsmunch_read_time() {
		global $post;
		$content = get_post_field( 'post_content', $post->ID );
		$word_count = str_word_count( strip_tags( $content ) );
		$readingtime = ceil($word_count / 200);

		if ($readingtime == 1) {
		$timer = " minute Read";
		} else {
		$timer = " minutes Read";
		}
		$totalreadingtime = $readingtime . $timer;

		return $totalreadingtime;
	}
endif;



function newsmunch_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'newsmunch_page_menu_args' );
function newsmunch_fallback_page_menu( $args = array() ) {
	$defaults = array('sort_column' => 'menu_order, post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'wp_page_menu_args', $args );
	$menu = '';
	$list_args = $args;
	// Show Home in the menu
	if ( ! empty($args['show_home']) ) {
		if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
			$text = 'Home';
		else
			$text = $args['show_home'];
		$class = '';
		if ( is_front_page() && !is_paged() )
		{
		$class = 'class="nav-item menu-item active"';
		}
		else
		{
			$class = 'class="nav-item menu-item "';
		}
		$menu .= '<li ' . $class . '><a class="nav-link " href="' . esc_url(home_url( '/' )) . '" title="' . esc_attr($text) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
		// If the front page is a page, add it to the exclude list
		if (get_option('show_on_front') == 'page') {
			if ( !empty( $list_args['exclude'] ) ) {
				$list_args['exclude'] .= ',';
			} else {
				$list_args['exclude'] = '';
			}
			$list_args['exclude'] .= get_option('page_on_front');
		}
	}
	$list_args['echo'] = false;
	$list_args['title_li'] = '';
	$list_args['walker'] = new newsmunch_walker_page_menu;
	$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );
	if ( $menu )
		$menu = '<ul class="'. esc_attr($args['menu_class']) .'">' . $menu . '</ul>';

	$menu = $menu . "\n";
	$menu = apply_filters( 'wp_page_menu', $menu, $args );
	if ( $args['echo'] )
		echo $menu;
	else
		return $menu;
}
class newsmunch_walker_page_menu extends Walker_Page{
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<span class='dt_mobilenav-dropdown-toggle'><button type='button' class='fa fa-angle-right' aria-label='Mobile Dropdown Toggle'></button></span><ul class='dropdown-menu default'>\n";
	}
	function start_el( &$output, $page, $depth=0, $args = array(), $current_page = 0 )
	 {
		if ( $depth )
			$indent = str_repeat("\t", $depth);
		else
			$indent = '';

		if($depth === 0)
		{
			$child_class='nav-link';
		}
		else if($depth > 0)
		{
			$child_class='dropdown-item';
		}
		else
		{
			$child_class='';
		}
		extract($args, EXTR_SKIP);
		if($has_children){
			$css_class = array('menu-item page_item dropdown menu-item-has-children', 'page-item-'.$page->ID);
		}else{
			 $css_class = array('menu-item page_item dropdown', 'page-item-'.$page->ID);
		 }
		if ( !empty($current_page) ) {
			$_current_page = get_post( $current_page );
			if ( in_array( $page->ID, $_current_page->ancestors ) )
				$css_class[] = 'current_page_ancestor';
			if ( $page->ID == $current_page )
				$css_class[] = 'nav-item active';
			elseif ( $_current_page && $page->ID == $_current_page->post_parent )
				$css_class[] = 'current_page_parent';
		} elseif ( $page->ID == get_option('page_for_posts') ) {
			$css_class[] = 'current_page_parent';
		}
		$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );
		$output .= $indent . '<li class="nav-item ' . $css_class . '"><a class="' . $child_class . '" href="' . esc_url(get_permalink($page->ID)) . '">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</a>';
		if ( !empty($show_date) ) {
			if ( 'modified' == $show_date )
				$time = $page->post_modified;
			else
				$time = $page->post_date;
			$output .= " " . mysql2date($date_format, $time);
		}
	}
}



/*
 *
 * Social Icon
 */
function newsmunch_get_social_icon_default() {
	return apply_filters(
		'newsmunch_get_social_icon_default', json_encode(
				 array(
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-facebook-f', 'newsmunch' ),
					'link'	  =>  esc_html__( '#', 'newsmunch' ),
					'id'              => 'customizer_repeater_header_social_001',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-instagram', 'newsmunch' ),
					'link'	  =>  esc_html__( '#', 'newsmunch' ),
					'id'              => 'customizer_repeater_header_social_002',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-x-twitter', 'newsmunch' ),
					'link'	  =>  esc_html__( '#', 'newsmunch' ),
					'id'              => 'customizer_repeater_header_social_003',
				),
				array(
					'icon_value'	  =>  esc_html__( 'fab fa-youtube', 'newsmunch' ),
					'link'	  =>  esc_html__( '#', 'newsmunch' ),
					'id'              => 'customizer_repeater_header_social_005',
				)
			)
		)
	);
}

if ( ! function_exists( 'newsmunch_featured_link_option_before' ) ) { 
	function newsmunch_featured_link_option_before() {	
		$newsmunch_page	= get_theme_mod('newsmunch_featured_link_option_before');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page); 
			if($newsmunch_page_query->have_posts() ){ 
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					the_content();
				}
			} wp_reset_postdata(); 
		}
	}
	add_action('newsmunch_featured_link_option_before','newsmunch_featured_link_option_before');
}	


if ( ! function_exists( 'newsmunch_featured_link_option_after' ) ) { 
	function newsmunch_featured_link_option_after() {	
		$newsmunch_page	= get_theme_mod('newsmunch_featured_link_option_after');
		if( !empty($newsmunch_page)){
			$newsmunch_page_query = new wp_query('page_id='.$newsmunch_page); 
			if($newsmunch_page_query->have_posts() ){ 
			   while( $newsmunch_page_query->have_posts() ) { $newsmunch_page_query->the_post();
					the_content();
				}
			} wp_reset_postdata(); 
		}
	}
	add_action('newsmunch_featured_link_option_after','newsmunch_featured_link_option_after');
}	