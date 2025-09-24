<?php
/**
 * Kamar Hkombat SEO functions
 */

// 1. Basic setup (menus, thumbnails, CPTs, tax)
require get_template_directory() . '/inc/setup.php';

// 2. CSS/JS enqueue + defer + preload
require get_template_directory() . '/inc/enqueue.php';

// 3. SEO head (JSON-LD, hreflang, meta)
require get_template_directory() . '/inc/seo.php';

// 4. Performance tweaks (lazy, minify, cache-headers)
require get_template_directory() . '/inc/performance.php';

// 5. Gutenberg blocks (ACF)
if( class_exists('ACF') ){
  require get_template_directory() . '/inc/custom-gutenberg.php';
}