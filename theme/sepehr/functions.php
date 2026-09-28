<?php
/**
 * Sepehr Esmaeily theme setup.
 *
 * @package sepehr
 */

defined( 'ABSPATH' ) || exit;

define( 'SEPEHR_VERSION', '1.0.1' );

require_once __DIR__ . '/inc/settings.php';
require_once __DIR__ . '/inc/customizer.php';
require_once __DIR__ . '/inc/template-tags.php';

add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'sepehr', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );

	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Own location names, so menus from the previous theme are not auto-assigned here.
	register_nav_menus( array(
		'sepehr_primary' => __( 'منوی اصلی (قالب سپهر)', 'sepehr' ),
		'sepehr_footer'  => __( 'منوی فوتر (قالب سپهر)', 'sepehr' ),
	) );

	add_image_size( 'sepehr-hero', 900, 1100, true );
	add_image_size( 'sepehr-card', 720, 480, true );
} );

/**
 * Styles. One small stylesheet, self-hosted fonts, no render-blocking third parties.
 */
add_action( 'wp_enqueue_scripts', function () {
	$uri = get_template_directory_uri();
	$css = get_template_directory() . '/assets/css/main.css';

	wp_enqueue_style( 'sepehr-main', $uri . '/assets/css/main.css', array(), SEPEHR_VERSION . '-' . filemtime( $css ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// The front page is hand-built markup: drop block-editor and WooCommerce-blocks CSS there.
	if ( is_front_page() ) {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'global-styles' );
		wp_dequeue_style( 'classic-theme-styles' );
		wp_dequeue_style( 'wc-blocks-style' );
		wp_dequeue_style( 'wc-blocks-vendors-style' );
	}
}, 20 );

/**
 * Preload the two fonts every page renders above the fold.
 */
add_action( 'wp_head', function () {
	$fonts = get_template_directory_uri() . '/assets/fonts/';
	foreach ( array( 'vazirmatn-arabic-900-normal.woff2', 'vazirmatn-arabic-400-normal.woff2' ) as $file ) {
		printf( '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n", esc_url( $fonts . $file ) );
	}
	printf( '<meta name="theme-color" content="%s">' . "\n", '#0E0E10' );
}, 1 );

/**
 * The front page is always this theme's front-page.php. Page builders (Elementor's
 * "Elementor Full Width" / "Canvas" templates) otherwise swap in the old page design.
 */
add_filter( 'template_include', function ( $template ) {
	if ( is_front_page() && ! is_home() ) {
		$front = locate_template( 'front-page.php' );
		if ( $front ) {
			return $front;
		}
	}
	return $template;
}, 999 );

/**
 * WooCommerce: wrap its pages in the theme layout instead of its default wrappers.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', function () {
	echo '<main id="main" class="shell section paper-wrap"><div class="paper">';
}, 10 );
add_action( 'woocommerce_after_main_content', function () {
	echo '</div></main>';
}, 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
