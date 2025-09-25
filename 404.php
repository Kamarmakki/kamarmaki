<?php get_header(); ?>

<main class="site-main">
  <div class="container section-padding text-center">
    <h1 class="entry-title"><?php esc_html_e( '404 - الصفحة غير موجودة', 'kamar-seo' ); ?></h1>
    <p><?php esc_html_e( 'يبدو أنك اتبعت رابطًا خاطئًا أو أن الصفحة تم نقلها.', 'kamar-seo' ); ?></p>
    <?php get_search_form(); ?>
  </div>
</main>

<?php get_footer(); ?>