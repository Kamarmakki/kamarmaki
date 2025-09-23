<?php
// k: lighthouse ci ≥ 95 mobile & desktop
get_header();
get_template_part('template-parts/sections/header');
get_template_part('template-parts/sections/breadcrumb');
?>
<div class="container mx-auto px-4 py-8 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
  <?php while (have_posts()) : the_post(); ?>
    <?php get_template_part('template-parts/cards/article', 'card'); ?>
  <?php endwhile; ?>
</div>
<?php
get_template_part('template-parts/sections/scroll-top');
get_footer();