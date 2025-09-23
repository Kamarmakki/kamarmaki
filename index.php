<?php
// k: fallback only
get_header();
get_template_part('template-parts/sections/header');
get_template_part('template-parts/sections/breadcrumb');
?>
<div class="container mx-auto px-4 py-8">
  <?php
  while (have_posts()) {
    the_post();
    the_title('<h1>', '</h1>');
    the_content();
  }
  ?>
</div>
<?php
get_template_part('template-parts/sections/scroll-top');
get_footer();