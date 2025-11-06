<?php 
/**
Template Name: About Page
*/

get_header();
?>
<div class="dt-container-md">
<?php
// About Section
$newsmunch_pg_about_hs_options		= get_theme_mod('newsmunch_pg_about_hs_options','1');  
if($newsmunch_pg_about_hs_options=='1'): 
get_template_part('template-parts/prebuilt-sections/frontpage/section','about');
endif;

// Skill Section
$newsmunch_pg_about_skill_hs_options		= get_theme_mod('newsmunch_pg_about_skill_hs_options','1'); 
if($newsmunch_pg_about_skill_hs_options=='1'): 
get_template_part('template-parts/prebuilt-sections/frontpage/section','skill');	
endif;

// Team Section
$newsmunch_pg_about_team_hs_options		= get_theme_mod('newsmunch_pg_about_team_hs_options','1'); 
if($newsmunch_pg_about_team_hs_options=='1'): 
get_template_part('template-parts/prebuilt-sections/frontpage/section','team');
endif;

// FAQ Section
$newsmunch_pg_about_faq_hs_options		= get_theme_mod('newsmunch_pg_about_faq_hs_options','1'); 
if($newsmunch_pg_about_faq_hs_options=='1'): 
get_template_part('template-parts/prebuilt-sections/frontpage/section','faq');
endif;
?>
</div>
<?php get_footer(); ?>