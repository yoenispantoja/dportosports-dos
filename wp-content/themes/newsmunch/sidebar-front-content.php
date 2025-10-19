<?php
if ( ! is_active_sidebar( 'frontpage-content' ) ) {
	return;
}
$is_rt_active = is_active_sidebar('frontpage-left-sidebar');
$is_lt_active = is_active_sidebar('frontpage-right-sidebar');
$class='';
if($is_lt_active && $is_rt_active) { 
	$class= 'dt-col-lg-6'; 
}elseif(!$is_rt_active && !$is_lt_active) { 
	$class= 'dt-col-lg-12'; 
}elseif((!$is_rt_active && $is_lt_active) || ($is_rt_active && !$is_lt_active)) {
	$class= 'dt-col-lg-9'; 
}
?>
<div class="<?php echo esc_attr($class); ?>">
	<?php dynamic_sidebar( 'frontpage-content' ); ?>
</div>