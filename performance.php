<?php
// k: performance tweaks
add_filter('wp_lazy_loading_enabled', '__return_true');
add_filter('wp_img_tag_add_loading_attr', '__return_true');
add_filter('wp_img_tag_add_srcset_and_sizes', '__return_true');
// k: defer inline
add_filter('script_loader_tag', function ($tag, $handle) {
  if (strpos($handle, 'kamar-') === 0) {
    return str_replace('<script', '<script defer', $tag);
  }
  return $tag;
}, 10, 2);