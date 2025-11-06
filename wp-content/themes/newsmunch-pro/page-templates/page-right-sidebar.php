<?php
/**
Template Name:  Right Sidebar Page
**/

get_header();
?>
<div class="dt-container-md">
	<div class="dt-row dt-g-5">
		<div id="dt-main" class="dt-col-lg-8 dt-col-md-8 dt-col-12">
			<?php 		
				the_post(); the_content(); 
				
				if( $post->comment_status == 'open' ) { 
					 comments_template( '', true ); // show comments 
				}
			?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>

