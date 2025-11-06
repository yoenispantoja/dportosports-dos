<?php
/**
 * Theme functions and definitions
 *
 * @package NewsAlert
 */

/**
 * After setup theme hook
 */
function newsalert_theme_setup(){
    /*
     * Make child theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'newsalert' );	
}
add_action( 'after_setup_theme', 'newsalert_theme_setup' );

/**
 * Load assets.
 */

function newsalert_theme_css() {
	wp_enqueue_style( 'newsalert-parent-theme-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'newsalert_theme_css', 99);

/*=========================================
 NewsAlert Remove Customize Panel from parent theme
=========================================*/
function newsalert_remove_parent_setting( $wp_customize ) {
	$wp_customize->remove_control('newsmunch_tabthird_cat');
	$wp_customize->remove_control('newsmunch_hdr_banner');
	$wp_customize->remove_control('newsmunch_hs_hdr_banner');
	$wp_customize->remove_control('newsmunch_hdr_banner_img');
	$wp_customize->remove_control('newsmunch_hdr_banner_link');
	$wp_customize->remove_control('newsmunch_hdr_banner_target');
	$wp_customize->get_control('slider_options_head')->label = __( 'Slider Content Middle', 'newsalert' );
	$wp_customize->get_control('newsmunch_hs_slider_left')->label = __( 'Hide/Show Slider Middle?', 'newsalert' );
	$wp_customize->get_control('slider_mdl_options_head')->label = __( 'Slider Content Right', 'newsalert' );
	$wp_customize->get_control('newsmunch_hs_slider_mdl')->label = __( 'Hide/Show Slider Right?', 'newsalert' );
	$wp_customize->get_control('slider_right_options_head')->label = __( 'Slider Content Left', 'newsalert' );
	$wp_customize->get_control('newsmunch_hs_slider_right')->label = __( 'Hide/Show Slider Left?', 'newsalert' );
}
add_action( 'customize_register', 'newsalert_remove_parent_setting',99 );


/*=========================================
NewsAlert Slider Left
=========================================*/
if ( ! function_exists( 'newsalert_site_slider_right' ) ) :
function newsalert_site_slider_right() {
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
			
			if(!empty($newsmunch_tabfirst_cat) && !empty($newsmunch_tabsecond_cat) && !empty($newsmunch_tabthird_cat)):
				$catFirst = str_replace(" ","-", strtolower(get_cat_name( $newsmunch_tabfirst_cat )));
				$catSecond = str_replace(" ","-", strtolower(get_cat_name( $newsmunch_tabsecond_cat )));	
			else:
				$catFirst = esc_html('popular','newsalert');
				$catSecond = esc_html('trending','newsalert');
			endif;			
		?>
		
		<?php if(!empty($newsmunch_tabfirst_cat)):?>
			<li role="presentation"><button aria-controls='<?php echo esc_attr($catFirst); ?>' aria-selected="true" class="nav-link active" data-tab="<?php echo esc_attr($catFirst); ?>" role="tab" type="button"><i class="fas fa-bolt" aria-hidden="true"></i><?php echo esc_html(get_cat_name( $newsmunch_tabfirst_cat )); ?></button></li>
		<?php else: ?>
			<li role="presentation"><button aria-controls='<?php echo esc_attr($catFirst); ?>' aria-selected="true" class="nav-link active" data-tab="<?php echo esc_attr($catFirst); ?>" role="tab" type="button"><i class="fas fa-bolt" aria-hidden="true"></i><?php esc_html_e('Popular','newsalert'); ?></button></li>
		<?php endif; ?>	
		
		<?php if(!empty($newsmunch_tabsecond_cat)):?>
			<li role="presentation"><button aria-controls="<?php echo esc_attr($catSecond); ?>" aria-selected="false" class="nav-link" data-tab="<?php echo esc_attr($catSecond); ?>" role="tab" type="button"><i class="fas fa-fire-alt" aria-hidden="true"></i><?php echo esc_html(get_cat_name( $newsmunch_tabsecond_cat )); ?></button></li>
		<?php else: ?>
			<li role="presentation"><button aria-controls='<?php echo esc_attr($catSecond); ?>' aria-selected="false" class="nav-link" data-tab="<?php echo esc_attr($catSecond); ?>" role="tab" type="button"><i class="fas fa-fire-alt" aria-hidden="true"></i><?php esc_html_e('Trending','newsalert'); ?></button></li>
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
				<div class="post post-list-sm square">
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
				<div class="post post-list-sm square">
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
add_action( 'newsalert_site_slider_right', 'newsalert_site_slider_right' );

/**
 * Import Options From Parent Theme
 *
 */
function newsalert_parent_theme_options() {
	$newsmunch_mods = get_option( 'theme_mods_newsmunch' );
	if ( ! empty( $newsmunch_mods ) ) {
		foreach ( $newsmunch_mods as $newsmunch_mod_k => $newsmunch_mod_v ) {
			set_theme_mod( $newsmunch_mod_k, $newsmunch_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'newsalert_parent_theme_options' );