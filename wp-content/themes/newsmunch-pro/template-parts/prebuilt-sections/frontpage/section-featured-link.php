<?php  
do_action('newsmunch_featured_link_option_before');
$newsmunch_featured_link_content_type			= get_theme_mod('newsmunch_featured_link_content_type','post');
if($newsmunch_featured_link_content_type=='post'):
get_template_part('template-parts/prebuilt-sections/frontpage/section','featured-link-post');	
else:
get_template_part('template-parts/prebuilt-sections/frontpage/section','featured-link-cat');	
endif;
do_action('newsmunch_featured_link_option_after');
