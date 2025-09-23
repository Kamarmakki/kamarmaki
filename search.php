<?php
// k: lighthouse ci ≥ 95 mobile & desktop
get_header();
get_template_part('template-parts/sections/header');
get_template_part('template-parts/sections/breadcrumb');
?>
<div class="container mx-auto px-4 py-8">
  <h1 class="text-3xl font-bold mb-6"><?php printf(__('Search results for: %s', 'kamar'), get_search_query()); ?></h1>
  <?php if (have_posts()) : ?>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('template-parts/cards/article', 'card'); ?>
      <?php endwhile; ?>
    </div>
  <?php else : ?>
    <p><?php _e('No results found.', 'kamar'); ?></p>
  <?php endif; ?>
</div>
<?php
get_template_part('template-parts/sections/scroll-top');
get_footer();