<?php
// k: lighthouse ci ≥ 95 mobile & desktop
/* Template Name: Contact */
get_header();
get_template_part('template-parts/sections/header');
get_template_part('template-parts/sections/breadcrumb');
?>
<div class="container mx-auto px-4 py-8 max-w-2xl">
  <h1 class="text-3xl font-bold mb-6"><?php the_title(); ?></h1>
  <div class="prose">
    <?php
    while (have_posts()) {
      the_post();
      the_content();
    }
    ?>
  </div>
</div>
<?php
get_template_part('template-parts/sections/scroll-top');
get_footer();