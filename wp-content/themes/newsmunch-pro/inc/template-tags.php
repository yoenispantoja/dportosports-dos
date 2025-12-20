<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package NewsMunch
 */

/**
 * Theme Page Header Title
*/
function newsmunch_theme_page_header_title(){
	if( is_archive() )
	{
		echo '<h1>';
		if ( is_day() ) :
		/* translators: %1$s %2$s: date */	
		  printf( esc_html__( '%1$s %2$s', 'newsmunch-pro' ), esc_html__('Archives','newsmunch-pro'), get_the_date() );  
        elseif ( is_month() ) :
		/* translators: %1$s %2$s: month */	
		  printf( esc_html__( '%1$s %2$s', 'newsmunch-pro' ), esc_html__('Archives','newsmunch-pro'), get_the_date( 'F Y' ) );
        elseif ( is_year() ) :
		/* translators: %1$s %2$s: year */	
		  printf( esc_html__( '%1$s %2$s', 'newsmunch-pro' ), esc_html__('Archives','newsmunch-pro'), get_the_date( 'Y' ) );
		elseif( is_author() ):
		/* translators: %1$s %2$s: author */	
			printf( esc_html__( '%1$s %2$s', 'newsmunch-pro' ), esc_html__('All posts by','newsmunch-pro'), get_the_author() );
        elseif( is_category() ):
		/* translators: %1$s %2$s: category */	
			printf( esc_html__( '%1$s %2$s', 'newsmunch-pro' ), esc_html__('Category','newsmunch-pro'), single_cat_title( '', false ) );
		elseif( is_tag() ):
		/* translators: %1$s %2$s: tag */	
			printf( esc_html__( '%1$s %2$s', 'newsmunch-pro' ), esc_html__('Tag','newsmunch-pro'), single_tag_title( '', false ) );
		elseif( class_exists( 'WooCommerce' ) && is_shop() ):
		/* translators: %1$s %2$s: WooCommerce */	
			printf( esc_html__( '%1$s %2$s', 'newsmunch-pro' ), esc_html__('Shop','newsmunch-pro'), single_tag_title( '', false ));
        elseif( is_archive() ): 
		the_archive_title( '<h1>', '</h1>' ); 
		endif;
		echo '</h1>';
	}
	elseif( is_404() )
	{
		echo '<h1>';
		/* translators: %1$s: 404 */	
		printf( esc_html__( '%1$s ', 'newsmunch-pro' ) , esc_html__('404','newsmunch-pro') );
		echo '</h1>';
	}
	elseif( is_search() )
	{
		echo '<h1>';
		/* translators: %1$s %2$s: search */
		printf( esc_html__( '%1$s %2$s', 'newsmunch-pro' ), esc_html__('Search results for','newsmunch-pro'), get_search_query() );
		echo '</h1>';
	}
	else
	{
		echo '<h1>'.esc_html( get_the_title() ).'</h1>';
	}
}


/**
 * Theme Breadcrumbs Url
*/
function newsmunch_page_url() {
	$page_url = 'http';
	if ( key_exists("HTTPS", $_SERVER) && ( $_SERVER["HTTPS"] == "on" ) ){
		$page_url .= "s";
	}
	$page_url .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$page_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$page_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $page_url;
}


/**
 * Theme Breadcrumbs
*/
if( !function_exists('newsmunch_page_header_breadcrumbs') ):
	function newsmunch_page_header_breadcrumbs() { 	
		global $post;
		$homeLink = home_url();
								
			if (is_home() || is_front_page()) :
				echo '<li class="breadcrumb-item"><a href="'.$homeLink.'">'.__('Home','newsmunch-pro').'</a></li>';
	            echo '<li class="breadcrumb-item active">'; echo single_post_title(); echo '</li>';
			else:
				echo '<li class="breadcrumb-item"><a href="'.$homeLink.'">'.__('Home','newsmunch-pro').'</a></li>';
				if ( is_category() ) {
				    echo '<li class="breadcrumb-item active"><a href="'. newsmunch_page_url() .'">' . __('Archive by category','newsmunch-pro').' "' . single_cat_title('', false) . '"</a></li>';
				} elseif ( is_day() ) {
					echo '<li class="breadcrumb-item active"><a href="'. get_year_link(get_the_time('Y')) . '">'. get_the_time('Y') .'</a>';
					echo '<li class="breadcrumb-item active"><a href="'. get_month_link(get_the_time('Y'),get_the_time('m')) .'">'. get_the_time('F') .'</a>';
					echo '<li class="breadcrumb-item active"><a href="'. newsmunch_page_url() .'">'. get_the_time('d') .'</a></li>';
				} elseif ( is_month() ) {
					echo '<li class="breadcrumb-item active"><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
					echo '<li class="breadcrumb-item active"><a href="'. newsmunch_page_url() .'">'. get_the_time('F') .'</a></li>';
				} elseif ( is_year() ) {
				    echo '<li class="breadcrumb-item active"><a href="'. newsmunch_page_url() .'">'. get_the_time('Y') .'</a></li>';
				} elseif ( is_single() && !is_attachment() && is_page('single-product') ) {					
				if ( get_post_type() != 'post' ) {
					$cat = get_the_category(); 
					$cat = $cat[0];
					echo '<li class="breadcrumb-item">';
					echo get_category_parents($cat, TRUE, '');
					echo '</li>';
					echo '<li class="breadcrumb-item active"><a href="' . newsmunch_page_url() . '">'. get_the_title() .'</a></li>';
				} }  
					elseif ( is_page() && $post->post_parent ) {
				    $parent_id  = $post->post_parent;
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						$breadcrumbs[] = '<li class="breadcrumb-item active"><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id  = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					foreach ($breadcrumbs as $crumb) echo $crumb;
					    echo '<li class="breadcrumb-item active"><a href="' . newsmunch_page_url() . '">'. get_the_title() .'</a></li>';
                    }
					elseif( is_search() )
					{
					    echo '<li class="breadcrumb-item active"><a href="' . newsmunch_page_url() . '">'. get_search_query() .'</a></li>';
					}
					elseif( is_404() )
					{
						echo '<li class="breadcrumb-item active"><a href="' . newsmunch_page_url() . '">'.__('Error 404','newsmunch-pro').'</a></li>';
					}
					else { 
					    echo '<li class="breadcrumb-item active"><a href="' . newsmunch_page_url() . '">'. get_the_title() .'</a></li>';
					}
				endif;
        }
endif;


// NewsMunch Excerpt Read More
if ( ! function_exists( 'newsmunch_execerpt_btn' ) ) :
function newsmunch_execerpt_btn() {
	$newsmunch_show_post_btn		= get_theme_mod('newsmunch_show_post_btn'); 
	$newsmunch_read_btn_txt		= get_theme_mod('newsmunch_read_btn_txt','Read more'); 
	if ( $newsmunch_show_post_btn == '1' ) { 
	?>
	<a href="<?php echo esc_url(get_the_permalink()); ?>" class="dt-btn dt-btn-secondary" data-title="<?php echo wp_kses_post($newsmunch_read_btn_txt); ?>"><?php echo wp_kses_post($newsmunch_read_btn_txt); ?></a>
<?php } 
	} 
endif;

// NewsMunch excerpt length
function newsmunch_site_excerpt_length( $length ) {
	 $newsmunch_post_excerpt_length= get_theme_mod('newsmunch_post_excerpt_length','30'); 
    if( $newsmunch_post_excerpt_length == 1000 ) {
        return 9999;
    }
    return esc_html( $newsmunch_post_excerpt_length );
}
add_filter( 'excerpt_length', 'newsmunch_site_excerpt_length', 999 );



// NewsMunch excerpt more
function newsmunch_site_excerpt_more( $more ) {
	return get_theme_mod('newsmunch_blog_excerpt_more','&hellip;');;
}
add_filter( 'excerpt_more', 'newsmunch_site_excerpt_more' );


/**
 * NewsMunch Header Widget Area First
 */
function newsmunch_header_widget_area_first() {
	$newsmunch_header_widget_first = 'newsmunch-header-widget-left';
	if ( is_active_sidebar( $newsmunch_header_widget_first ) ){ 
		dynamic_sidebar( 'newsmunch-header-widget-left' );
	} elseif ( current_user_can( 'edit_theme_options' ) ) {

			$newsmunch_sidebar_name = newsmunch_get_sidebar_name_by_id( $newsmunch_header_widget_first );
			?>
			<div class='widget widget_none'>
				<h4 class='widget-title'><?php echo esc_html( $newsmunch_sidebar_name ); ?></h4>
				<p>
					<?php if ( is_customize_preview() ) { ?>
						<a href="#" class="" data-sidebar-id="<?php echo esc_attr( $newsmunch_header_widget_first ); ?>">
					<?php } else { ?>
						<a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>">
					<?php } ?>
						<?php esc_html_e( 'Please assign a widget here.', 'newsmunch-pro' ); ?>
					</a>
				</p>
			</div>
			<?php
		}
}


/**
 * NewsMunch Header Widget Area Second
 */
function newsmunch_header_widget_area_second() {
	$newsmunch_header_widget_first = 'newsmunch-header-widget-right';
	if ( is_active_sidebar( $newsmunch_header_widget_first ) ){ 
		dynamic_sidebar( 'newsmunch-header-widget-right' );
} elseif ( current_user_can( 'edit_theme_options' ) ) {

		$newsmunch_sidebar_name = newsmunch_get_sidebar_name_by_id( $newsmunch_header_widget_first );
		?>
		<div class='widget widget_none'>
			<h4 class='widget-title'><?php echo esc_html( $newsmunch_sidebar_name ); ?></h4>
			<p>
				<?php if ( is_customize_preview() ) { ?>
					<a href="#" class="" data-sidebar-id="<?php echo esc_attr( $newsmunch_header_widget_first ); ?>">
				<?php } else { ?>
					<a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>">
				<?php } ?>
					<?php esc_html_e( 'Please assign a widget here.', 'newsmunch-pro' ); ?>
				</a>
			</p>
		</div>
		<?php
	}
}



/*=========================================
Register Google fonts for NewsMunch.
=========================================*/
function newsmunch_google_fonts_url() {
	
    $font_families = array('IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700');

	$fonts_url = add_query_arg( array(
		'family' => implode( '&family=', $font_families ),
		'display' => 'swap',
	), 'https://fonts.googleapis.com/css2' );

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	return wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

function newsmunch_google_fonts_scripts_styles() {
    wp_enqueue_style( 'newsmunch-google-fonts', newsmunch_google_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'newsmunch_google_fonts_scripts_styles' );


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function newsmunch_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$newsmunch_heading_style = get_theme_mod('newsmunch_heading_style','dt-section--title-one');
	$classes[] = $newsmunch_heading_style;
	
	$newsmunch_dark_mode=get_theme_mod('newsmunch_dark_mode');
	if($newsmunch_dark_mode == 'dark'){
		$classes[]='dark'; 
	}
	
	$newsmunch_theme_layout_option=get_theme_mod('newsmunch_theme_layout_option','wide-layout');
	if($newsmunch_theme_layout_option == "boxed-layout"){
		$classes[]='background-boxed'; 
	}else{
		$classes[]='background-wide'; 
	}
		
	$newsmunch_hs_hdr_sticky	=	get_theme_mod('newsmunch_hs_hdr_sticky','1');
	if($newsmunch_hs_hdr_sticky == "1"){
		$classes[]='sticky-header'; 
	}
	
	$sticky_sidebar_hs	=	get_theme_mod('sticky_sidebar_hs','1');	
	if($sticky_sidebar_hs == "1"){
		$classes[]='sticky-sidebar'; 
	}
	
	$newsmunch_enable_front_color_switcher=get_theme_mod('newsmunch_enable_front_color_switcher');
	if($newsmunch_enable_front_color_switcher == '1'){
		$classes[]='front__switcher-enable'; 
	}
	
	// $newsmunch_enable_gradiant_color=get_theme_mod('newsmunch_enable_gradiant_color'); 	// if($newsmunch_enable_gradiant_color == '1'){ 		// $classes[]='dt_gcolor'; 	// }
	
	$newsmunch_btn_style=get_theme_mod('newsmunch_btn_style','btn--effect-one');
	$classes[]=$newsmunch_btn_style;

	return $classes;
}
add_filter( 'body_class', 'newsmunch_body_classes' );

function newsmunch_post_classes( $classes ) {
	if ( is_single() ) : 
	$classes[]='single-post'; 
	endif;
	return $classes;
}
add_filter( 'post_class', 'newsmunch_post_classes' );


/**
 * Returns posts.
 */
if (!function_exists('newsmunch_get_posts')):
    function newsmunch_get_posts($number_posts, $post_category = '0')
    {

        $ins_args = array(
            'post_type' => 'post',
            'posts_per_page' => absint($number_posts),
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC',
            'ignore_sticky_posts' => true
        );

        $post_category = isset($post_category) ? $post_category : '0';
        if (absint($post_category) > 0) {
            $ins_args['cat'] = absint($post_category);
        }

        $got_posts = new WP_Query($ins_args);

        return $got_posts;
    }

endif;


if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Backward compatibility for wp_body_open hook.
	 *
	 * @since 1.0.0
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

if (!function_exists('newsmunch_str_replace_assoc')) {

    /**
     * newsmunch_str_replace_assoc
     * @param  array $replace
     * @param  array $subject
     * @return array
     */
    function newsmunch_str_replace_assoc(array $replace, $subject) {
        return str_replace(array_keys($replace), array_values($replace), $subject);
    }
}

// Comments Counts
if ( ! function_exists( 'newsmunch_comment_count' ) ) :
function newsmunch_comment_count() {
	$newsmunch_comments_count 	= get_comments_number();
	if ( 0 === intval( $newsmunch_comments_count ) ) {
		echo esc_html__( '0 Comments', 'newsmunch-pro' );
	} else {
		/* translators: %s Comment number */
		 echo sprintf( _n( '%s Comment', '%s Comments', $newsmunch_comments_count, 'newsmunch-pro' ), number_format_i18n( $newsmunch_comments_count ) );
	}
} 
endif;

/*=========================================
NewsMunch Background Image Pattern
=========================================*/
function newsmunch_background_pattern()
{
	$newsmunch_theme_layout_style = get_theme_mod('newsmunch_theme_layout_style');
	if($newsmunch_theme_layout_style!='')
	{
	echo '<style>body.background-boxed { background:url("'.get_template_directory_uri().'/inc/customizer/controls/images/patterns/'.$newsmunch_theme_layout_style.'");}</style>';
	}
}
add_action('wp_head','newsmunch_background_pattern',10,0);


/**
 * Display Sidebars
 */
if ( ! function_exists( 'newsmunch_get_sidebars' ) ) {
	/**
	 * Get Sidebar
	 *
	 * @since 1.0
	 * @param  string $sidebar_id   Sidebar Id.
	 * @return void
	 */
	function newsmunch_get_sidebars( $sidebar_id ) {
		if ( is_active_sidebar( $sidebar_id ) ) {
			dynamic_sidebar( $sidebar_id );
		} elseif ( current_user_can( 'edit_theme_options' ) ) {
			?>
			<div class="widget">
				<p class='no-widget-text'>
					<a href='<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>'>
						<?php esc_html_e( 'Add Widget', 'newsmunch-pro' ); ?>
					</a>
				</p>
			</div>
			<?php
		}
	}
}

/**
 * Get registered sidebar name by sidebar ID.
 *
 * @since  1.0.0
 * @param  string $sidebar_id Sidebar ID.
 * @return string Sidebar name.
 */
function newsmunch_get_sidebar_name_by_id( $sidebar_id = '' ) {

	if ( ! $sidebar_id ) {
		return;
	}

	global $wp_registered_sidebars;
	$sidebar_name = '';

	if ( isset( $wp_registered_sidebars[ $sidebar_id ] ) ) {
		$sidebar_name = $wp_registered_sidebars[ $sidebar_id ]['name'];
	}

	return $sidebar_name;
}

/*=========================================
NewsMunch Site Preloader
=========================================*/
if ( ! function_exists( 'newsmunch_site_preloader' ) ) :
function newsmunch_site_preloader() {
	$newsmunch_hs_preloader_option 	= get_theme_mod( 'newsmunch_hs_preloader_option','1'); 
	if($newsmunch_hs_preloader_option == '1') { 
	?>
		 <div id="dt_preloader" class="dt_preloader">
			<div class="dt_preloader-inner">
				<div class="dt_preloader-handle">
					<button type="button" class="dt_preloader-close site--close"></button>
					<div class="dt_preloader-animation">
						<div class="dt_preloader-object"></div>
					</div>
				</div>
			</div>
		</div>
	<?php }
	} 
endif;
add_action( 'newsmunch_site_preloader', 'newsmunch_site_preloader' );


/*=========================================
NewsMunch Side Docker
=========================================*/
if ( ! function_exists( 'newsmunch_menu_side_docker' ) ) :
function newsmunch_menu_side_docker() {
	$newsmunch_hs_side_docker 	= get_theme_mod( 'newsmunch_hs_side_docker','1'); 
	if($newsmunch_hs_side_docker == '1') { 
	?>
		<li class="dt_navbar-sidebar-item">
			<div class="dt_navbar-sidebar-btn">
				<button type="button" class="dt_navbar-sidebar-toggle">
					<span class="dt_navbar-sidebar-toggle-inner"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span>
				</button>
				<div class="dt_sidebar-toggle">
					<div class="off--layer dt_sidebar-close"></div>
					<div class="dt_sidebar-wrapper">
						<div class="dt_sidebar-inner">
							<button type="button" class="dt_sidebar-close site--close"></button>
							<div class="dt_sidebar-content">
								<?php dynamic_sidebar('menu-side-docker-area'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</li>
	<?php }
	} 
endif;
add_action( 'newsmunch_menu_side_docker', 'newsmunch_menu_side_docker' );


/*=========================================
NewsMunch Site Header
=========================================*/
if ( ! function_exists( 'newsmunch_site_main_header' ) ) :
function newsmunch_site_main_header() {
	$newsmunch_header_design = get_theme_mod( 'newsmunch_header_design','header--one');
	if($newsmunch_header_design=='header--four' || $newsmunch_header_design=='header--five' || $newsmunch_header_design=='header--eleven'):
	get_template_part('template-parts/prebuilt-sections/site','header-four');
	elseif($newsmunch_header_design=='header--six' || $newsmunch_header_design=='header--seven'):
	get_template_part('template-parts/prebuilt-sections/site','header-six');
	elseif($newsmunch_header_design=='header--nine'):
	get_template_part('template-parts/prebuilt-sections/site','header-nine');
	elseif($newsmunch_header_design=='header--ten'):
	get_template_part('template-parts/prebuilt-sections/site','header-ten');
	else:
	get_template_part('template-parts/prebuilt-sections/site','header');
	endif;
} 
endif;
add_action( 'newsmunch_site_main_header', 'newsmunch_site_main_header' );



/*=========================================
NewsMunch Header Image
=========================================*/
if ( ! function_exists( 'newsmunch_wp_hdr_image' ) ) :
function newsmunch_wp_hdr_image() {
	if ( get_header_image() ) : 
	$header_image = get_header_image(); ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="custom-header" id="custom-header" rel="home">
		<img src="<?php echo esc_url($header_image); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr(get_bloginfo( 'title' )); ?>">
	</a>
<?php endif;
	} 
endif;
add_action( 'newsmunch_wp_hdr_image', 'newsmunch_wp_hdr_image' );


/*=========================================
NewsMunch Header Left Text
=========================================*/
if ( ! function_exists( 'newsmunch_header_left_text' ) ) :
function newsmunch_header_left_text() {
	$newsmunch_hs_hdr_left_text 	= get_theme_mod( 'newsmunch_hs_hdr_left_text','1'); 
	$newsmunch_hdr_left_ttl  	= get_theme_mod( 'newsmunch_hdr_left_ttl','<i class="fas fa-fire-alt"></i> Trending News:');
	$newsmunch_hdr_left_text_cat = get_theme_mod( 'newsmunch_hdr_left_text_cat','0');
	$newsmunch_hdr_left_text_posts= newsmunch_get_posts(100, $newsmunch_hdr_left_text_cat);
	if($newsmunch_hs_hdr_left_text=='1'): ?>
		<div class="widget dt-news-headline">
			<?php if(!empty($newsmunch_hdr_left_ttl)): ?>
				<strong class="dt-news-heading"><?php echo wp_kses_post($newsmunch_hdr_left_ttl); ?></strong>
			<?php endif; ?>
			<span class="dt_heading dt_heading_2">
				<span class="dt_heading_inner">
					<?php
						if ($newsmunch_hdr_left_text_posts->have_posts()) :
						$i=0;
						while ($newsmunch_hdr_left_text_posts->have_posts()) : $newsmunch_hdr_left_text_posts->the_post();
						global $post;
						$i=$i+1;
						if($i=='1'):
							newsmunch_common_post_title('b','is_on'); 
						else:
							newsmunch_common_post_title('b',''); 
						endif;
						endwhile;endif;wp_reset_postdata();
					?>
				</span>
			</span>
		</div>
	<?php endif;
} 
endif;
add_action( 'newsmunch_header_left_text', 'newsmunch_header_left_text' );


/*=========================================
NewsMunch Header Address
=========================================*/
if ( ! function_exists( 'newsmunch_header_address' ) ) :
function newsmunch_header_address() {
	$newsmunch_hs_hdr_top_ads 	= get_theme_mod( 'newsmunch_hs_hdr_top_ads'); 
	$newsmunch_hdr_top_ads_icon= get_theme_mod( 'newsmunch_hdr_top_ads_icon','fas fa-map-marker-alt'); 
	$newsmunch_hdr_top_ads_title = get_theme_mod( 'newsmunch_hdr_top_ads_title','Chicago 12, Melborne City, USA');
	$newsmunch_hdr_top_ads_link = get_theme_mod( 'newsmunch_hdr_top_ads_link');
	if($newsmunch_hs_hdr_top_ads=='1'): ?>
		<div class="widget dt-address">
			<?php if(!empty($newsmunch_hdr_top_ads_icon)): ?>
				<i class="<?php echo esc_attr($newsmunch_hdr_top_ads_icon); ?>"></i>
			<?php endif; ?>
			
			<?php if(!empty($newsmunch_hdr_top_ads_title)): ?>
				<?php if(!empty($newsmunch_hdr_top_ads_link)): ?>
					<span><a href="<?php echo esc_url($newsmunch_hdr_top_ads_link); ?>"><?php echo wp_kses_post($newsmunch_hdr_top_ads_title); ?></a></span>
				<?php else: ?>
					<span><?php echo wp_kses_post($newsmunch_hdr_top_ads_title); ?></span>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	<?php endif;
} 
endif;
add_action( 'newsmunch_header_address', 'newsmunch_header_address' );


/*=========================================
NewsMunch Weather
=========================================*/
if ( ! function_exists( 'newsmunch_header_weather' ) ) :
function newsmunch_header_weather() {
	$newsmunch_hs_hdr_top_weather 	= get_theme_mod( 'newsmunch_hs_hdr_top_weather','1'); 
	if($newsmunch_hs_hdr_top_weather=='1'): ?>
		<div class="widget dt-weather">
			<div class="cities"></div>
		</div>
	<?php endif;
} 
endif;
add_action( 'newsmunch_header_weather', 'newsmunch_header_weather' );

/*=========================================
NewsMunch Date
=========================================*/
if ( ! function_exists( 'newsmunch_header_date' ) ) :
function newsmunch_header_date() {
	$newsmunch_hs_hdr_date 		= get_theme_mod( 'newsmunch_hs_hdr_date','1'); 
	$newsmunch_hs_hdr_time 		= get_theme_mod( 'newsmunch_hs_hdr_time','1'); 
	$newsmunch_hdr_date_display 	= get_theme_mod( 'newsmunch_hdr_date_display','theme');
	?>
		<div class="widget dt-current-date">
			<?php if($newsmunch_hs_hdr_date=='1'): ?>
				<span>
					<i class="fas fa-calendar-alt"></i> 
					<?php 
						if($newsmunch_hdr_date_display=='theme'): 
							echo date_i18n('D. M jS, Y ', strtotime(current_time("Y-m-d"))); 
						else:
							echo date_i18n( get_option( 'date_format' ) ); 
						endif; 
					?>
				</span>
			<?php endif; ?>
			<?php if($newsmunch_hs_hdr_time=='1'): ?>
				<span id="dt-time" class="dt-time"></span>
			<?php endif; ?>	
		</div>
	<?php
} 
endif;
add_action( 'newsmunch_header_date', 'newsmunch_header_date' );

/*=========================================
NewsMunch Social Icon
=========================================*/
if ( ! function_exists( 'newsmunch_site_social' ) ) :
function newsmunch_site_social() {
	// Social 
	$newsmunch_hs_hdr_social 	= get_theme_mod( 'newsmunch_hs_hdr_social','1'); 
	$newsmunch_hdr_social 		= get_theme_mod( 'newsmunch_hdr_social',newsmunch_get_social_icon_default());
	if($newsmunch_hs_hdr_social=='1'): ?>
		<div class="widget widget_social">
			<?php
				$newsmunch_hdr_social = json_decode($newsmunch_hdr_social);
				if( $newsmunch_hdr_social!='' )
				{
				foreach($newsmunch_hdr_social as $item){	
				$social_icon = ! empty( $item->icon_value ) ? apply_filters( 'newsmunch_translate_single_string', $item->icon_value, 'Header section' ) : '';	
				$social_link = ! empty( $item->link ) ? apply_filters( 'newsmunch_translate_single_string', $item->link, 'Header section' ) : '';
			?>
				<a href="<?php echo esc_url( $social_link ); ?>"><i class="<?php echo esc_attr( $social_icon ); ?>"></i></a>
			<?php }} ?>
		</div>
	<?php endif;
} 
endif;
add_action( 'newsmunch_site_social', 'newsmunch_site_social' );

/*=========================================
NewsMunch Site Header
=========================================*/
if ( ! function_exists( 'newsmunch_site_header' ) ) :
function newsmunch_site_header() {
$newsmunch_hs_hdr 	= get_theme_mod( 'newsmunch_hs_hdr','1');
$newsmunch_header_design 	= get_theme_mod( 'newsmunch_header_design','header--three');
if($newsmunch_hs_hdr == '1') { 
?>
	<div class="dt-container-md">
		<div class="dt-row">
			<div class="dt-col-lg-7 dt-col-12">
				<div class="dt_header-wrap left">
					<?php  do_action('newsmunch_header_left_text'); ?>
				</div>
			</div>
			<div class="dt-col-lg-5 dt-col-12">
				<div class="dt_header-wrap right">
					<?php  do_action('newsmunch_header_date'); ?>
					<?php  do_action('newsmunch_header_address'); ?>
					<?php  do_action('newsmunch_header_weather'); ?>
				</div>
			</div>
		</div>
	</div>
	<?php }
	} 
endif;
add_action( 'newsmunch_site_header', 'newsmunch_site_header' );



/*=========================================
NewsMunch Site Navigation
=========================================*/
if ( ! function_exists( 'newsmunch_site_header_navigation' ) ) :
function newsmunch_site_header_navigation() {
	wp_nav_menu( 
		array(  
			'theme_location' => 'primary_menu',
			'container'  => '',
			'menu_class' => 'dt_navbar-mainmenu',
			'fallback_cb' => 'newsmunch_fallback_page_menu',
			'walker' => new WP_Bootstrap_Navwalker()
			 ) 
		);
	} 
endif;
add_action( 'newsmunch_site_header_navigation', 'newsmunch_site_header_navigation' );


/*=========================================
NewsMunch Header Banner
=========================================*/
if ( ! function_exists( 'newsmunch_header_banner' ) ) :
function newsmunch_header_banner() {
	$newsmunch_hs_hdr_banner 		= get_theme_mod( 'newsmunch_hs_hdr_banner','1'); 
	$newsmunch_hdr_banner_img 		= get_theme_mod( 'newsmunch_hdr_banner_img',esc_url(get_template_directory_uri() .'/assets/img/promo-news.png')); 
	$newsmunch_hdr_banner_link 		= get_theme_mod( 'newsmunch_hdr_banner_link','#'); 
	$newsmunch_hdr_banner_target 	= get_theme_mod( 'newsmunch_hdr_banner_target');
	if($newsmunch_hdr_banner_target=='1'): $target='target=_blank'; else: $target=''; endif; 
	if($newsmunch_hs_hdr_banner=='1'  && !empty($newsmunch_hdr_banner_img)):	
?>
	<a href="<?php echo esc_url($newsmunch_hdr_banner_link); ?>" <?php echo esc_attr($target); ?>><img src="<?php echo esc_url($newsmunch_hdr_banner_img); ?>"></a>
<?php endif;
	} 
endif;
add_action( 'newsmunch_header_banner', 'newsmunch_header_banner' );


/*=========================================
NewsMunch Header Button
=========================================*/
if ( ! function_exists( 'newsmunch_header_button' ) ) :
function newsmunch_header_button( $btnClass = 'dt-btn-secondary' ) {
	$newsmunch_hs_hdr_btn 		= get_theme_mod( 'newsmunch_hs_hdr_btn','1'); 
	$newsmunch_hdr_btn_lbl 		= get_theme_mod( 'newsmunch_hdr_btn_lbl','Subscribe'); 
	$newsmunch_hdr_btn_link 		= get_theme_mod( 'newsmunch_hdr_btn_link','#'); 
	$newsmunch_hdr_btn_target 		= get_theme_mod( 'newsmunch_hdr_btn_target');
	if($newsmunch_hdr_btn_target=='1'): $target='target=_blank'; else: $target=''; endif; 
	if($newsmunch_hs_hdr_btn=='1'  && !empty($newsmunch_hdr_btn_lbl)):	
?>
	<li class="dt_navbar-button-item">
		<a href="<?php echo esc_url($newsmunch_hdr_btn_link); ?>" <?php echo esc_attr($target); ?> class="dt-btn <?php echo esc_attr($btnClass); ?>" data-title="<?php echo wp_kses_post($newsmunch_hdr_btn_lbl); ?>"><?php echo wp_kses_post($newsmunch_hdr_btn_lbl); ?></a>
	</li>
<?php endif;
	} 
endif;
add_action( 'newsmunch_header_button', 'newsmunch_header_button' );


/*=========================================
NewsMunch Header Dark
=========================================*/
if ( ! function_exists( 'newsmunch_dark_light_switcher' ) ) :
function newsmunch_dark_light_switcher() {
	$newsmunch_hs_hdr_dark_option 		= get_theme_mod( 'newsmunch_hs_hdr_dark_option','1'); 
	if($newsmunch_hs_hdr_dark_option=='1'):	
?>
	<li class="dt_switcherdarkbtn-item">
		<button type="button" class="dt_switcherdarkbtn"></button>
	</li>
<?php endif;
	} 
endif;
add_action( 'newsmunch_dark_light_switcher', 'newsmunch_dark_light_switcher' );

/*=========================================
NewsMunch Site Search
=========================================*/
if ( ! function_exists( 'newsmunch_site_main_search' ) ) :
function newsmunch_site_main_search() {
	$newsmunch_hs_hdr_search 	= get_theme_mod( 'newsmunch_hs_hdr_search','1'); 
	$newsmunch_search_result 	= get_theme_mod( 'newsmunch_search_result','post');
	if($newsmunch_hs_hdr_search=='1'):	
?>
<li class="dt_navbar-search-item">
	<button class="dt_navbar-search-toggle"><svg class="icon"><use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/icons/icons.svg#search-icon"></use></svg></button>
	<div class="dt_search search--header">
		<form method="get" class="dt_search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'search again', 'newsmunch-pro' ); ?>">
			<label for="dt_search-form-1">
				 <?php if($newsmunch_search_result=='product' && class_exists('WooCommerce')):	?>
					<input type="hidden" name="post_type" value="product" />
				 <?php endif; ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'newsmunch-pro' ); ?></span>
				<input type="search" id="dt_search-form-1" class="dt_search-field" placeholder="<?php esc_attr_e( 'search Here', 'newsmunch-pro' ); ?>" value="" name="s" />
			</label>
			<button type="submit" class="dt_search-submit search-submit"><i class="fas fa-search" aria-hidden="true"></i></button>
		</form>
		<?php
		$posttags = get_tags();
		if($posttags):
		?>
		<div class="categories">
			<h5><?php esc_html_e( 'Or check our Popular Categories...', 'newsmunch-pro' ); ?></h5>
			<div class="widget">
				<div class="wp-block-tag-cloud">
					<?php
					foreach($posttags as $index=>$tag){
						echo '<a href="'.esc_url(get_tag_link($tag->term_id)).'">' .$tag->name. '</a>'; // echos while $index == 0 & 1
						 if($index>7){break;}  // second iteration ($index==1) breaks the loop
					}
					?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<button type="button" class="dt_search-close site--close"></button>
	</div>
</li>
<?php endif;
	} 
endif;
add_action( 'newsmunch_site_main_search', 'newsmunch_site_main_search' );



/*=========================================
NewsMunch WooCommerce Cart
=========================================*/
if ( ! function_exists( 'newsmunch_woo_cart' ) ) :
function newsmunch_woo_cart() {
	$newsmunch_hs_hdr_cart 	= get_theme_mod( 'newsmunch_hs_hdr_cart','1'); 
		if($newsmunch_hs_hdr_cart=='1' && class_exists( 'WooCommerce' )):	
	?>
	<li class="dt_navbar-cart-item">
		<a href="javascript:void(0);" class="dt_navbar-cart-icon">
			<span class="cart_icon">
				<svg class="icon"><use xlink:href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/icons/icons.svg#cart-icon"></use></svg>
			</span>
			<?php 
				$count = WC()->cart->cart_contents_count;
				
				if ( $count > 0 ) {
				?>
					 <strong class="cart_count"><?php echo esc_html( $count ); ?></strong>
				<?php 
				}
				else {
					?>
					<strong class="cart_count"><?php  esc_html_e('0','newsmunch-pro'); ?></strong>
					<?php 
				}
			?>
		</a>
		<div class="dt_navbar-shopcart">
			<?php get_template_part('woocommerce/cart/mini','cart'); ?>      
		</div>
	</li>
	<?php endif; 
	} 
endif;
add_action( 'newsmunch_woo_cart', 'newsmunch_woo_cart' );


 /**
 * Add WooCommerce Cart Icon With Cart Count (https://isabelcastillo.com/woocommerce-cart-icon-count-theme-header)
 */
function newsmunch_woo_add_to_cart_fragment( $fragments ) {
	
    ob_start();
    $count = WC()->cart->cart_contents_count; 
    ?> 
	<?php 
			$count = WC()->cart->cart_contents_count;
			
			if ( $count > 0 ) {
			?>
				 <strong class="cart_count"><?php echo esc_html( $count ); ?></strong>
			<?php 
			}
			else {
				?>
				<strong class="cart_count"><?php esc_html_e('0','newsmunch-pro'); ?></strong>
				<?php 
			}
	?>
	<?php
 
    $fragments['.cart_count'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'newsmunch_woo_add_to_cart_fragment' );


/*=========================================
NewsMunch My Account
=========================================*/
if ( ! function_exists( 'newsmunch_hdr_account' ) ) {
	function newsmunch_hdr_account() {	
		$newsmunch_hs_hdr_account 		= get_theme_mod( 'newsmunch_hs_hdr_account','1');
		if($newsmunch_hs_hdr_account=='1'): ?>
			<li class="dt_navbar-login-item">
				<?php if(is_user_logged_in()): ?>
					<a href="<?php echo esc_url(wp_logout_url( home_url())); ?>" class="dt-user-login"><i class="fas fa-user-alt"></i></a>
				<?php else: ?>
					<a href="<?php echo esc_url(wp_login_url( home_url())); ?>" class="dt-user-login"><i class="fas fa-user-alt"></i></a>
				<?php endif; ?>
			</li>
		<?php endif;
	}
}
add_action( 'newsmunch_hdr_account', 'newsmunch_hdr_account' );


/*=========================================
NewsMunch Subscribe
=========================================*/
if ( ! function_exists( 'newsmunch_hdr_subscribe' ) ) {
	function newsmunch_hdr_subscribe() {	
		$newsmunch_hs_hdr_subscribe 		= get_theme_mod( 'newsmunch_hs_hdr_subscribe','1');
		$newsmunch_hdr_subscribe_link 		= get_theme_mod( 'newsmunch_hdr_subscribe_link','#');
		if($newsmunch_hs_hdr_subscribe=='1'): ?>
			<li class="dt_navbar-subscribe-item">
				<a href="<?php echo esc_url($newsmunch_hdr_subscribe_link); ?>" class="dt-subscribe"><i class="far fa-bell"></i></a>
			</li>
		<?php endif;
	}
}
add_action( 'newsmunch_hdr_subscribe', 'newsmunch_hdr_subscribe' );


/*=========================================
NewsMunch Site Logo
=========================================*/
if ( ! function_exists( 'newsmunch_site_logo' ) ) :
function newsmunch_site_logo() {
		$newsmunch_title_tagline_seo = get_theme_mod( 'newsmunch_title_tagline_seo');
		if(has_custom_logo())
			{	
				the_custom_logo();
			}
			else { 
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site--title">
				<h1 class="site--title">
					<?php 
						echo esc_html(get_bloginfo('name'));
					?>
				</h1>
			</a>	
		<?php 						
			}
		?>
		<?php if($newsmunch_title_tagline_seo=='1'): ?>	
			<h1 class="site--title" style="display: none;">
				<?php 
					echo esc_html(get_bloginfo('name'));
				?>
			</h1>
		<?php
			endif;
			$newsmunch_description = get_bloginfo( 'description');
			if ($newsmunch_description) : ?>
				<p class="site--description"><?php echo esc_html($newsmunch_description); ?></p>
		<?php endif;
	} 
endif;
add_action( 'newsmunch_site_logo', 'newsmunch_site_logo' );


/*=========================================
NewsMunch Main Slider
=========================================*/
if ( ! function_exists( 'newsmunch_site_slider_main' ) ) :
function newsmunch_site_slider_main() {
	$newsmunch_slider_position		= get_theme_mod('newsmunch_slider_position','left') == 'left' ? '': 'dt-flex-row-reverse'; 
	$newsmunch_slider_type			= get_theme_mod('newsmunch_slider_type','lg');
	$newsmunch_slider_column		= get_theme_mod('newsmunch_slider_column','1');
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
	<div class="post-carousel-banner post-carousel-column<?php echo esc_attr($newsmunch_slider_column); ?>" data-slick='{"slidesToShow": <?php echo esc_attr($newsmunch_slider_column); ?>, "slidesToScroll": 1}'>
		<?php
			if ($newsmunch_slider_posts->have_posts()) :
			while ($newsmunch_slider_posts->have_posts()) : $newsmunch_slider_posts->the_post();

			global $post;
			$format = get_post_format() ? : 'standard';	
		?>
			<div class="post featured-post-<?php echo esc_attr($newsmunch_slider_type); ?>">
				<div class="details clearfix">
					<?php if($newsmunch_hs_slider_cat_meta=='1'): newsmunch_getpost_categories();  endif; ?>
					<?php if($newsmunch_hs_slider_title=='1'): newsmunch_common_post_title('h2','post-title'); endif; ?> 
					<ul class="meta list-inline dt-mt-0 dt-mb-0 dt-mt-3">
						<?php if($newsmunch_hs_slider_auth_meta=='1'): ?>
							<li class="list-inline-item"><i class="far fa-user-circle"></i> <?php esc_html_e('By','newsmunch-pro');?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>" title="Posts by David" rel="author"><?php esc_html(the_author()); ?></a></li>
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
	$newsmunch_slider_type				= get_theme_mod('newsmunch_slider_type','lg');
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
			<div class="post featured-post-<?php echo esc_attr($newsmunch_slider_type); ?>">
				<div class="details clearfix">
					<?php if($newsmunch_hs_slider_mdl_cat_meta=='1'): newsmunch_getpost_categories();  endif; ?>
					<?php if($newsmunch_hs_slider_mdl_title=='1'): newsmunch_common_post_title('h2','post-title'); endif; ?> 
					<ul class="meta list-inline dt-mt-0 dt-mb-0 dt-mt-3">
						<?php if($newsmunch_hs_slider_mdl_auth_meta=='1'): ?>
							<li class="list-inline-item"><i class="far fa-user-circle"></i> <?php esc_html_e('By','newsmunch-pro');?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>" title="Posts by David" rel="author"><?php esc_html(the_author()); ?></a></li>
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
	$newsmunch_slider_right_tab_count= get_theme_mod('newsmunch_slider_right_tab_count','3');
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
			
			if(!empty($newsmash_tabfirst_cat) && !empty($newsmunch_tabsecond_cat) && !empty($newsmunch_tabthird_cat)):
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
			<li role="presentation"><button aria-controls='<?php echo esc_html($catFirst); ?>' aria-selected="true" class="nav-link active" data-tab="<?php echo esc_html($catFirst); ?>" role="tab" type="button"><i class="fas fa-bolt" aria-hidden="true"></i><?php echo esc_html(get_cat_name( $newsmunch_tabfirst_cat )); ?></button></li>
		<?php else: ?>
			<li role="presentation"><button aria-controls='<?php echo esc_html($catFirst); ?>' aria-selected="true" class="nav-link active" data-tab="<?php echo esc_html($catFirst); ?>" role="tab" type="button"><i class="fas fa-bolt" aria-hidden="true"></i><?php esc_html_e('Popular','newsmunch-pro'); ?></button></li>
		<?php endif; ?>	
		
		<?php if($newsmunch_slider_right_tab_count == '2' || $newsmunch_slider_right_tab_count == '3'):?> 
			<?php if(!empty($newsmunch_tabsecond_cat)):?>
				<li role="presentation"><button aria-controls="<?php echo esc_html($catSecond); ?>" aria-selected="false" class="nav-link" data-tab="<?php echo esc_html($catSecond); ?>" role="tab" type="button"><i class="fas fa-fire-alt" aria-hidden="true"></i><?php echo esc_html(get_cat_name( $newsmunch_tabsecond_cat )); ?></button></li>
			<?php else: ?>
				<li role="presentation"><button aria-controls='<?php echo esc_html($catSecond); ?>' aria-selected="false" class="nav-link" data-tab="<?php echo esc_html($catSecond); ?>" role="tab" type="button"><i class="fas fa-fire-alt" aria-hidden="true"></i><?php esc_html_e('Trending','newsmunch-pro'); ?></button></li>
			<?php endif; ?>	
		<?php endif; ?>	
		
		<?php if($newsmunch_slider_right_tab_count == '3'):?>
			<?php if(!empty($newsmunch_tabthird_cat)):?>
				<li role="presentation"><button aria-controls="<?php echo esc_html($catThird); ?>" aria-selected="false" class="nav-link" data-tab="<?php echo esc_html($catThird); ?>" role="tab" type="button"><i class="fas fa-clock" aria-hidden="true"></i><?php echo esc_html(get_cat_name( $newsmunch_tabthird_cat )); ?></button></li>
			<?php else: ?>
				<li role="presentation"><button aria-controls='<?php echo esc_html($catThird); ?>' aria-selected="false" class="nav-link" data-tab="<?php echo esc_html($catThird); ?>" role="tab" type="button"><i class="fas fa-clock" aria-hidden="true"></i><?php esc_html_e('Recent','newsmunch-pro'); ?></button></li>
			<?php endif; ?>	
		<?php endif; ?>			
	</ul>
	<div class="tab-content" id="postsTabContent">
		<div class="lds-dual-ring"></div>
		<div aria-labelledby="<?php echo esc_html($catFirst); ?>-tab" class="tab-pane fade active show" id="<?php echo esc_html($catFirst); ?>" role="tabpanel">
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
		<div aria-labelledby="<?php echo esc_html($catSecond); ?>-tab" class="tab-pane fade" id="<?php echo esc_html($catSecond); ?>" role="tabpanel">
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
		<div aria-labelledby="<?php echo esc_html($catThird); ?>-tab" class="tab-pane fade" id="<?php echo esc_html($catThird); ?>" role="tabpanel">
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
		$newsmunch_display_slider 		= get_theme_mod( 'newsmunch_display_slider', 'front_post');
		$newsmunch_hs_slider 		= get_theme_mod( 'newsmunch_hs_slider', '1');
		if($newsmunch_hs_slider=='1'):
			if (is_home() && ($newsmunch_display_slider=='post' || $newsmunch_display_slider=='front_post')):
				get_template_part('template-parts/prebuilt-sections/frontpage/section','slider');
			elseif (is_front_page() && ($newsmunch_display_slider=='front' || $newsmunch_display_slider=='front_post')):
				get_template_part('template-parts/prebuilt-sections/frontpage/section','slider');
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
		$newsmunch_hs_featured_link 		= get_theme_mod( 'newsmunch_hs_featured_link', '1');
		if($newsmunch_hs_featured_link=='1'):
			if (is_home() && ($newsmunch_display_featured_link=='post' || $newsmunch_display_featured_link=='front_post')):
				get_template_part('template-parts/prebuilt-sections/frontpage/section','featured-link'); 
			elseif (is_front_page() && ($newsmunch_display_featured_link=='front' || $newsmunch_display_featured_link=='front_post')):
				get_template_part('template-parts/prebuilt-sections/frontpage/section','featured-link'); 
			endif;
		endif;
	 }
	} 
endif;
add_action( 'newsmunch_site_front_main2', 'newsmunch_site_featured_link' );

/*=========================================
NewsMunch Hero
=========================================*/
if ( ! function_exists( 'newsmunch_site_hero' ) ) :
function newsmunch_site_hero() {
	 if (is_front_page() || is_home()) {
		$newsmunch_display_hero = get_theme_mod( 'newsmunch_display_hero', 'front_post');
		$newsmunch_hs_hero 	   = get_theme_mod( 'newsmunch_hs_hero');
		if($newsmunch_hs_hero=='1'):
			if (is_home() && ($newsmunch_display_hero=='post' || $newsmunch_display_hero=='front_post')):
				get_template_part('template-parts/prebuilt-sections/frontpage/section','hero'); 
			elseif (is_front_page() && ($newsmunch_display_hero=='front' || $newsmunch_display_hero=='front_post')):
				get_template_part('template-parts/prebuilt-sections/frontpage/section','hero'); 
			endif;
		endif;
	 }
	} 
endif;
add_action( 'newsmunch_site_front_main3', 'newsmunch_site_hero' );

/*=========================================
NewsMunch Footer Widget
=========================================*/
if ( ! function_exists( 'newsmunch_footer_widget' ) ) :
function newsmunch_footer_widget() {
	$newsmunch_footer_widget_column	= get_theme_mod('newsmunch_footer_widget_column','4'); 
		if ($newsmunch_footer_widget_column == '4') {
				$column = '3';
			} elseif ($newsmunch_footer_widget_column == '3') {
				$column = '4';
			} elseif ($newsmunch_footer_widget_column == '2') {
				$column = '6';
			} else{
				$column = '12';
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
	$newsmunch_footer_cp_style = get_theme_mod('newsmunch_footer_cp_style','1');
	?>
	<div class="dt_footer-inner">
		<div class="dt-row dt-align-items-center dt-gy-4">
			<?php if($newsmunch_footer_cp_style=='1'): ?>
				<div class="dt-col-md-6 dt-text-md-left dt-text-center">
					<?php do_action('newsmunch_footer_copyright_data'); ?>
				</div>
				<div class="dt-col-md-6 dt-text-md-right dt-text-center">
					<?php do_action('newsmunch_footer_copyright_social'); ?>
				</div>
			<?php else: ?>
				<div class="dt-col-md-12 dt-text-center">
					<?php do_action('newsmunch_footer_copyright_data'); ?>
				</div>
				<?php
				$newsmunch_footer_copyright_social_hs 	= get_theme_mod( 'newsmunch_footer_copyright_social_hs','1'); 
				if($newsmunch_footer_copyright_social_hs=='1'): ?>
				<div class="dt-col-md-12 dt-text-center">
					<?php do_action('newsmunch_footer_copyright_social'); ?>
				</div>
			<?php endif; endif; ?>
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
				'[theme_author]' => sprintf(__('<a href="#">Desert Themes</a>', 'newsmunch-pro')),
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

/*=========================================
NewsMunch Scroller
=========================================*/
if ( ! function_exists( 'newsmunch_top_scroller' ) ) :
function newsmunch_top_scroller() {
	$newsmunch_hs_scroller_option	=	get_theme_mod('newsmunch_hs_scroller_option','1');
?>		
	<?php if ($newsmunch_hs_scroller_option == '1') { ?>
		<button type="button" id="dt_uptop" class="dt_uptop">
			<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
				<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 247.428;"></path>
			</svg>
		</button>
	<?php }
	} 
endif;
add_action( 'newsmunch_top_scroller', 'newsmunch_top_scroller' );


/*=========================================
NewsMunch Style Switcher
=========================================*/
if ( ! function_exists( 'newsmunch_style_switcher' ) ) :
function newsmunch_style_switcher() {
	$newsmunch_enable_front_color_switcher=get_theme_mod('newsmunch_enable_front_color_switcher');
	if($newsmunch_enable_front_color_switcher == '1') :
	wp_enqueue_style('newsmunch-front-switcher', get_template_directory_uri() .'/assets/vendors/front-switcher/switcher.css');
	wp_enqueue_script('newsmunch-front-switcher', get_template_directory_uri() .'/assets/vendors/front-switcher/switcher.js');
		?>
		<style id="customCss_main"></style>
		<style id="customCss_secondary"></style>
		<div class="dt__frontswitcher">
			<div class="dt__frontswitcher-iconcog">
				<i class="fas fa-palette"></i>
			</div>
			<div class="dt__frontswitcher-inner">
				<button type="button" class="dt__frontswitcher-reset"><i class="fas fa-redo"></i></button>

				<!--div class="dt__frontswitcher-block dt__lightDarkMode">
					<h3 class="title"><?php //esc_html_e('Light & Dark Mode','newsmunch-pro'); ?></h3>
					<label class="switch" for="switch_btn">
						<input type="checkbox" name="theme" id="switch_btn" class="switch_btn">
						<span class="sld"></span>
					</label>
				</div-->
				<!-- Color Primary -->
				<div class="dt__frontswitcher-block custom-color main">
					<h3 class="title"><?php esc_html_e('Primary Color','newsmunch-pro'); ?></h3>
					<button id="primary1" type="button" style="background-color: #1151D3;" class="active"></button>
					<button id="primary2" type="button" style="background-color: #f31717;"></button>
					<button id="primary3" type="button" style="background-color: #ff6a3e;"></button>
					<button id="primary4" type="button" style="background-color: #766df4;"></button>
					<button id="primary5" type="button" style="background-color: #c89d66;"></button>
					<button id="primary6" type="button" style="background-color: #f7961c;"></button>
					<button id="primary7" type="button" style="background-color: #6dc77a;"></button>
					<button id="primary8" type="button" style="background-color: #0f7173;"></button>
				</div>
				<!-- Color Secondary -->
				<div class="dt__frontswitcher-block custom-color secondary">
					<h3 class="title"><?php esc_html_e('Secondary Color','newsmunch-pro'); ?></h3>
					<button id="secondary1" type="button" style="background-color: #121418;" class="active"></button>
					<button id="secondary2" type="button" style="background-color: #0a267a;"></button>
					<button id="secondary3" type="button" style="background-color: #16243d;"></button>
					<button id="secondary4" type="button" style="background-color: #1e2843;"></button>
					<button id="secondary5" type="button" style="background-color: #083d59;"></button>
					<button id="secondary6" type="button" style="background-color: #191825;"></button>
					<button id="secondary7" type="button" style="background-color: #030925;"></button>
					<button id="secondary8" type="button" style="background-color: #14212B;"></button>
				</div>
				<!-- Layout -->
				<div class="dt__frontswitcher-block">
					<h3 class="title"><?php esc_html_e('Layout Mode','newsmunch-pro'); ?></h3>
					<button id="wide" type="button" class="dt__frontswitcher-background" value="wide"><?php esc_html_e('Wide','newsmunch-pro'); ?></button>
					<button id="boxed" type="button" class="dt__frontswitcher-background" value="boxed"><?php esc_html_e('Boxed','newsmunch-pro'); ?></button>
				</div>
				<!-- Patterns -->
				<div class="dt__frontswitcher-block background-pattern" style="display:none;">
					<h3 class="title"><?php esc_html_e('Background Patterns:','newsmunch-pro'); ?></h3>
					<button type="button" class="dt__frontswitcher-pattern" style="background-image: url('<?php echo esc_url(NEWSMUNCH_THEME_URI . '/inc/customizer/controls/images/patterns/1.png')?>');"></button>
					<button type="button" class="dt__frontswitcher-pattern" style="background-image: url('<?php echo esc_url(NEWSMUNCH_THEME_URI . '/inc/customizer/controls/images/patterns/2.png')?>');"></button>
					<button type="button" class="dt__frontswitcher-pattern" style="background-image: url('<?php echo esc_url(NEWSMUNCH_THEME_URI . '/inc/customizer/controls/images/patterns/3.png')?>');"></button>
					<button type="button" class="dt__frontswitcher-pattern" style="background-image: url('<?php echo esc_url(NEWSMUNCH_THEME_URI . '/inc/customizer/controls/images/patterns/4.png')?>');"></button>
					<button type="button" class="dt__frontswitcher-pattern" style="background-image: url('<?php echo esc_url(NEWSMUNCH_THEME_URI . '/inc/customizer/controls/images/patterns/5.png')?>');"></button>
					<button type="button" class="dt__frontswitcher-pattern" style="background-image: url('<?php echo esc_url(NEWSMUNCH_THEME_URI . '/inc/customizer/controls/images/patterns/6.png')?>');"></button>
					<button type="button" class="dt__frontswitcher-pattern" style="background-image: url('<?php echo esc_url(NEWSMUNCH_THEME_URI . '/inc/customizer/controls/images/patterns/7.png')?>');"></button>
					<button type="button" class="dt__frontswitcher-pattern" style="background-image: url('<?php echo esc_url(NEWSMUNCH_THEME_URI . '/inc/customizer/controls/images/patterns/8.png')?>');"></button>
				</div>
			</div>
		</div>
		<?php
	endif;
	} 
endif;
add_action( 'newsmunch_style_switcher', 'newsmunch_style_switcher' );


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
                    $output .= '<a href="' . esc_url(get_category_link($post_category)) . '" alt="' . esc_attr(sprintf(__('View all posts in %s', 'newsmunch-pro'), $post_category->name)) . '"> 
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




// if (!function_exists('newsmunch_save_taxonomy_color_class_meta')) :
// // Save extra taxonomy fields callback function.
    // function newsmunch_save_taxonomy_color_class_meta($term_id)
    // {
        // if (isset($_POST['term_meta'])) {
            // $t_id = $term_id;
            // $term_meta = get_option("category_color_$t_id");
            // $cat_keys = array_keys($_POST['term_meta']);
            // foreach ($cat_keys as $key) {
                // if (isset ($_POST['term_meta'][$key])) {
                    // $term_meta[$key] = $_POST['term_meta'][$key];
                // }
            // }
            // // Save the option array.
            // update_option("category_color_$t_id", $term_meta);
        // }
    // }

// endif;
// add_action('edited_category', 'newsmunch_save_taxonomy_color_class_meta', 10, 2);
// add_action('create_category', 'newsmunch_save_taxonomy_color_class_meta', 10, 2);




if ( ! class_exists( 'NEWSMUNCH_POST_CAT_META' ) ) {

class NEWSMUNCH_POST_CAT_META {

  public function __construct() {
    //
  }
 
 /*
  * Initialize the class and start calling our hooks and filters
  * @since 1.0.0
 */
 public function init() {
   add_action( 'category_add_form_fields', array ( $this, 'add_category_image' ), 10, 2 );
   add_action( 'created_category', array ( $this, 'save_category_image' ), 10, 2 );
   add_action( 'category_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
   add_action( 'edited_category', array ( $this, 'updated_category_image' ), 10, 2 );
   add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
   add_action( 'admin_footer', array ( $this, 'add_script' ) );
 }

public function load_media() {
 wp_enqueue_media();
}
 
 /*
  * Add a form field in the new category page
  * @since 1.0.0
 */
 public function add_category_image ( $taxonomy ) { ?>
   <div class="form-field term-group">
     <label for="category-image-id"><?php _e('Image', 'newsmunch-pro'); ?></label>
     <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
     <div id="category-image-wrapper"></div>
     <p>
       <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'newsmunch-pro' ); ?>" />
       <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'newsmunch-pro' ); ?>" />
    </p>
   </div>
   <div class="form-field">
		<label for="newsmunch_cat_article_lbl"><?php _e( 'Article Label', 'newsmunch-pro' ); ?></label>
		<input type="text" name="newsmunch_cat_article_lbl" id="newsmunch_cat_article_lbl" value="">
	</div>
 <?php
 }
 
 /*
  * Save the form field
  * @since 1.0.0
 */
 public function save_category_image ( $term_id, $tt_id ) {
   if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
     $image = $_POST['category-image-id'];
     add_term_meta( $term_id, 'category-image-id', $image, true );
   }
   
   if( isset( $_POST['newsmunch_cat_article_lbl'] ) && '' !== $_POST['newsmunch_cat_article_lbl'] ){
     $newsmunch_cat_article_lbl = $_POST['newsmunch_cat_article_lbl'];
     add_term_meta( $term_id, 'newsmunch_cat_article_lbl', $newsmunch_cat_article_lbl, true );
   }
   
   if( isset( $_POST['newsmunch_course_cat_url'] ) && '' !== $_POST['newsmunch_course_cat_url'] ){
     $newsmunch_course_cat_url = $_POST['newsmunch_course_cat_url'];
     add_term_meta( $term_id, 'newsmunch_course_cat_url', $newsmunch_course_cat_url, true );
   }
 }
 
 /*
  * Edit the form field
  * @since 1.0.0
 */
 public function update_category_image ( $term, $taxonomy ) { ?>
   <tr class="form-field term-group-wrap">
     <th scope="row">
       <label for="category-image-id"><?php _e( 'Image', 'newsmunch-pro' ); ?></label>
     </th>
     <td>
       <?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
       <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
       <div id="category-image-wrapper">
         <?php if ( $image_id ) { ?>
           <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
         <?php } ?>
       </div>
       <p>
         <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'newsmunch-pro' ); ?>" />
         <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'newsmunch-pro' ); ?>" />
       </p>
     </td>
   </tr>
   
	 <?php $newsmunch_cat_article_lbl = get_term_meta ( $term -> term_id, 'newsmunch_cat_article_lbl', true ); ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="newsmunch_cat_article_lbl"><?php _e( 'Article Label', 'newsmunch-pro' ); ?></label></th>
		<td>
			<input type="text" name="newsmunch_cat_article_lbl" id="newsmunch_cat_article_lbl" value="<?php echo esc_attr( $newsmunch_cat_article_lbl ) ? esc_attr( $newsmunch_cat_article_lbl ) : ''; ?>">
		</td>
	</tr>
 <?php
 }

/*
 * Update the form field value
 * @since 1.0.0
 */
 public function updated_category_image ( $term_id, $tt_id ) {
   if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
     $image = $_POST['category-image-id'];
     update_term_meta ( $term_id, 'category-image-id', $image );
   } else {
     update_term_meta ( $term_id, 'category-image-id', '' );
   }
   
   if( isset( $_POST['newsmunch_cat_article_lbl'] ) && '' !== $_POST['newsmunch_cat_article_lbl'] ){
     $image = $_POST['newsmunch_cat_article_lbl'];
     update_term_meta ( $term_id, 'newsmunch_cat_article_lbl', $image );
   } else {
     update_term_meta ( $term_id, 'newsmunch_cat_article_lbl', '' );
   }
 
 }

/*
 * Add script
 * @since 1.0.0
 */
 public function add_script() { ?>
   <script>
     jQuery(document).ready( function($) {
       function ct_media_upload(button_class) {
         var _custom_media = true,
         _orig_send_attachment = wp.media.editor.send.attachment;
         $('body').on('click', button_class, function(e) {
           var button_id = '#'+$(this).attr('id');
           var send_attachment_bkp = wp.media.editor.send.attachment;
           var button = $(button_id);
           _custom_media = true;
           wp.media.editor.send.attachment = function(props, attachment){
             if ( _custom_media ) {
               $('#category-image-id').val(attachment.id);
               $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
               $('#category-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
             } else {
               return _orig_send_attachment.apply( button_id, [props, attachment] );
             }
            }
         wp.media.editor.open(button);
         return false;
       });
     }
     ct_media_upload('.ct_tax_media_button.button'); 
     $('body').on('click','.ct_tax_media_remove',function(){
       $('#category-image-id').val('');
       $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
     });
     // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
     $(document).ajaxComplete(function(event, xhr, settings) {
       var queryStringArr = settings.data.split('&');
       if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
         var xml = xhr.responseXML;
         $response = $(xml).find('term_id').text();
         if($response!=""){
           // Clear the thumb image
           $('#category-image-wrapper').html('');
         }
       }
     });
   });
 </script>
 <?php }

  }
 
$NEWSMUNCH_POST_CAT_META = new NEWSMUNCH_POST_CAT_META();
$NEWSMUNCH_POST_CAT_META -> init();
 
}


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
    {
		$user = wp_get_current_user(); ?>
		<li class="list-inline-item"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><img src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ) ) ); ?>" width="32" height="32" class="author" alt="<?php esc_attr(the_author()); ?>"/><?php esc_html(the_author()); ?></a></li>
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
			//echo $posts_gallery = get_post_gallery( );
		 	// if (has_block('gallery', $post->post_content)) {
			  // //echo 'yes, there is a gallery';
			  // $post_blocks = parse_blocks($post->post_content);
			  // foreach ($post_blocks as $post_block){
				// if ($post_block['blockName'] == 'core/gallery'){
				  // //echo do_shortcode( $post_block['innerHTML'] );
				  // echo get_post_gallery( );
				// }
			  // }
			// }
				
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
			<blockquote>
			<?php
			the_excerpt();
			?>
			</blockquote>
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
						__( 'Read More', 'newsmunch-pro' ), 
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
			<li class="list-inline-item"><a href="<?php echo esc_url ( $twitter_link ); ?>"><i class="fab fa-twitter"></i></a></li>
			
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


// author profile data
function newsmunch_author_social_icons( $authoricons ) {
		$authoricons['facebook_profile'] = 'Facebook Profile URL';
		$authoricons['instagram_profile'] = 'Instagram Profile URL';
		$authoricons['linkedin_profile'] = 'Linkedin Profile URL';
		$authoricons['twitter_profile'] = 'Twitter Profile URL';
		$authoricons['youtube_profile'] = 'Youtube Profile URL';
		return $authoricons;
	}
add_filter( 'user_contactmethods', 'newsmunch_author_social_icons', 10, 1);	



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
			do_action('newsmunch_top_tags_option_before');
			
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
			do_action('newsmunch_top_tags_option_after');
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
		$newsmunch_post_pagination_lm_btn = get_next_posts_link( get_theme_mod('newsmunch_post_pagination_lm_btn', 'Load More') );
		if ( $newsmunch_post_pagination_type == 'button' ) :
			if ( !empty( $newsmunch_post_pagination_lm_btn ) ) : ?>
			<nav class="navigation pagination dt-text-center dt-load-more">
				<?php echo wp_kses_post( $newsmunch_post_pagination_lm_btn ); ?>
				<div class="dt-loader">
					<div class="uil-ripple-css"><div></div><div></div></div>									
				</div>
			</nav>
		<?php endif; elseif(  $newsmunch_post_pagination_type == 'infinite' ):	
			if ( !empty( $newsmunch_post_pagination_lm_btn ) ) : ?>
			<nav class="navigation pagination dt-text-center dt-infinite-scroll">
				<?php echo wp_kses_post( $newsmunch_post_pagination_lm_btn ); ?>
				<div class="dt-loader">
					<div class="uil-ripple-css"><div></div><div></div></div>
				</div>
			</nav>
		<?php endif; else: 
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
                        __('Edit <span class="screen-reader-text">%s</span>', 'newsmunch-pro'),
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
 * @since  1.0
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
