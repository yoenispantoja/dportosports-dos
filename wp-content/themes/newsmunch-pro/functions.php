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
	load_theme_textdomain( 'newsmunch-pro' );
	
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
		'primary_menu' => esc_html__( 'Primary Menu', 'newsmunch-pro' )
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
			'name' => __( 'WooCommerce Widget Area', 'newsmunch-pro' ),
			'id' => 'newsmunch-woocommerce-sidebar',
			'description' => __( 'This Widget area for WooCommerce Widget', 'newsmunch-pro' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<div class="widget-header"><h4 class="widget-title">',
			'after_title' => '</h4></div>',
		) );
	}
	
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'newsmunch-pro' ),
		'id' => 'newsmunch-sidebar-primary',
		'description' => __( 'The Primary Widget Area', 'newsmunch-pro' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-header"><h4 class="widget-title">',
		'after_title' => '</h4></div>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Left Sidebar Section', 'newsmunch-pro'),
		'id'            => 'frontpage-left-sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-header"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Front page Content Section', 'newsmunch-pro'),
		'id'            => 'frontpage-content',
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="widget-header"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Right Sidebar Section', 'newsmunch-pro'),
		'id'            => 'frontpage-right-sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-header"><h4 class="widget-title">',
		'after_title'   => '</h4></div>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Menu Side Docker Widget Area', 'newsmunch-pro'),
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
			'name' => __( 'Footer  ', 'newsmunch-pro' )  . $i,
			'id' => 'newsmunch-footer-widget-' . $i,
			'description' => __( 'The Footer Widget Area', 'newsmunch-pro' )  . $i,
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

	// Fancybox
	wp_enqueue_style('Fancybox',get_template_directory_uri().'/assets/vendors/css/jquery.fancybox.min.css');
	
	// sliderPro
	wp_enqueue_style('sliderPro',get_template_directory_uri().'/assets/vendors/css/slider-pro.min.css');
	
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
	
	// fancybox
	wp_enqueue_script('fancybox', get_template_directory_uri() . '/assets/vendors/js/jquery.fancybox.js', array('jquery'), false, true);
	
	// marquee
	wp_enqueue_script('marquee', get_template_directory_uri() . '/assets/vendors/js/jquery.marquee.js', array('jquery'), false, true);
	
	// sliderPro
	wp_enqueue_script('sliderPro', get_template_directory_uri() . '/assets/vendors/js/jquery.sliderPro.min.js', array('jquery'), false, true);
	
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
		
		/*=========================================
		NewsMunch Theme Color
		=========================================*/
		 $newsmunch_predefine_color 	= get_theme_mod('newsmunch_predefine_color','#1151D3');
		 $newsmunch_enable_custom_color= get_theme_mod('newsmunch_enable_custom_color');
		 $newsmunch_primary_color 		= get_theme_mod('newsmunch_primary_color','#1151D3');
		 $newsmunch_secondary_color 	= get_theme_mod('newsmunch_secondary_color','#121418');
		 list($color1, $color2, $color3) = sscanf($newsmunch_predefine_color, "#%02x%02x%02x");
		 list($color4, $color5, $color6) = sscanf($newsmunch_primary_color, "#%02x%02x%02x");
			if($newsmunch_enable_custom_color !== '1') {
				$newsmunch_print_style .=":root {
						--dt-main-rgb: $color1, $color2, $color3;
					}\n";
			}	
			
			if($newsmunch_enable_custom_color == '1') {
				$newsmunch_print_style .=":root {
						--dt-main-rgb: $color4, $color5, $color6;
						--dt-secondary-color: " .esc_attr($newsmunch_secondary_color). ";
					}\n";	
			}
			
		$newsmunch_site_container_width 			 = get_theme_mod('newsmunch_site_container_width','2000');
			if($newsmunch_site_container_width >=768 && $newsmunch_site_container_width <=2000){
				$newsmunch_print_style .=".dt-container-md,.dt__slider-main .owl-dots {
						max-width: " .esc_attr($newsmunch_site_container_width). "px;
					}\n";
			}
		
		$newsmunch_btn_border_radius 			 = get_theme_mod('newsmunch_btn_border_radius','0');
		$newsmunch_print_style .="button[type=submit], button, input[type='button'], input[type='reset'], input[type='submit'], .dt-btn, .button:not(.add_to_cart_button),.btn--effect-one .dt-btn {
						border-radius: " .esc_attr($newsmunch_btn_border_radius). "px;
					}\n";
					
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
		 $newsmunch_body_font_family_option		 = get_theme_mod('newsmunch_body_font_family_option','');
		 $newsmunch_body_font_weight_option	 	 = get_theme_mod('newsmunch_body_font_weight_option','inherit');
		 $newsmunch_body_text_transform_option	 = get_theme_mod('newsmunch_body_text_transform_option','inherit');
		 $newsmunch_body_font_style_option	 	 = get_theme_mod('newsmunch_body_font_style_option','inherit');
		 $newsmunch_body_txt_decoration_option	 = get_theme_mod('newsmunch_body_txt_decoration_option','none');
		
		 $newsmunch_print_style   .= newsmunch_customizer_value( 'newsmunch_body_font_size_option', 'body', array( 'font-size' ), array( 16, 16, 16 ), 'px' );
		 $newsmunch_print_style   .= newsmunch_customizer_value( 'newsmunch_body_line_height_option', 'body', array( 'line-height' ), array( 1.6, 1.6, 1.6 ) );
		 $newsmunch_print_style   .= newsmunch_customizer_value( 'newsmunch_body_ltr_space_option', 'body', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );
		 if($newsmunch_body_font_family_option !== '') { 
			if ( $newsmunch_body_font_family_option && ( strpos( $newsmunch_body_font_family_option, ',' ) != true ) ) {
				newsmunch_enqueue_google_font($newsmunch_body_font_family_option);
			}	
			 $newsmunch_print_style .=" body{ font-family: " .esc_attr($newsmunch_body_font_family_option). ";	}\n";
		 }
		 $newsmunch_print_style .=" body{ 
			font-weight: " .esc_attr($newsmunch_body_font_weight_option). ";
			text-transform: " .esc_attr($newsmunch_body_text_transform_option). ";
			font-style: " .esc_attr($newsmunch_body_font_style_option). ";
			text-decoration: " .esc_attr($newsmunch_body_txt_decoration_option). ";
		}\n";		 
		
		/**
		 *  Typography Heading
		 */
		 for ( $i = 1; $i <= 6; $i++ ) {
			 $newsmunch_heading_font_family_option	    = get_theme_mod('newsmunch_h' . $i . '_font_family_option','');	
			 $newsmunch_heading_font_weight_option	 	= get_theme_mod('newsmunch_h' . $i . '_font_weight_option','700');
			 $newsmunch_heading_text_transform_option 	= get_theme_mod('newsmunch_h' . $i . '_text_transform_option','inherit');
			 $newsmunch_heading_font_style_option	 	= get_theme_mod('newsmunch_h' . $i . '_font_style_option','inherit');
			 $newsmunch_heading_txt_decoration_option	= get_theme_mod('newsmunch_h' . $i . '_txt_decoration_option','inherit');
			 
			 $newsmunch_print_style   .= newsmunch_customizer_value( 'newsmunch_h' . $i . '_font_size_option', 'h' . $i .'', array( 'font-size' ), array( 36, 36, 36 ), 'px' );
			 $newsmunch_print_style   .= newsmunch_customizer_value( 'newsmunch_h' . $i . '_line_height_option', 'h' . $i . '', array( 'line-height' ), array( 1.2, 1.2, 1.2 ) );
			 $newsmunch_print_style   .= newsmunch_customizer_value( 'newsmunch_h' . $i . '_ltr_space_option', 'h' . $i . '', array( 'letter-spacing' ), array( 0, 0, 0 ), 'px' );
			  if($newsmunch_heading_font_family_option !== '') {
				  if ( $newsmunch_heading_font_family_option && ( strpos( $newsmunch_heading_font_family_option, ',' ) != true ) ) {
					newsmunch_enqueue_google_font($newsmunch_heading_font_family_option);
				  }
			  }	
			 $newsmunch_print_style .=" h" . $i . "{ 
				font-family: " .esc_attr($newsmunch_heading_font_family_option). ";
				font-weight: " .esc_attr($newsmunch_heading_font_weight_option). ";
				text-transform: " .esc_attr($newsmunch_heading_text_transform_option). ";
				font-style: " .esc_attr($newsmunch_heading_font_style_option). ";
				text-decoration: " .esc_attr($newsmunch_heading_txt_decoration_option). ";
			}\n";
		 }
		
		
		/*=========================================
		Post Format 
		=========================================*/
		// $newsmunch_hs_latest_post_format_icon			= get_theme_mod('newsmunch_hs_latest_post_format_icon','1');
		// if($newsmunch_hs_latest_post_format_icon !=='1'):
			 // $newsmunch_print_style .=".post .post-format, .post .post-format-sm{ 
				    // display: none;
			// }\n";
		// endif;
		
		/*=========================================
		Mainfeatured Section
		=========================================*/
		// $newsmunch_slider_bg_img			= get_theme_mod('newsmunch_slider_bg_img');
		// if(!empty($newsmunch_slider_bg_img)):
			 // $newsmunch_print_style .=".mainfeatured_section {
				// background-repeat: no-repeat;
				// background-size: cover;
				// background-position: center;
				// padding-bottom: 30px;
				// padding-top: 30px;
				// background-color: rgba(18,16,38,0.6);
				// background-blend-mode: overlay;
				// z-index: 0;
			// }
			// .mainfeatured_section .post-tabs {
				// background-color: #fff;
			// }\n";
		// endif;
		
		/*=========================================
		Footer 
		=========================================*/
		$newsmunch_footer_style			= get_theme_mod('newsmunch_footer_style','footer-dark');
		$newsmunch_footer_text_color	= get_theme_mod('newsmunch_footer_text_color','#5c6777');
		$newsmunch_footer_bg_color		= get_theme_mod('newsmunch_footer_bg_color','#121418');
		if($newsmunch_footer_style=='footer-dark'):
			 $newsmunch_print_style .=".footer-dark{ 
					--dt-text-color:  ".esc_attr($newsmunch_footer_text_color).";
				    background-color: ".esc_attr($newsmunch_footer_bg_color).";
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
require_once get_template_directory() . '/inc/hooks.php';

/**
 * Customizer additions.
 */
 require_once get_template_directory() . '/inc/customizer/newsmunch-customizer.php';
 require get_template_directory() . '/inc/customizer/controls/code/customizer-repeater/inc/customizer.php';
 require get_template_directory() . '/inc/customizer/customizer-repeater-default.php';
 
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
 * Load Theme Updator File.
 */
function newsmunch_theme_updater() {
	require( get_template_directory() . '/inc/licence-activation/theme-updater.php' );
}
add_action( 'after_setup_theme', 'newsmunch_theme_updater' );

/**
 * Called Required Plugin Features
 */
require( get_template_directory() . '/inc/required-plugin/index.php');

/**
 * Translation
 */
require( get_template_directory() . '/inc//pll-functions.php');


/**
 * Import Options From Parent Theme
 *
 */
function newsmunch_parent_theme_options() {
	$newsmunch_mods = get_option( 'theme_mods_newsmunch' );
	if ( ! empty( $newsmunch_mods ) ) {
		foreach ( $newsmunch_mods as $newsmunch_mod_k => $newsmunch_mod_v ) {
			set_theme_mod( $newsmunch_mod_k, $newsmunch_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'newsmunch_parent_theme_options' );





/*removing default submit tag*/
remove_action('wpcf7_init', 'wpcf7_add_form_tag_submit');
/*adding action with function which handles our button markup*/
add_action('wpcf7_init', 'newsmunch_cf7_button');
/*adding out submit button tag*/
if (!function_exists('newsmunch_cf7_button')) {
	function newsmunch_cf7_button() {
		wpcf7_add_form_tag('submit', 'newsmunch_cf7_button_handler');
	}
}
/*out button markup inside handler*/
if (!function_exists('newsmunch_cf7_button_handler')) {
	function newsmunch_cf7_button_handler($tag) {
		$tag = new WPCF7_FormTag($tag);
		$class = wpcf7_form_controls_class($tag->type);
		$atts = array();
		//$atts['class'] = $tag->get_class_option($class);
		//$atts['class'] .= ' newsmunch-custom-btn';
		//$atts['id'] = $tag->get_id_option();
		//$atts['tabindex'] = $tag->get_option('tabindex', 'int', true);
		$value = isset($tag->values[0]) ? $tag->values[0] : '';
		if (empty($value)) {
			$value = esc_html__('Send', 'newsmunch-pro');
		}
		$atts['type'] = 'submit';
		$atts = wpcf7_format_atts($atts);
		$html = sprintf('<button class="dt-btn dt-btn-primary" data-title="%2$s">%2$s</button>', $atts, $value);
		return $html;
	}
}