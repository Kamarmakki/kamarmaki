<?php
/**
 * Kamar Hkombat SEO Theme Functions
 * Author: Your Name
 * Version: 1.0.0
 * Text Domain: kamar-hkombat
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/*--------------------------------------------------------------
1.  Theme Setup
--------------------------------------------------------------*/
add_action( 'after_setup_theme', 'kamar_setup' );
function kamar_setup() {

    // Let WP handle the <title> tag
    add_theme_support( 'title-tag' );

    // Enable featured images
    add_theme_support( 'post-thumbnails' );

    // HTML5 support
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    // Register navigation menus
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'kamar-hkombat' ),
        'footer'  => esc_html__( 'Footer Menu', 'kamar-hkombat' ),
    ) );

    // Automatic feed links
    add_theme_support( 'automatic-feed-links' );

    // Wide & full alignment for Gutenberg
    add_theme_support( 'align-wide' );

    // Custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
}

/*--------------------------------------------------------------
2.  Enqueue Scripts & Styles
--------------------------------------------------------------*/
add_action( 'wp_enqueue_scripts', 'kamar_scripts' );
function kamar_scripts() {

    // Google Font: Cairo
    wp_enqueue_style( 'google-font-cairo', 'https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;900&display=swap', array(), null );

    // Font Awesome
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );

    // Theme stylesheet (replace with your compiled CSS path if you use SCSS)
    wp_enqueue_style( 'kamar-style', get_stylesheet_uri(), array(), '1.0.0' );

    // Theme JS
    wp_enqueue_script( 'kamar-js', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0.0', true );

    // Localize for AJAX or any dynamic JS vars
    wp_localize_script( 'kamar-js', 'kamar_obj', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'kamar_nonce' ),
    ) );
}

/*--------------------------------------------------------------
3.  Register Widget Areas (Sidebars)
--------------------------------------------------------------*/
add_action( 'widgets_init', 'kamar_widgets_init' );
function kamar_widgets_init() {

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 1', 'kamar-hkombat' ),
        'id'            => 'footer-1',
        'description'   => esc_html__( 'Add widgets here.', 'kamar-hkombat' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 2', 'kamar-hkombat' ),
        'id'            => 'footer-2',
        'description'   => esc_html__( 'Add widgets here.', 'kamar-hkombat' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Column 3', 'kamar-hkombat' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Add widgets here.', 'kamar-hkombat' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</div>',
    ) );
}

/*--------------------------------------------------------------
4.  Custom Post Type: Services
--------------------------------------------------------------*/
add_action( 'init', 'kamar_register_services_cpt' );
function kamar_register_services_cpt() {

    $labels = array(
        'name'               => _x( 'Services', 'post type general name', 'kamar-hkombat' ),
        'singular_name'      => _x( 'Service', 'post type singular name', 'kamar-hkombat' ),
        'menu_name'          => _x( 'Services', 'admin menu', 'kamar-hkombat' ),
        'name_admin_bar'     => _x( 'Service', 'add new on admin bar', 'kamar-hkombat' ),
        'add_new'            => _x( 'Add New', 'service', 'kamar-hkombat' ),
        'add_new_item'       => __( 'Add New Service', 'kamar-hkombat' ),
        'new_item'           => __( 'New Service', 'kamar-hkombat' ),
        'edit_item'          => __( 'Edit Service', 'kamar-hkombat' ),
        'view_item'          => __( 'View Service', 'kamar-hkombat' ),
        'all_items'          => __( 'All Services', 'kamar-hkombat' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'service' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'menu_icon'          => 'dashicons-awards',
    );

    register_post_type( 'service', $args );
}

/*--------------------------------------------------------------
5.  Contact Form AJAX Handler
--------------------------------------------------------------*/
add_action( 'wp_ajax_kamar_submit_contact', 'kamar_handle_contact_form' );
add_action( 'wp_ajax_nopriv_kamar_submit_contact', 'kamar_handle_contact_form' );

function kamar_handle_contact_form() {

    check_ajax_referer( 'kamar_nonce', 'nonce' );

    // Sanitize fields
    $name    = sanitize_text_field( $_POST['name'] );
    $email   = sanitize_email( $_POST['email'] );
    $phone   = sanitize_text_field( $_POST['phone'] );
    $website = esc_url_raw( $_POST['website'] );
    $message = sanitize_textarea_field( $_POST['message'] );

    // Compose email
    $to      = get_option( 'admin_email' );
    $subject = sprintf( __( 'New contact from %s', 'kamar-hkombat' ), $name );
    $body    = "Name: $name\nEmail: $email\nPhone: $phone\nWebsite: $website\n\nMessage:\n$message";
    $headers = array( 'Content-Type: text/plain; charset=UTF-8' );

    // Send mail
    if ( wp_mail( $to, $subject, $body, $headers ) ) {
        wp_send_json_success( __( 'Your message has been sent successfully.', 'kamar-hkombat' ) );
    } else {
        wp_send_json_error( __( 'Failed to send message. Please try again later.', 'kamar-hkombat' ) );
    }
}

/*--------------------------------------------------------------
6.  Remove WP Version & Other Security Hardening
--------------------------------------------------------------*/
remove_action( 'wp_head', 'wp_generator' );                 // Remove WP version
add_filter( 'the_generator', '__return_empty_string' );     // Remove generator tag
add_filter( 'login_errors', '__return_null' );              // Remove login hints

/*--------------------------------------------------------------
7.  Allow SVG Uploads (if you need to upload SVG icons)
--------------------------------------------------------------*/
add_filter( 'upload_mimes', 'kamar_allow_svg' );
function kamar_allow_svg( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

/*--------------------------------------------------------------
8.  Excerpt Length & More Text
--------------------------------------------------------------*/
add_filter( 'excerpt_length', 'kamar_excerpt_length', 999 );
function kamar_excerpt_length() {
    return 25; // words
}

add_filter( 'excerpt_more', 'kamar_excerpt_more' );
function kamar_excerpt_more() {
    return '...';
}