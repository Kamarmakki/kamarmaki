<?php
get_header();
echo '<main class="p-4">';
if ( have_posts() ) :
  while ( have_posts() ) : the_post();
    the_title( '<h1 class="text-2xl font-bold">', '</h1>' );
    the_content();
  endwhile;
endif;
echo '</main>';
get_footer();