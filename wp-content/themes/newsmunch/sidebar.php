<?php
/**
 * The sidebar containing the main widget area
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NewsMunch
 */
if ( ! is_active_sidebar( 'newsmunch-sidebar-primary' ) ) {	return; } ?>
<div id="dt-sidebar" class="dt-col-lg-4 sidebar-right">
	<div class="dt_sidebar is_sticky">
		<?php dynamic_sidebar('newsmunch-sidebar-primary'); ?>
	</div>
</div>