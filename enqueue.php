<?php
// k: enqueue assets
add_action('wp_enqueue_scripts', function () {
  // css
  wp_enqueue_style('kamar-tailwind', get_theme_file_uri('assets/css/tailwind.min.css'), [], '1.0.0');
  wp_enqueue_style('kamar-custom', get_theme_file_uri('assets/css/custom.css'), ['kamar-tailwind'], '1.0.0');
  // js
  wp_enqueue_script('kamar-app', get_theme_file_uri('assets/js/app.js'), [], '1.0.0', true);
  wp_add_inline_script('kamar-app', 'if("serviceWorker" in navigator){navigator.serviceWorker.register("' . get_theme_file_uri('assets/js/sw.js') . '");}', 'before');
  // analytics
  wp_enqueue_script('kamar-analytics', get_theme_file_uri('assets/js/analytics.js'), [], '1.0.0', false);
  // preload & dns-prefetch
  add_action('wp_head', function () {
    echo '<link rel="preload" href="' . esc_url(get_theme_file_uri('assets/fonts/cairo-subset.woff2')) . '" as="font" type="font/woff2" crossorigin>';
    echo '<link rel="dns-prefetch" href="//www.googletagmanager.com">';
  }, 1);
});