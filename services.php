<?php
// k: services block
$items = get_field('services_items');
if (!$items) return;
?>
<section class="py-16">
  <div class="container mx-auto px-4">
    <h2 class="text-3xl font-bold mb-8 text-center"><?php _e('Our Services', 'kamar'); ?></h2>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
      <?php foreach ($items as $id) : ?>
        <?php get_template_part('template-parts/cards/service', 'card', ['id' => $id]); ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>