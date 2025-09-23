<?php
// k: theme setup
add_action('after_setup_theme', function () {
  load_theme_textdomain('kamar', get_template_directory() . '/languages');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
  register_nav_menus([
    'primary' => __('Primary Menu', 'kamar')
  ]);
});

// k: register CPTs & taxonomies
add_action('init', function () {
  // services
  register_post_type('service', [
    'labels'      => ['name' => __('Services', 'kamar'), 'singular_name' => __('Service', 'kamar')],
    'public'      => true,
    'has_archive' => true,
    'supports'    => ['title', 'editor', 'thumbnail'],
    'rewrite'     => ['slug' => 'service'],
    'show_in_rest'=> true
  ]);
  register_taxonomy('service-category', 'service', [
    'labels' => ['name' => __('Service Categories', 'kamar')],
    'hierarchical' => true,
    'show_in_rest' => true
  ]);
  // tools
  register_post_type('tool', [
    'labels'      => ['name' => __('Tools', 'kamar'), 'singular_name' => __('Tool', 'kamar')],
    'public'      => true,
    'has_archive' => true,
    'supports'    => ['title', 'editor', 'thumbnail'],
    'rewrite'     => ['slug' => 'tool'],
    'show_in_rest'=> true
  ]);
  register_taxonomy('tool-category', 'tool', [
    'labels' => ['name' => __('Tool Categories', 'kamar')],
    'hierarchical' => true,
    'show_in_rest' => true
  ]);
  // packages
  register_post_type('package', [
    'labels'      => ['name' => __('Packages', 'kamar'), 'singular_name' => __('Package', 'kamar')],
    'public'      => true,
    'has_archive' => false,
    'supports'    => ['title'],
    'show_in_rest'=> true
  ]);
});