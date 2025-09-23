<?php
// k: lighthouse ci ≥ 95 mobile & desktop
/* Template Name: Home */
get_header();
get_template_part('template-parts/sections/header');
get_template_part('template-parts/sections/breadcrumb');
if (have_posts()) {
  while (have_posts()) {
    the_post();
    the_content(); // gutenberg blocks
  }
}
get_template_part('template-parts/sections/scroll-top');
get_footer();