<?php
// k: theme header
$lang = get_locale();
?>
<!doctype html>
<html <?php language_attributes(); ?> dir="<?php echo $lang === 'ar' ? 'rtl' : 'ltr'; ?>">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class('font-sans bg-white text-gray-900'); ?>>
<header class="sticky top-0 bg-white shadow z-50">
  <div class="container mx-auto px-4 flex items-center justify-between h-16">
    <a href="<?php echo home_url(); ?>" aria-label="<?php bloginfo('name'); ?>">
      <img src="<?php echo esc_url(get_theme_file_uri('assets/img/logo.svg')); ?>" alt="<?php bloginfo('name'); ?>" class="h-8">
    </a>
    <nav class="hidden md:flex space-x-4">
      <?php
      wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'flex space-x-4',
        'fallback_cb'    => false
      ]);
      ?>
    </nav>
    <button id="nav-toggle" class="md:hidden" aria-label="<?php _e('Menu', 'kamar'); ?>">
      <svg class="w-6 h-6"><use href="#icon-menu"></use></svg>
    </button>
  </div>
  <div id="mobile-nav" class="hidden md:hidden bg-white border-t">
    <?php
    wp_nav_menu([
      'theme_location' => 'primary',
      'container'      => false,
      'menu_class'     => 'px-4 py-2 space-y-2'
    ]);
    ?>
  </div>
</header>