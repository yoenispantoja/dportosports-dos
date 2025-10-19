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
<body <?php body_class('newsalert dt-section--title-five'); ?>>
<?php wp_body_open(); ?>
	 <div class="dt_readingbar-wrapper">
        <div class="dt_readingbar"></div>
    </div>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'newsalert' ); ?></a>
	
	<?php 
		// Theme Header
		do_action('newsmunch_site_main_header');
		newsmunch_list_top_tags();
		do_action('newsmunch_site_front_main');
		do_action('newsmunch_site_front_main2'); 		
		// Theme Breadcrumb
		if ( !is_page_template( 'page-templates/frontpage.php' )) {
				get_template_part('/template-parts/site','breadcrumb');
		}
	?>
	
	<div id="content" class="site-content site-wrapper">