<?php
// k: breadcrumb
if (is_front_page()) return;
echo '<nav class="container mx-auto px-4 py-4 text-sm" aria-label="' . esc_attr__('Breadcrumb', 'kamar') . '">';
echo '<a href="' . home_url() . '">' . __('Home', 'kamar') . '</a>';
if (is_single() || is_page()) {
  echo ' / <span>' . get_the_title() . '</span>';
}
echo '</nav>';