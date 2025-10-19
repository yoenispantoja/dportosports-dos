<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package NewsMunch
 */
get_header();
?>
<div class="dt-container-md">
	<div class="dt-row">
		<?php if (  !is_active_sidebar( 'newsmunch-woocommerce-sidebar' ) ): ?>
			<div class="dt-col-lg-12 content-right">
		<?php else: ?>	
			<div id="dt-main" class="dt-col-lg-8 content-right">
		<?php endif; ?>	
			<?php woocommerce_content();  // WooCommerce Content ?>
		</div>
		<?php get_sidebar('woocommerce'); ?>
	</div>
</div>
<?php get_footer(); ?>

