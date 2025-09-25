<?php
/**
 * Kamar SEO – Functions File
 * Lightweight, fast, and fully Arabic-compatible WordPress theme.
 */

defined( 'ABSPATH' ) || exit;

/* ------------------------------------------------------------------------ *
 * 1. Enqueue Assets
 * ------------------------------------------------------------------------ */
add_action( 'wp_enqueue_scripts', 'kamar_enqueue' );
function kamar_enqueue(): void {
	// Google Font
	wp_enqueue_style( 'cairo-font', 'https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;700&display=swap', [], null );

	// Font Awesome
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', [], '6.4.0' );

	// Main stylesheet
	wp_enqueue_style( 'kamar-style', get_stylesheet_uri(), [], '1.0.0' );

	// Extra layout styles
	wp_enqueue_style( 'kamar-extra', get_template_directory_uri() . '/assets/css/extra.css', [ 'kamar-style' ], '1.0.0' );

	// Main JS
	wp_enqueue_script( 'kamar-main', get_template_directory_uri() . '/assets/js/main.js', [ 'jquery' ], '1.0.0', true );

	// Localize AJAX & nonce
	wp_localize_script(
		'kamar-main',
		'kamar',
		[
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'kamar_nonce' ),
		]
	);
}

/* ------------------------------------------------------------------------ *
 * 2. Theme Setup
 * ------------------------------------------------------------------------ */
add_action( 'after_setup_theme', 'kamar_setup' );
function kamar_setup(): void {
	// Title tag support
	add_theme_support( 'title-tag' );

	// Featured images
	add_theme_support( 'post-thumbnails' );

	// Custom logo
	add_theme_support(
		'custom-logo',
		[
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		]
	);

	// HTML5 markup
	add_theme_support(
		'html5',
		[
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		]
	);

	// Navigation menus
	register_nav_menus(
		[
			'primary' => esc_html__( 'Primary Menu', 'kamar-seo' ),
			'footer'  => esc_html__( 'Footer Menu', 'kamar-seo' ),
		]
	);
}

/* ------------------------------------------------------------------------ *
 * 3. Shortcode – Contact Form
 * Usage: [kamar_contact_form]
 * ------------------------------------------------------------------------ */
add_shortcode( 'kamar_contact_form', 'kamar_contact_form_shortcode' );
function kamar_contact_form_shortcode(): string {
	ob_start();
	?>
	<form id="kamar-contact-form" class="contact-form">
		<div class="grid-2">
			<input type="text" name="name" placeholder="<?php esc_attr_e( 'الاسم الكامل', 'kamar-seo' ); ?>" required>
			<input type="email" name="email" placeholder="<?php esc_attr_e( 'البريد الإلكتروني', 'kamar-seo' ); ?>" required>
		</div>
		<input type="text" name="phone" placeholder="<?php esc_attr_e( 'رقم الهاتف', 'kamar-seo' ); ?>" required>
		<input type="url" name="website" placeholder="<?php esc_attr_e( 'رابط موقعك', 'kamar-seo' ); ?>" required>
		<textarea name="message" placeholder="<?php esc_attr_e( 'اكتب رسالتك...', 'kamar-seo' ); ?>"></textarea>
		<button type="submit" class="btn btn-primary"><?php esc_html_e( 'إرسال الطلب', 'kamar-seo' ); ?></button>
		<?php wp_nonce_field( 'kamar_nonce', 'nonce' ); ?>
	</form>
	<?php
	return ob_get_clean();
}

/* ------------------------------------------------------------------------ *
 * 4. AJAX Handler – Contact Form
 * ------------------------------------------------------------------------ */
add_action( 'wp_ajax_send_contact', 'kamar_send_contact' );
add_action( 'wp_ajax_nopriv_send_contact', 'kamar_send_contact' );
function kamar_send_contact(): void {
	check_ajax_referer( 'kamar_nonce', 'nonce' );

	$name  = sanitize_text_field( $_POST['name'] ?? '' );
	$email = sanitize_email( $_POST['email'] ?? '' );
	$phone = sanitize_text_field( $_POST['phone'] ?? '' );
	$url   = esc_url_raw( $_POST['website'] ?? '' );
	$msg   = sanitize_textarea_field( $_POST['message'] ?? '' );

	if ( empty( $name ) || empty( $email ) ) {
		wp_send_json_error( 'Name or email missing' );
	}

	$to      = get_option( 'admin_email' );
	$subject = 'طلب تحليل مجاني من ' . $name;
	$body    = "الاسم: {$name}\nالبريد: {$email}\nالهاتف: {$phone}\nالموقع: {$url}\nالرسالة:\n{$msg}";

	wp_mail( $to, $subject, $body );
	wp_send_json_success( 'تم الإرسال' );
}

/* ------------------------------------------------------------------------ *
 * 5. Register Widget Areas (Optional)
 * ------------------------------------------------------------------------ */
add_action( 'widgets_init', 'kamar_widgets' );
function kamar_widgets(): void {
	register_sidebar(
		[
			'name'          => esc_html__( 'Footer Sidebar', 'kamar-seo' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Appears in the footer area', 'kamar-seo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		]
	);
}

/* ------------------------------------------------------------------------ *
 * 6. Remove WordPress Emoji Scripts (Performance)
 * ------------------------------------------------------------------------ */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/* ------------------------------------------------------------------------ *
 * 7. Excerpt Length (Optional)
 * ------------------------------------------------------------------------ */
add_filter( 'excerpt_length', fn() => 20 );

/* ------------------------------------------------------------------------ *
 * 8. Pagination (Posts Nav)
 * ------------------------------------------------------------------------ */
function kamar_pagination(): void {
	the_posts_pagination(
		[
			'mid_size'  => 2,
			'prev_text' => '<i class="fas fa-chevron-right"></i>',
			'next_text' => '<i class="fas fa-chevron-left"></i>',
		]
	);
}