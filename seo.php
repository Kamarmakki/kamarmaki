<?php
// JSON-LD Organization
add_action('wp_head', 'kamar_json_ld_org', 5);
function kamar_json_ld_org(){
  if(is_front_page()){
    $logo = esc_url(wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full'));
    ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "<?php bloginfo('name'); ?>",
      "url": "<?php echo home_url('/'); ?>",
      "logo": "<?php echo $logo; ?>",
      "sameAs": ["https://twitter.com/yourprofile","https://linkedin.com/company/yourprofile"],
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+966-xx-xxx-xxxx",
        "contactType": "sales",
        "areaServed": "SA",
        "availableLanguage": "Arabic"
      }
    }
    </script>
    <?php
  }
}

// JSON-LD WebSite
add_action('wp_head', 'kamar_json_ld_website', 7);
function kamar_json_ld_website(){
  if(is_front_page()){
    ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "<?php bloginfo('name'); ?>",
      "url": "<?php echo home_url('/'); ?>",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "<?php echo home_url('/?s={search_term_string}'); ?>",
        "query-input": "required name=search_term_string"
      }
    }
    </script>
    <?php
  }
}

// hreflang
add_action('wp_head', 'kamar_hreflang');
function kamar_hreflang(){
  if(is_singular()){
    global $post;
    echo '<link rel="canonical" href="' . get_permalink($post->ID) . '">' . PHP_EOL;
    echo '<link rel="alternate" hreflang="ar" href="' . get_permalink($post->ID) . '">' . PHP_EOL;
    echo '<link rel="alternate" hreflang="ar-sa" href="' . get_permalink($post->ID) . '">' . PHP_EOL;
  }
}