<?php
// k: cta block
$text = get_field('cta_text');
$btn  = get_field('cta_button');
if (!$text) return;
?>
<section class="py-12 bg-primary-600 text-white">
  <div class="container mx-auto px-4 text-center">
    <p class="text-xl mb-4"><?php echo esc_html($text); ?></p>
    <?php if ($btn) : ?>
      <a href="<?php echo esc_url($btn['url']); ?>" class="inline-block bg-white text-primary-600 px-6 py-3 rounded"><?php echo esc_html($btn['title']); ?></a>
    <?php endif; ?>
  </div>
</section>