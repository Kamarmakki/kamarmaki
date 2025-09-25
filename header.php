<?php
/**
 * رأس القالب
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <?php
        // عرض الشعار إذا تم رفعه
        if ( function_exists( 'the_custom_logo' ) ) {
            the_custom_logo();
        } else {
            echo '<h1><a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a></h1>';
        }

        // عرض القائمة الرئيسية
        wp_nav_menu( [
            'theme_location' => 'primary',
            'menu_id'        => 'primary-menu',
            'container'      => 'nav',
            'fallback_cb'    => false,
        ] );
        ?>
    </div>
</header>