<?php
// k: hero block template part
$title    = get_field('hero_title') ?: get_the_title();
$subtitle = get_field('hero_subtitle');
$btn      = get_field('hero_button');
$bg       = get_field('hero_bg')['url'] ?? '';
?>
<section class="relative bg-cover bg-center min-h-[60vh] flex items-center" style="background-image:url('<?php echo esc_url($bg); ?>')">
  <div class="container mx-auto px-4 text-center text-white">
    <h1 class="text-4xl md:text-6xl font-bold mb-4"><?php echo esc_html($title); ?></h1>
    <?php if ($subtitle) : ?>
      <p class="text-lg md:text-xl mb-6"><?php echo esc_html($subtitle); ?></p>
    <?php endif; ?>
    <?php if ($btn) : ?>
      <a href="<?php echo esc_url($btn['url']); ?>" class="inline-block bg-primary-600 hover:bg-primary-700 px-6 py-3 rounded"><?php echo esc_html($btn['title']); ?></a>
    <?php endif; ?>
  </div>
</section>