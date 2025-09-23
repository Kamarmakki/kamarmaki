<?php
// k: seo hooks
add_action('wp_head', function () {
  // json-ld
  $data = [
    '@context' => 'https://schema.org',
    '@type'    => 'WebSite',
    'name'     => get_bloginfo('name'),
    'url'      => home_url()
  ];
  echo '<script type="application/ld+json">' . wp_json_encode($data) . '</script>';
  // og
  echo '<meta property="og:locale" content="' . esc_attr(get_locale()) . '">';
  echo '<meta property="og:type" content="website">';
  echo '<meta property="og:title" content="' . esc_attr(wp_get_document_title()) . '">';
  echo '<meta property="og:url" content="' . esc_url(home_url($_SERVER['REQUEST_URI'])) . '">';
  echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">';
  // hreflang
  $langs = ['en', 'ar'];
  foreach ($langs as $l) {
    echo '<link rel="alternate" hreflang="' . esc_attr($l) . '" href="' . esc_url(home_url($l === 'en' ? '/' : '/ar/')) . '">';
  }
}, 5);