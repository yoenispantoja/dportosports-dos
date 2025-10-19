<?php
/**
 * NewsMunch functions and definitions
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package NewsMunch
 */
 
if ( ! function_exists( 'newsmunch_theme_setup' ) ) :
function newsmunch_theme_setup() {
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on NewsMunch, use a find and replace
	 * to change 'NewsMunch' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'newsmunch' );
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'custom-header' );
	
	add_theme_support( 'post-formats', array( 'gallery', 'quote', 'video', 'aside', 'image', 'link', 'audio', 'status', 'chat' ) );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary_menu' => esc_html__( 'Primary Menu', 'newsmunch' )
	) );
	
	//Add selective refresh for sidebar widget
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	// woocommerce support
	add_theme_support( 'woocommerce' );
	
	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support('custom-logo');
	
	/**
	 * Custom background support.
	 */
	add_theme_support( 'custom-background', apply_filters( 'newsmunch_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	/**
	 * Set default content width.
	 */
	if ( ! isset( $content_width ) ) {
		$content_width = 800;
	}	
}
endif;
add_action( 'after_setup_theme', 'newsmunch_theme_setup' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function newsmunch_widgets_init() {	
	if ( class_exists( 'WooCommerce' ) ) {
		register_sidebar( array(
			'name' => __( 'WooCommerce Widget Area', 'newsmunch' ),
			'id' => 'newsmunch-woocommerce-sidebar',
			'description' => __( 'This Widget area for WooCommerce Widget', 'newsmunch' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="widget-header"><h4 class="widget-title">',
			'after_title' => '</h4></div>',
		) );
	}
	
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'newsmunch' ),
		'id' => 'newsmunch-sidebar-primary',
		'description' => __( 'The Primary Widget Area', 'newsmunch' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-header"><h4 class="widget-title">',
		'after_title' => '</h4></div>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Left Sidebar Section', 'newsmunch'),
		'id'            => 'frontpage-left-sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-header"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Front page Content Section', 'newsmunch'),
		'id'            => 'frontpage-content',
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="widget-header"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Right Sidebar Section', 'newsmunch'),
		'id'            => 'frontpage-right-sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-header"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Menu Side Docker Widget Area', 'newsmunch'),
		'id'            => 'menu-side-docker-area',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-header"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );
	
	
	
	$newsmunch_footer_widget_column = get_theme_mod('newsmunch_footer_widget_column','4');
	for ($i=1; $i<=$newsmunch_footer_widget_column; $i++) {
		register_sidebar( array(
			'name' => __( 'Footer  ', 'newsmunch' )  . $i,
			'id' => 'newsmunch-footer-widget-' . $i,
			'description' => __( 'The Footer Widget Area', 'newsmunch' )  . $i,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="widget-header"><h4 class="widget-title">',
			'after_title' => '</h4></div>',
		) );
	}
}
add_action( 'widgets_init', 'newsmunch_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function newsmunch_scripts() {
	
	/**
	 * Styles.
	 */
	// Slick	
	wp_enqueue_style('slick',get_template_directory_uri().'/assets/vendors/css/slick.css');
	
	// Font Awesome
	wp_enqueue_style('all-css',get_template_directory_uri().'/assets/vendors/css/all.min.css');
	
	// Animate
	wp_enqueue_style('animate',get_template_directory_uri().'/assets/vendors/css/animate.min.css');
	
	// NewsMunch Core
	wp_enqueue_style('newsmunch-core',get_template_directory_uri().'/assets/css/core.css');

	// NewsMunch Theme
	wp_enqueue_style('newsmunch-theme', get_template_directory_uri() . '/assets/css/themes.css');
	
	// NewsMunch WooCommerce
	wp_enqueue_style('newsmunch-woocommerce',get_template_directory_uri().'/assets/css/woo-styles.css');
	
	// NewsMunch Dark
	wp_enqueue_style('newsmunch-dark',get_template_directory_uri().'/assets/css/dark.css');
	
	// NewsMunch Responsive
	wp_enqueue_style('newsmunch-responsive',get_template_directory_uri().'/assets/css/responsive.css');
	
	// NewsMunch Style
	wp_enqueue_style( 'newsmunch-style', get_stylesheet_uri() );
	
	// Scripts
	wp_enqueue_script( 'jquery' );
	
	// Masonry
	wp_enqueue_script( 'masonry' );
	
	// Owl Crousel
	wp_enqueue_script('slick', get_template_directory_uri() . '/assets/vendors/js/slick.min.js', array('jquery'), true);
	
	// Wow
	wp_enqueue_script('wow-min', get_template_directory_uri() . '/assets/vendors/js/wow.min.js', array('jquery'), false, true);
	
	// marquee
	wp_enqueue_script('marquee', get_template_directory_uri() . '/assets/vendors/js/jquery.marquee.js', array('jquery'), false, true);
	
	// NewsMunch Theme
	wp_enqueue_script('newsmunch-theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), false, true);

	// NewsMunch custom
	wp_enqueue_script('newsmunch-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), false, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'newsmunch_scripts' );


/**
 * Enqueue admin scripts and styles.
 */
function newsmunch_admin_enqueue_scripts(){
	wp_enqueue_style('newsmunch-admin-style', get_template_directory_uri() . '/inc/admin/assets/css/admin.css');
	wp_enqueue_script( 'newsmunch-admin-script', get_template_directory_uri() . '/inc/admin/assets/js/newsmunch-admin-script.js', array( 'jquery' ), '', true );
    wp_localize_script( 'newsmunch-admin-script', 'newsmunch_ajax_object',
        array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce('newsmunch_nonce')
        )
    );
}
add_action( 'admin_enqueue_scripts', 'newsmunch_admin_enqueue_scripts' );


/**
 * Enqueue User Custom styles.
 */
 if( ! function_exists( 'newsmunch_user_custom_style' ) ):
    function newsmunch_user_custom_style() {

		$newsmunch_print_style = '';
		
			
		 /*=========================================
		 NewsMunch Page Title
		=========================================*/
		 $newsmunch_print_style   .=  newsmunch_customizer_value( 'newsmunch_breadcrumb_title_size', '.page-header h1', array( 'font-size' ), array( 30, 30, 30 ), 'px' );
		  $newsmunch_print_style   .=  newsmunch_customizer_value( 'newsmunch_breadcrumb_content_size', '.page-header .breadcrumb li', array( 'font-size' ), array( 15, 15, 15 ), 'px' );
		
		
	
		 /*=========================================
		 NewsMunch Logo Size
		=========================================*/
		$newsmunch_print_style   .= newsmunch_customizer_value( 'hdr_logo_size', '.site--logo img', array( 'max-width' ), array( 150, 150, 150 ), 'px !important' );
		$newsmunch_print_style   .= newsmunch_customizer_value( 'hdr_site_title_size', '.site--logo .site--title', array( 'font-size' ), array( 55, 55, 55 ), 'px !important' );
		$newsmunch_print_style   .= newsmunch_customizer_value( 'hdr_site_desc_size', '.site--logo .site--description', array( 'font-size' ), array( 16, 16, 16 ), 'px !important' );
		
			
		$newsmunch_site_container_width 			 = get_theme_mod('newsmunch_site_container_width','2000');
			if($newsmunch_site_container_width >=768 && $newsmunch_site_container_width <=2000){
				$newsmunch_print_style .=".dt-container-md,.dt__slider-main .owl-dots {
						max-width: " .esc_attr($newsmunch_site_container_width). "px;
					}\n";
			}
		
					
		/**
		 *  Sidebar Width
		 */
		$newsmunch_sidebar_width = get_theme_mod('newsmunch_sidebar_width',33);
		if($newsmunch_sidebar_width !== '') { 
			$newsmunch_primary_width   = absint( 100 - $newsmunch_sidebar_width );
				$newsmunch_print_style .="	@media (min-width: 992px) {#dt-main {
					max-width:" .esc_attr($newsmunch_primary_width). "%;
					flex-basis:" .esc_attr($newsmunch_primary_width). "%;
				}\n";
				$newsmunch_print_style .="#dt-sidebar {
					max-width:" .esc_attr($newsmunch_sidebar_width). "%;
					flex-basis:" .esc_attr($newsmunch_sidebar_width). "%;
				}}\n";
        }
		$newsmunch_print_style   .= newsmunch_customizer_value( 'newsmunch_widget_ttl_size', '.widget-header .widget-title', array( 'font-size' ), array( 24, 24, 24 ), 'px !important' );
		
		/**
		 *  Typography Body
		 */
		 $newsmunch_body_font_weight_option	 	 = get_theme_mod('newsmunch_body_font_weight_option','inherit');
		 $newsmunch_body_text_transform_option	 = get_theme_mod('newsmunch_body_text_transform_option','inherit');
		 $newsmunch_body_font_style_option	 	 = get_theme_mod('newsmunch_body_font_style_option','inherit');
		 $newsmunch_body_txt_decoration_option	 = get_theme_mod('newsmunch_body_txt_decoration_option','none');
		
		 $newsmunch_print_style   .= newsmunch_customizer_value( 'newsmunch_body_font_size_option', 'body', array( 'font-size' ), array( 16, 16, 16 ), 'px' );
		 $newsmunch_print_style   .= newsmunch_customizer_value( 'newsmunch_body_line_height_option', 'body', array( 'line-height' ), array( 1.6, 1.6, 1.6 ) );
		 $newsmunch_print_style   .= newsmunch_customizer_value( 'newsmunch_body_ltr_space_option', 'body', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );	 
		
		/**
		 *  Typography Heading
		 */
		 for ( $i = 1; $i <= 6; $i++ ) {
			 $newsmunch_heading_font_weight_option	 	= get_theme_mod('newsmunch_h' . $i . '_font_weight_option','700');
			 $newsmunch_heading_text_transform_option 	= get_theme_mod('newsmunch_h' . $i . '_text_transform_option','inherit');
			 $newsmunch_heading_font_style_option	 	= get_theme_mod('newsmunch_h' . $i . '_font_style_option','inherit');
			 $newsmunch_heading_txt_decoration_option	= get_theme_mod('newsmunch_h' . $i . '_txt_decoration_option','inherit');
			 
			 $newsmunch_print_style   .= newsmunch_customizer_value( 'newsmunch_h' . $i . '_font_size_option', 'h' . $i .'', array( 'font-size' ), array( 36, 36, 36 ), 'px' );
			 $newsmunch_print_style   .= newsmunch_customizer_value( 'newsmunch_h' . $i . '_line_height_option', 'h' . $i . '', array( 'line-height' ), array( 1.2, 1.2, 1.2 ) );
			 $newsmunch_print_style   .= newsmunch_customizer_value( 'newsmunch_h' . $i . '_ltr_space_option', 'h' . $i . '', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );
		 }
		
		
		/*=========================================
		Post Format 
		// =========================================*/
		$newsmunch_hs_latest_post_format_icon			= get_theme_mod('newsmunch_hs_latest_post_format_icon','1');
		if($newsmunch_hs_latest_post_format_icon !=='1'):
			 $newsmunch_print_style .=".post .post-format, .post .post-format-sm{ 
				    display: none;
			}\n";
		endif;
		
        wp_add_inline_style( 'newsmunch-style', $newsmunch_print_style );
    }
endif;
add_action( 'wp_enqueue_scripts', 'newsmunch_user_custom_style' );


/**
 * Define Constants
 */
 
$newsmunch_theme = wp_get_theme();
define( 'NEWSMUNCH_THEME_VERSION', $newsmunch_theme->get( 'Version' ) );

// Root path/URI.
define( 'NEWSMUNCH_THEME_DIR', get_template_directory() );
define( 'NEWSMUNCH_THEME_URI', get_template_directory_uri() );

// Root path/URI.
define( 'NEWSMUNCH_THEME_INC_DIR', NEWSMUNCH_THEME_DIR . '/inc');
define( 'NEWSMUNCH_THEME_INC_URI', NEWSMUNCH_THEME_URI . '/inc');


/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
 require_once get_template_directory() . '/inc/customizer/newsmunch-customizer.php';
 require get_template_directory() . '/inc/customizer/controls/code/customizer-repeater/inc/customizer.php';
 
/**
 * Nav Walker for Bootstrap Dropdown Menu.
 */
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';


/**
 * Widget
 */
require( get_template_directory() . '/inc/widgets/widgets-init.php');

/**
 * Control Style
 */
require NEWSMUNCH_THEME_INC_DIR . '/customizer/controls/code/control-function/style-functions.php';

/**
 * Getting Started
 */
require NEWSMUNCH_THEME_INC_DIR . '/admin/getting-started.php';