<?php
/**
 * Kamar Hkombat SEO Theme Functions
 * Author: Your Name
 * Version: 1.1.0
 * Text Domain: kamar-hkombat
 * Domain Path: /languages
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* 1. Theme Setup ------------------------------------------------------ */
add_action( 'after_setup_theme', 'kamar_setup' );
function kamar_setup(): void {
    load_theme_textdomain( 'kamar-hkombat', get_template_directory() . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ] );
    add_theme_support( 'custom-logo', [ 'height' => 60, 'width' => 220, 'flex-height' => true, 'flex-width' => true ] );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );

    register_nav_menus( [
        'primary' => __( 'القائمة الرئيسية', 'kamar-hkombat' ),
        'footer'  => __( 'قائمة التذييل', 'kamar-hkombat' ),
    ] );
}

/* 2. Assets ----------------------------------------------------------- */
add_action( 'wp_enqueue_scripts', 'kamar_assets' );
function kamar_assets(): void {
    // Google Font
    wp_enqueue_style( 'cairo-font', 'https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;900&display=swap', [], null );

    // Font Awesome
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', [], '6.4.0' );

    // CSS
    $css_ver = file_exists( get_stylesheet_directory() . '/style.css' )
        ? filemtime( get_stylesheet_directory() . '/style.css' )
        : '1.0.0';
    wp_enqueue_style( 'kamar-style', get_stylesheet_uri(), [], $css_ver );

    // Print CSS
    wp_enqueue_style( 'kamar-print', get_template_directory_uri() . '/print.css', [ 'kamar-style' ], '1.0.0', 'print' );

    // JS
    $js_ver = file_exists( get_template_directory() . '/assets/js/main.js' )
        ? filemtime( get_template_directory() . '/assets/js/main.js' )
        : '1.0.0';
    wp_enqueue_script( 'kamar-js', get_template_directory_uri() . '/assets/js/main.js', [ 'jquery' ], $js_ver, true );

    wp_localize_script( 'kamar-js', 'kamar_obj', [
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'kamar_nonce' ),
    ] );
}

/* 3. CPTs ------------------------------------------------------------- */
add_action( 'init', 'kamar_register_cpts' );
function kamar_register_cpts(): void {
    // Services
    register_post_type( 'service', [
        'labels'      => [
            'name'          => __( 'الخدمات', 'kamar-hkombat' ),
            'singular_name' => __( 'خدمة', 'kamar-hkombat' ),
            'add_new'       => __( 'إضافة خدمة', 'kamar-hkombat' ),
            'edit_item'     => __( 'تعديل الخدمة', 'kamar-hkombat' ),
        ],
        'public'      => true,
        'has_archive' => false,
        'menu_icon'   => 'dashicons-awards',
        'supports'    => [ 'title', 'editor', 'thumbnail' ],
        'rewrite'     => [ 'slug' => 'service' ],
    ] );

    // Tools
    register_post_type( 'tool', [
        'labels'      => [
            'name'          => __( 'أدوات مجانية', 'kamar-hkombat' ),
            'singular_name' => __( 'أداة', 'kamar-hkombat' ),
            'add_new'       => __( 'إضافة أداة', 'kamar-hkombat' ),
        ],
        'public'      => true,
        'has_archive' => false,
        'menu_icon'   => 'dashicons-hammer',
        'supports'    => [ 'title', 'editor', 'thumbnail' ],
        'rewrite'     => [ 'slug' => 'tool' ],
    ] );

    // FAQ
    register_post_type( 'faq', [
        'labels'      => [
            'name'          => __( 'الأسئلة الشائعة', 'kamar-hkombat' ),
            'singular_name' => __( 'سؤال', 'kamar-hkombat' ),
            'add_new'       => __( 'إضافة سؤال', 'kamar-hkombat' ),
        ],
        'public'      => true,
        'has_archive' => false,
        'menu_icon'   => 'dashicons-editor-help',
        'supports'    => [ 'title', 'editor' ],
        'rewrite'     => [ 'slug' => 'faq' ],
    ] );
}

/* 4. AJAX Contact Handler --------------------------------------------- */
add_action( 'wp_ajax_kamar_contact', 'kamar_handle_contact' );
add_action( 'wp_ajax_nopriv_kamar_contact', 'kamar_handle_contact' );

function kamar_handle_contact(): void {
    check_ajax_referer( 'kamar_nonce', 'nonce' );

    $name    = sanitize_text_field( $_POST['name']    ?? '' );
    $email   = sanitize_email(        $_POST['email']   ?? '' );
    $phone   = sanitize_text_field( $_POST['phone']   ?? '' );
    $website = esc_url_raw(         $_POST['website'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );

    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_send_json_error( __( 'الحقول المطلوبة غير مكتملة.', 'kamar-hkombat' ) );
    }

    $to      = get_option( 'admin_email' );
    $subject = sprintf( __( 'استفسار جديد من %s', 'kamar-hkombat' ), $name );
    $body    = "الاسم: $name\nالبريد: $email\nالهاتف: $phone\nالموقع: $website\n\nالرسالة:\n$message";
    $headers = [ 'Content-Type: text/plain; charset=UTF-8' ];

    wp_mail( $to, $subject, $body, $headers )
        ? wp_send_json_success( __( 'تم الإرسال بنجاح، شكراً لك!', 'kamar-hkombat' ) )
        : wp_send_json_error( __( 'فشل الإرسال، حاول مجدداً.', 'kamar-hkombat' ) );
}

/* 5. Widget Areas ----------------------------------------------------- */
add_action( 'widgets_init', 'kamar_widgets' );
function kamar_widgets(): void {
    for ( $i = 1; $i <= 3; $i++ ) {
        register_sidebar( [
            'name'          => sprintf( __( 'تذييل %s', 'kamar-hkombat' ), $i ),
            'id'            => "footer-$i",
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ] );
    }
}

/* 6. Security & Performance ------------------------------------------ */
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );
add_filter( 'login_errors', '__return_null' );

add_filter( 'upload_mimes', 'kamar_allow_svg' );
function kamar_allow_svg( array $mimes ): array {
    if ( current_user_can( 'manage_options' ) ) {
        $mimes['svg'] = 'image/svg+xml';
    }
    return $mimes;
}

/* 7. Excerpt Length --------------------------------------------------- */
add_filter( 'excerpt_length', 'kamar_excerpt_length' );
function kamar_excerpt_length(): int {
    return 25;
}

/* 8. Folder-Listing Shortcode ---------------------------------------- */
add_shortcode( 'kamar_list_files', 'kamar_render_file_list' );
function kamar_render_file_list( array $atts ): string {
    $atts = shortcode_atts(
        [
            'path' => '',        // folder relative to /wp-content
            'deep' => 'false',   // scan sub-folders ?
        ],
        $atts,
        'kamar_list_files'
    );

    $folder = untrailingslashit( WP_CONTENT_DIR . '/' . ltrim( $atts['path'], '/' ) );
    $url    = content_url( '/' . ltrim( $atts['path'], '/' ) );

    if ( ! is_dir( $folder ) ) {
        return '<p class="kamar-file-list__error">' . esc_html__( 'المجلد غير موجود.', 'kamar-hkombat' ) . '</p>';
    }

    $flags = ( $atts['deep'] === 'true' )
        ? RecursiveDirectoryIterator::SKIP_DOTS
        : FilesystemIterator::SKIP_DOTS;

    $iter = ( $atts['deep'] === 'true' )
        ? new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $folder, $flags ), RecursiveIteratorIterator::SELF_FIRST )
        : new FilesystemIterator( $folder, $flags );

    $out = '<ul class="kamar-file-list">';
    foreach ( $iter as $file ) {
        /** @var SplFileInfo $file */
        if ( $file->isDot() ) { continue; }

        $link = esc_url( $url . '/' . ( $atts['deep'] === 'true' ? $iter->getSubPathname() : $file->getFilename() ) );
        $name = esc_html( $file->getFilename() );
        $icon = $file->isDir() ? 'fa-folder' : 'fa-file';

        $out .= sprintf( '<li><a href="%1$s" target="_blank"><i class="fas %2$s"></i> %3$s</a></li>', $link, $icon, $name );
    }
    $out .= '</ul>';

    return $out;
}
