<?php get_header(); ?>

<main class="site-main">
  <div class="container section-padding">
    <?php
      while ( have_posts() ) :
        the_post();
        the_title( '<h1 class="entry-title">', '</h1>' );
        the_content();
        wp_link_pages();
        comments_template();
      endwhile;
    ?>
  </div>
</main>

<?php get_footer(); ?>