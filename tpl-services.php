<?php
// k: lighthouse ci ≥ 95 mobile & desktop
/* Template Name: Services */
get_header();
get_template_part('template-parts/sections/header');
get_template_part('template-parts/sections/breadcrumb');
echo '<div class="container mx-auto px-4 py-8 grid md:grid-cols-2 lg:grid-cols-4 gap-6">';
while (have_posts()) {
  the_post();
  get_template_part('template-parts/cards/service', 'card', ['id' => get_the_ID()]);
}
echo '</div>';
get_template_part('template-parts/sections/scroll-top');
get_footer();