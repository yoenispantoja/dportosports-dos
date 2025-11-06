<?php 
/**
Template Name: Contact Page
*/

get_header();
?>
<div class="dt-container-md">
<?php
// Contact Info Section
$newsmunch_pg_contact_hs_options		= get_theme_mod('newsmunch_pg_contact_hs_options','1');  
if($newsmunch_pg_contact_hs_options=='1'): 
get_template_part('template-parts/prebuilt-sections/frontpage/section','contact-info');
endif;

// Contact Form Section
$newsmunch_pg_contact_form_hs_options		= get_theme_mod('newsmunch_pg_contact_form_hs_options','1'); 
if($newsmunch_pg_contact_form_hs_options=='1'): 
get_template_part('template-parts/prebuilt-sections/frontpage/section','contact-form');	
endif;

// Contact Map Section
$newsmunch_pg_contact_map_hs_options		= get_theme_mod('newsmunch_pg_contact_map_hs_options','1'); 
if($newsmunch_pg_contact_map_hs_options=='1'): 
get_template_part('template-parts/prebuilt-sections/frontpage/section','contact-map');	
endif;
?>
</div>
<?php get_footer(); ?>