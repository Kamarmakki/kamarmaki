<?php
// k: faq block
$faqs = get_field('faq_list');
if (!$faqs) return;
?>
<section class="py-16">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold mb-8 text-center"><?php _e('FAQ', 'kamar'); ?></h2>
    <div class="max-w-3xl mx-auto space-y-4">
      <?php foreach ($faqs as $f) : ?>
        <details class="border rounded p-4">
          <summary class="font-semibold cursor-pointer"><?php echo esc_html($f['q']); ?></summary>
          <p class="mt-2"><?php echo esc_html($f['a']); ?></p>
        </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>