<?php
add_action('after_setup_theme', 'kamar_setup');
function kamar_setup(){
  load_theme_textdomain('kamar', get_template_directory() . '/languages');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['search-form', 'comment-list', 'gallery', 'caption']);
  register_nav_menus([
    'primary' => __('القائمة الرئيسية', 'kamar'),
    'services' => __('قائمة الخدمات', 'kamar'),
    'tools'    => __('قائمة الأدوات', 'kamar'),
  ]);
}

// CPT: خدمات السيو
add_action('init', 'kamar_register_cpts');
function kamar_register_cpts(){
  register_post_type('seo_service', [
    'labels'      => ['name' => 'خدمات السيو', 'singular_name' => 'خدمة'],
    'public'      => true,
    'has_archive' => 'services',
    'rewrite'     => ['slug' => 'خدمة-سيو'],
    'supports'    => ['title', 'editor', 'thumbnail'],
    'show_in_rest'=> true,
  ]);
  register_taxonomy('service_cat', 'seo_service', [
    'label'        => 'تصنيفات الخدمات',
    'rewrite'      => ['slug' => 'تصنيف-الخدمة'],
    'hierarchical' => true,
    'show_in_rest' => true,
  ]);

  // CPT: أدوات سيو
  register_post_type('seo_tool', [
    'labels'      => ['name' => 'أدوات سيو', 'singular_name' => 'أداة'],
    'public'      => true,
    'has_archive' => 'tools',
    'rewrite'     => ['slug' => 'اداة-سيو'],
    'supports'    => ['title', 'editor', 'thumbnail'],
    'show_in_rest'=> true,
  ]);
  register_taxonomy('tool_cat', 'seo_tool', [
    'label'        => 'تصنيفات الأدوات',
    'rewrite'      => ['slug' => 'تصنيف-الاداة'],
    'hierarchical' => true,
    'show_in_rest' => true,
  ]);

  // CPT: باقات الأسعار
  register_post_type('pricing_pack', [
    'labels'      => ['name' => 'الباقات', 'singular_name' => 'باقة'],
    'public'      => true,
    'has_archive' => false,
    'rewrite'     => ['slug' => 'باقة'],
    'supports'    => ['title', 'editor', 'thumbnail'],
    'show_in_rest'=> true,
  ]);

  // CPT: FAQ
  register_post_type('faq', [
    'labels'      => ['name' => 'الأسئلة الشائعة', 'singular_name' => 'سؤال'],
    'public'      => true,
    'has_archive' => 'faq',
    'rewrite'     => ['slug' => 'سؤال'],
    'supports'    => ['title', 'editor'],
    'show_in_rest'=> true,
  ]);
  register_taxonomy('faq_cat', 'faq', [
    'label'        => 'تصنيفات الأسئلة',
    'hierarchical' => true,
    'show_in_rest' => true,
  ]);

  // CPT: شهادات
  register_post_type('testimonial', [
    'labels'      => ['name' => 'الشهادات', 'singular_name' => 'شهادة'],
    'public'      => true,
    'has_archive' => false,
    'rewrite'     => ['slug' => 'شهادة'],
    'supports'    => ['title', 'editor', 'thumbnail'],
    'show_in_rest'=> true,
  ]);

  // CPT: دراسات الحالة
  register_post_type('case_study', [
    'labels'      => ['name' => 'دراسات الحالة', 'singular_name' => 'دراسة حالة'],
    'public'      => true,
    'has_archive' => 'cases',
    'rewrite'     => ['slug' => 'دراسة-حالة'],
    'supports'    => ['title', 'editor', 'thumbnail', 'excerpt'],
    'show_in_rest'=> true,
  ]);
  register_taxonomy('case_cat', 'case_study', [
    'label'        => 'مجالات الدراسة',
    'hierarchical' => true,
    'show_in_rest' => true,
  ]);
}