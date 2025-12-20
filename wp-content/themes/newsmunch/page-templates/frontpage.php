<?php 
/**
Template Name: Frontpage
*/
get_header(); 
?>
<main id="content" class="content">
	<div class="dt-container-md">
		<div class="dt-row">
			<?php 
				get_template_part('sidebar','front-left');
				get_template_part('sidebar','front-content');
				get_template_part('sidebar','front-right'); 
			?>
		</div>
		<?php if( !is_customize_preview() && is_user_logged_in() ) : ?> <div class="page_edit_link"><?php newsmunch_edit_post_link(); ?></div> <?php endif; ?>
	</div>
</main>
<?php		
get_footer(); ?>