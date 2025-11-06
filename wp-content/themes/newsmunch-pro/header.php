<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php echo esc_url(get_bloginfo( 'pingback_url' )); ?>">
		<?php endif; ?>

		<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	 <div class="dt_readingbar-wrapper">
        <div class="dt_readingbar"></div>
    </div>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'newsmunch-pro' ); ?></a>

	<?php
		// Theme Header
		do_action('newsmunch_site_main_header');
		$newsmunch_frontpage_layout_head = array('top_tags_option','slider_option','hero_option','featured_link_option');
		foreach ( $newsmunch_frontpage_layout_head as $data_order ) :
			if ( 'top_tags_option' === $data_order ) :
				newsmunch_list_top_tags();
			elseif ( 'hero_option' === $data_order ) :
				do_action('newsmunch_site_front_main3');
			elseif ( 'slider_option' === $data_order ) :
				//do_action('newsmunch_site_front_main');
			elseif ( 'featured_link_option' === $data_order ) :
				//do_action('newsmunch_site_front_main2');
			endif; endforeach;
		// Theme Breadcrumb
		if ( !is_page_template( 'page-templates/frontpage.php' )) {
				get_template_part('/template-parts/prebuilt-sections/site','breadcrumb');
		}
	?>

	<div id="content" class="site-content site-wrapper">
