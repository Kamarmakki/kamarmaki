<?php
add_action('wp_enqueue_scripts', 'kamar_assets');
function kamar_assets(){
  // Tailwind CSS
  wp_enqueue_style('tailwind', get_template_directory_uri() . '/assets/css/tailwind.min.css', [], '3.4.0');

  // Custom style
  wp_enqueue_style('kamar-style', get_template_directory_uri() . '/assets/css/custom.css', ['tailwind'], '1.0.0');

  // Defer JS
  wp_register_script('kamar-app', get_template_directory_uri() . '/assets/js/app.js', [], '1.0.0', true);
  wp_script_add_data('kamar-app', 'defer', true);
  wp_enqueue_script('kamar-app');

  // Preload critical fonts
  add_action('wp_head', function(){
    echo '<link rel="preload" href="' . esc_url(get_template_directory_uri() . '/assets/fonts/Cairo-Regular.woff2') . '" as="font" type="font/woff2" crossorigin>';
  });
}