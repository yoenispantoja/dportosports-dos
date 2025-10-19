<?php 
$newsmunch_hs_you_missed 		= get_theme_mod( 'newsmunch_hs_you_missed', '1');
if($newsmunch_hs_you_missed=='1' && !is_404()):
get_template_part('template-parts/section','you-missed'); 
endif;  
?>
</div></div>
<footer class="dt_footer footer-dark">
	<div class="dt-container-md">
		<?php 
			// Footer Widget
			do_action('newsmunch_footer_widget');
			
			// Footer Copyright
			do_action('newsmunch_footer_bottom'); 
		?>
	</div>
</footer>
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
do_action('newsmunch_top_scroller');
wp_footer(); ?>
</body>
</html>
