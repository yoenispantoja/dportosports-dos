<?php 
$newsmunch_hs_you_missed 		= get_theme_mod( 'newsmunch_hs_you_missed', '1');
if($newsmunch_hs_you_missed=='1' && !is_404()):
get_template_part('template-parts/prebuilt-sections/frontpage/section','you-missed'); 
endif; 

// $newsmunch_hs_gallery 		= get_theme_mod( 'newsmunch_hs_gallery', '1');
// if($newsmunch_hs_gallery=='1'):
// get_template_part('template-parts/prebuilt-sections/frontpage/section','gallery'); 
// endif; 
?>
</div></div>
<?php $newsmunch_footer_style			= get_theme_mod('newsmunch_footer_style','footer-dark'); ?>
<footer class="dt_footer <?php echo esc_attr($newsmunch_footer_style); ?>">
	<div class="dt-container-md">
		<?php 
			// Footer Widget
			do_action('newsmunch_footer_widget');
			
			// Footer Copyright
			do_action('newsmunch_footer_bottom'); 
		?>
	</div>
</footer>
<?php
$newsmunch_hs_background_animate_option = get_theme_mod('newsmunch_hs_background_animate_option', '0');
if ($newsmunch_hs_background_animate_option == '1') :
?>
<div class="background-wrapper">
	<div class="squares">
		<span class="square"></span>
		<span class="square"></span>
		<span class="square"></span>
		<span class="square"></span>
		<span class="square"></span>
	</div>
	<div class="circles">
		<span class="circle"></span>
		<span class="circle"></span>
		<span class="circle"></span>
		<span class="circle"></span>
		<span class="circle"></span>
	</div>
	<div class="triangles">
		<span class="triangle"></span>
		<span class="triangle"></span>
		<span class="triangle"></span>
		<span class="triangle"></span>
		<span class="triangle"></span>
	</div>
</div>
<?php

endif;

do_action('newsmunch_top_scroller');
do_action('newsmunch_style_switcher');
wp_footer(); ?>
</body>
</html>
