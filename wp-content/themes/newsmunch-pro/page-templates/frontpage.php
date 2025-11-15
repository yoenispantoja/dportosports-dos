<?php

/**
Template Name: Frontpage
 */

get_header();

$newsmunch_frontpage_layout     = get_theme_mod('newsmunch_frontpage_layout', array('editor_option', 'sponsor_option', 'trending_option', 'inspiration_option', 'latest_post_option'));
$newsmunch_front_pg_sidebar_option = get_theme_mod('newsmunch_front_pg_sidebar_option', 'right_sidebar');
?>
<main id="content" class="content">
  <div class="dt-container-md">
    <div class="dt-row">
      <?php
      /* get_template_part('sidebar','front-left'); */
      if (is_active_sidebar('frontpage-right-sidebar')) {
        include locate_template('sidebar-front-right.php');
      }
      if (is_active_sidebar('frontpage-content')) {
        include locate_template('sidebar-front-content.php');
      }
      ?>
    </div>
    <?php
    $newsmunch_frontpage_layout_footer     = get_theme_mod('newsmunch_frontpage_layout_footer');
    if (!empty($newsmunch_frontpage_layout_footer)):
      foreach ($newsmunch_frontpage_layout_footer as $data_order) :
        if ('about_option' === $data_order) :
          get_template_part('template-parts/prebuilt-sections/frontpage/section', 'about');

        elseif ('skill_option' === $data_order) :
          get_template_part('template-parts/prebuilt-sections/frontpage/section', 'skill');

        elseif ('team_option' === $data_order) :
          get_template_part('template-parts/prebuilt-sections/frontpage/section', 'team');

        elseif ('faq_option' === $data_order) :
          get_template_part('template-parts/prebuilt-sections/frontpage/section', 'faq');

        elseif ('contact_info_option' === $data_order) :
          get_template_part('template-parts/prebuilt-sections/frontpage/section', 'contact-info');

        elseif ('contact_form_option' === $data_order) :
          get_template_part('template-parts/prebuilt-sections/frontpage/section', 'contact-form');

        elseif ('contact_map_option' === $data_order) :
          get_template_part('template-parts/prebuilt-sections/frontpage/section', 'contact-map');

        endif;
      endforeach;
    endif;
    ?>
    <?php if (!is_customize_preview() && is_user_logged_in()) : ?> <div class="page_edit_link"><?php newsmunch_edit_post_link(); ?></div> <?php endif; ?>
  </div>
</main>
<?php
get_footer(); ?>
