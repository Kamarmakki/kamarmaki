<?php
// k: lighthouse ci ≥ 95 mobile & desktop
get_header();
get_template_part('template-parts/sections/header');
get_template_part('template-parts/sections/breadcrumb');
?>
<article class="container mx-auto px-4 py-8 max-w-3xl">
  <h1 class="text-4xl font-bold mb-4"><?php the_title(); ?></h1>
  <div class="prose">
    <?php
    while (have_posts()) {
      the_post();
      the_content();
    }
    ?>
  </div>
</article>
<?php
get_template_part('template-parts/sections/scroll-top');
get_footer();