<?php 
if ( ! is_active_sidebar( 'frontpage-right-sidebar' ) ) {	return; } 
if ( is_active_sidebar( 'frontpage-content' ) ) { ?>
<div class="dt-col-lg-3 sidebar-area">
	<div class="dt_sidebar is_sticky">
		<?php dynamic_sidebar('frontpage-right-sidebar'); ?>
	</div>
</div>
<?php }else{ ?>
<div class="dt-col-lg-6 sidebar-area">
	<div class="dt_sidebar is_sticky">
		<?php dynamic_sidebar('frontpage-right-sidebar'); ?>
	</div>
</div>
<?php } ?>