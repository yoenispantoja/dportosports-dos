<?php 
/**
 * The sidebar containing the woocommerce widget area
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NewsMunch
 */
if ( ! is_active_sidebar( 'newsmunch-woocommerce-sidebar' ) ) {	return; } ?>
<div id="dt-sidebar" class="dt-col-lg-4 sidebar-right">
	<div class="dt_sidebar is_sticky">
		<?php dynamic_sidebar('newsmunch-woocommerce-sidebar'); ?>
	</div>
</div>