<?php
// k: lighthouse ci ≥ 95 mobile & desktop
get_header();
get_template_part('template-parts/sections/header');
get_template_part('template-parts/sections/breadcrumb');
?>
<div class="container mx-auto px-4 py-16 text-center">
  <h1 class="text-6xl font-bold mb-4">404</h1>
  <p class="text-xl mb-6"><?php _e('Page not found.', 'kamar'); ?></p>
  <a href="<?php echo home_url(); ?>" class="bg-primary-600 text-white px-6 py-3 rounded"><?php _e('Go home', 'kamar'); ?></a>
</div>
<?php
get_template_part('template-parts/sections/scroll-top');
get_footer();