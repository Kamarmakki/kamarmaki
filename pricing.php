<?php
// k: pricing block
$rows = get_field('pricing_packages');
if (!$rows) return;
?>
<section class="py-16">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold mb-8 text-center"><?php _e('Pricing', 'kamar'); ?></h2>
    <div class="grid md:grid-cols-3 gap-6">
      <?php foreach ($rows as $row) : ?>
        <div class="border rounded p-6 text-center">
          <h3 class="text-xl font-semibold mb-2"><?php echo esc_html($row['title']); ?></h3>
          <p class="text-3xl font-bold mb-4"><?php echo esc_html($row['price']); ?></p>
          <ul class="text-left space-y-2 mb-6">
            <?php foreach ($row['features'] as $f) : ?>
              <li><?php echo esc_html($f); ?></li>
            <?php endforeach; ?>
          </ul>
          <button class="bg-primary-600 text-white px-4 py-2 rounded"><?php _e('Choose', 'kamar'); ?></button>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>