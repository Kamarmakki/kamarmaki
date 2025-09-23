<?php
// k: lighthouse ci ≥ 95 mobile & desktop
/* Template Name: Pricing */
get_header();
get_template_part('template-parts/sections/header');
get_template_part('template-parts/sections/breadcrumb');
echo '<div class="container mx-auto px-4 py-8 grid md:grid-cols-3 gap-6">';
while (have_posts()) {
  the_post();
  $title = get_the_title();
  $price = get_field('package_price', get_the_ID());
  $features = get_field('package_features', get_the_ID());
  echo '<div class="border rounded p-6 text-center">';
  echo '<h3 class="text-xl font-semibold mb-2">' . esc_html($title) . '</h3>';
  echo '<p class="text-3xl font-bold mb-4">' . esc_html($price) . '</p>';
  echo '<ul class="text-left space-y-2 mb-6">';
  foreach ($features as $f) {
    echo '<li>' . esc_html($f) . '</li>';
  }
  echo '</ul>';
  echo '<button class="bg-primary-600 text-white px-4 py-2 rounded">' . __('Choose', 'kamar') . '</button>';
  echo '</div>';
}
echo '</div>';
get_template_part('template-parts/sections/scroll-top');
get_footer();