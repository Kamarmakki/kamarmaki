<?php
// k: tools block
$items = get_field('tools_items');
if (!$items) return;
?>
<section class="py-16 bg-gray-50">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold mb-8 text-center"><?php _e('Our Tools', 'kamar'); ?></h2>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php foreach ($items as $id) : ?>
        <?php get_template_part('template-parts/cards/tool', 'card', ['id' => $id]); ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>