<nav class="footer-menu">
    <?php
    wp_nav_menu( [
        'theme_location' => 'footer',
        'menu_id'        => 'footer-menu',
        'container'      => false,
        'fallback_cb'    => false,
    ] );
    ?>
</nav>