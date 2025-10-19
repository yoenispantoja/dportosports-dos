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
		  printf( esc_html__( '%1$s %2$s', 'newsmunch' ), esc_html__('Archives','newsmunch'), get_the_date() );  
        elseif ( is_month() ) :
		/* translators: %1$s %2$s: month */	
		  printf( esc_html__( '%1$s %2$s', 'newsmunch' ), esc_html__('Archives','newsmunch'), get_the_date( 'F Y' ) );
        elseif ( is_year() ) :
		/* translators: %1$s %2$s: year */	
		  printf( esc_html__( '%1$s %2$s', 'newsmunch' ), esc_html__('Archives','newsmunch'), get_the_date( 'Y' ) );
		elseif( is_author() ):
		/* translators: %1$s %2$s: author */	
			printf( esc_html__( '%1$s %2$s', 'newsmunch' ), esc_html__('All posts by','newsmunch'), esc_html(get_the_author()) );
        elseif( is_category() ):
		/* translators: %1$s %2$s: category */	
			printf( esc_html__( '%1$s %2$s', 'newsmunch' ), esc_html__('Category','newsmunch'), single_cat_title( '', false ) );
		elseif( is_tag() ):
		/* translators: %1$s %2$s: tag */	
			printf( esc_html__( '%1$s %2$s', 'newsmunch' ), esc_html__('Tag','newsmunch'), single_tag_title( '', false ) );
		elseif( class_exists( 'WooCommerce' ) && is_shop() ):
		/* translators: %1$s %2$s: WooCommerce */	
			printf( esc_html__( '%1$s %2$s', 'newsmunch' ), esc_html__('Shop','newsmunch'), single_tag_title( '', false ));
        elseif( is_archive() ): 
		the_archive_title( '<h1>', '</h1>' ); 
		endif;
		echo '</h1>';
	}
	elseif( is_404() )
	{
		echo '<h1>';
		/* translators: %1$s: 404 */	
		printf( esc_html__( '%1$s ', 'newsmunch' ) , esc_html__('404','newsmunch') );
		echo '</h1>';
	}
	elseif( is_search() )
	{
		echo '<h1>';
		/* translators: %1$s %2$s: search */
		printf( esc_html__( '%1$s %2$s', 'newsmunch' ), esc_html__('Search results for','newsmunch'), get_search_query() );
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
				echo '<li class="breadcrumb-item"><a href="'.$homeLink.'">'.__('Home','newsmunch').'</a></li>';
	            echo '<li class="breadcrumb-item active">'; echo single_post_title(); echo '</li>';
			else:
				echo '<li class="breadcrumb-item"><a href="'.$homeLink.'">'.__('Home','newsmunch').'</a></li>';
				if ( is_category() ) {
				    echo '<li class="breadcrumb-item active"><a href="'. newsmunch_page_url() .'">' . __('Archive by category','newsmunch').' "' . single_cat_title('', false) . '"</a></li>';
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
						echo '<li class="breadcrumb-item active"><a href="' . newsmunch_page_url() . '">'.__('Error 404','newsmunch').'</a></li>';
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
	$newsmunch_show_post_btn	= get_theme_mod('newsmunch_show_post_btn'); 
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
	
	$newsmunch_dark_mode=get_theme_mod('newsmunch_dark_mode');
	if($newsmunch_dark_mode == 'dark'){
		$classes[]='dark'; 
	}
	
	$newsmunch_hs_hdr_sticky	=	get_theme_mod('newsmunch_hs_hdr_sticky','1');
	if($newsmunch_hs_hdr_sticky == "1"){
		$classes[]='sticky-header'; 
	}
	
	$sticky_sidebar_hs	=	get_theme_mod('sticky_sidebar_hs','1');	
	if($sticky_sidebar_hs == "1"){
		$classes[]='sticky-sidebar'; 
	}
	
	$classes[]='btn--effect-one'; 

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
	 * Backward compatibility for wp_body_open hook.=
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
	get_template_part('template-parts/site','header');
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
	$newsmunch_hs_hdr_left_text = get_theme_mod( 'newsmunch_hs_hdr_left_text','1'); 
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
	$newsmunch_hdr_date_display = get_theme_mod( 'newsmunch_hdr_date_display','theme');
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
$newsmunch_hs_hdr 			= get_theme_mod( 'newsmunch_hs_hdr','1');
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
	$newsmunch_hdr_btn_link 	= get_theme_mod( 'newsmunch_hdr_btn_link','#'); 
	$newsmunch_hdr_btn_target 	= get_theme_mod( 'newsmunch_hdr_btn_target');
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
		<form method="get" class="dt_search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'search again', 'newsmunch' ); ?>">
			<label for="dt_search-form-1">
				 <?php if($newsmunch_search_result=='product' && class_exists('WooCommerce')):	?>
					<input type="hidden" name="post_type" value="product" />
				 <?php endif; ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'newsmunch' ); ?></span>
				<input type="search" id="dt_search-form-1" class="dt_search-field" placeholder="<?php esc_attr_e( 'search Here', 'newsmunch' ); ?>" value="" name="s" />
			</label>
			<button type="submit" class="dt_search-submit search-submit"><i class="fas fa-search" aria-hidden="true"></i></button>
		</form>
		<?php
		$posttags = get_tags();
		if($posttags):
		?>
		<div class="categories">
			<h5><?php esc_html_e( 'Or check our Popular Categories...', 'newsmunch' ); ?></h5>
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
					<strong class="cart_count"><?php  esc_html_e('0','newsmunch'); ?></strong>
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
				<strong class="cart_count"><?php esc_html_e('0','newsmunch'); ?></strong>
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
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
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

add_filter( 'woocommerce_show_admin_notice', function ( $show, $notice ) {
    if ( 'template_files' === $notice ) {
        return false;
    }

    return $show;
}, 10, 2 );