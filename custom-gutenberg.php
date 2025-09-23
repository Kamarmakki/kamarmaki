<?php
// k: gutenberg blocks + acf
add_action('acf/init', function () {
  // hero
  acf_register_block([
    'name'            => 'hero',
    'title'           => __('Hero', 'kamar'),
    'render_template' => 'template-parts/blocks/hero.php',
    'category'        => 'formatting',
    'mode'            => 'preview'
  ]);
  // services
  acf_register_block([
    'name'            => 'services',
    'title'           => __('Services', 'kamar'),
    'render_template' => 'template-parts/blocks/services.php',
    'category'        => 'formatting',
    'mode'            => 'preview'
  ]);
  // pricing
  acf_register_block([
    'name'            => 'pricing',
    'title'           => __('Pricing', 'kamar'),
    'render_template' => 'template-parts/blocks/pricing.php',
    'category'        => 'formatting',
    'mode'            => 'preview'
  ]);
  // cta
  acf_register_block([
    'name'            => 'cta',
    'title'           => __('CTA', 'kamar'),
    'render_template' => 'template-parts/blocks/cta.php',
    'category'        => 'formatting',
    'mode'            => 'preview'
  ]);
  // faq
  acf_register_block([
    'name'            => 'faq',
    'title'           => __('FAQ', 'kamar'),
    'render_template' => 'template-parts/blocks/faq.php',
    'category'        => 'formatting',
    'mode'            => 'preview'
  ]);
});

// k: acf field groups (export php)
if( function_exists('acf_add_local_field_group') ):
acf_add_local_field_group([
  'key' => 'group_hero',
  'title' => 'Hero',
  'fields' => [
    ['key' => 'hero_title', 'label' => 'Title', 'name' => 'hero_title', 'type' => 'text'],
    ['key' => 'hero_subtitle', 'label' => 'Subtitle', 'name' => 'hero_subtitle', 'type' => 'text'],
    ['key' => 'hero_button', 'label' => 'Button', 'name' => 'hero_button', 'type' => 'link'],
    ['key' => 'hero_bg', 'label' => 'Background', 'name' => 'hero_bg', 'type' => 'image']
  ],
  'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/hero']]]
]);
acf_add_local_field_group([
  'key' => 'group_services',
  'title' => 'Services',
  'fields' => [
    ['key' => 'services_items', 'label' => 'Services', 'name' => 'services_items', 'type' => 'relationship', 'post_type' => 'service', 'multiple' => 1]
  ],
  'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/services']]]
]);
acf_add_local_field_group([
  'key' => 'group_pricing',
  'title' => 'Pricing',
  'fields' => [
    ['key' => 'pricing_packages', 'label' => 'Packages', 'name' => 'pricing_packages', 'type' => 'repeater', 'sub_fields' => [
      ['key' => 'title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'],
      ['key' => 'price', 'label' => 'Price', 'name' => 'price', 'type' => 'text'],
      ['key' => 'features', 'label' => 'Features', 'name' => 'features', 'type' => 'repeater', 'sub_fields' => [
        ['key' => 'feature', 'label' => 'Feature', 'name' => 'feature', 'type' => 'text']
      ]]
    ]]
  ],
  'location' => [[['param' => 'block', 'operator' => '==', 'value' => 'acf/pricing']]]
]);
endif;