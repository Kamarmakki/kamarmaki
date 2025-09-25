<?php get_header(); ?>

<main class="site-main">
  <div class="container section-padding">
    <h1><?php single_tag_title(); ?></h1>

    <?php if ( have_posts() ) : ?>
      <div class="posts-grid">
        <?php while ( have_posts() ) : the_post(); ?>
          <article class="post-card">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
          </article>
        <?php endwhile; ?>
      </div>
      <?php the_posts_pagination(); ?>
    <?php else : ?>
      <p><?php esc_html_e( 'لا توجد مقالات.', 'kamar-seo' ); ?></p>
    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>