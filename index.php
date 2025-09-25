<?php get_header(); ?>

<section class="hero text-center">
  <div class="container">
    <h1><?php esc_html_e( 'أول منصة عربية متكاملة لخدمات السيو', 'kamar-seo' ); ?></h1>
    <p><?php esc_html_e( 'حقّق أعلى تصنيف في جوجل مع خدمات تحسين محركات البحث الاحترافية', 'kamar-seo' ); ?></p>
    <a href="#contact" class="btn btn-primary"><?php esc_html_e( 'ابدأ الآن', 'kamar-seo' ); ?></a>
  </div>
</section>

<section id="contact" class="section-padding">
  <div class="container">
    <h2 class="section-title text-center"><?php esc_html_e( 'تواصل معنا', 'kamar-seo' ); ?></h2>
    <?php echo do_shortcode( '[kamar_contact_form]' ); ?>
  </div>
</section>

<?php get_footer(); ?>