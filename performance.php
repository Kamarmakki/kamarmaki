<?php
// LazyLoad native
add_filter('wp_img_tag_add_loading_attr', '__return_true');

// Defer JS
add_filter('script_loader_tag', 'kamar_defer', 10, 2);
function kamar_defer($tag, $handle){
  if(strpos($handle, 'kamar') !== false || strpos($handle, 'tailwind') !== false){
    return str_replace(' src', ' defer src', $tag);
  }
  return $tag;
}

// DNS-Prefetch
add_action('wp_head', 'kamar_dns_prefetch');
function kamar_dns_prefetch(){
  echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">';
}

// Cache headers
add_action('send_headers', 'kamar_cache_control');
function kamar_cache_control(){
  if(is_user_logged_in()) return;
  header('Cache-Control: public, max-age=31536000');
}