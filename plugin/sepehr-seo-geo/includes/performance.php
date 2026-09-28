<?php
/**
 * Lighter pages and less server load — the hosting account was hitting its
 * CPU and memory limits.
 *
 * @package sepehr-seo-geo
 */

defined( 'ABSPATH' ) || exit;

// Emoji script/styles, generator tag and legacy discovery links: bytes nobody needs.
add_action( 'init', function () {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
} );

// XML-RPC is a favourite target of brute-force bots and costs PHP workers on every hit.
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'wp_headers', function ( $headers ) {
	unset( $headers['X-Pingback'] );
	return $headers;
} );

// Heartbeat: once a minute is plenty.
add_filter( 'heartbeat_settings', function ( $settings ) {
	$settings['interval'] = 60;
	return $settings;
} );

/**
 * The front page is plain theme markup: it needs none of the page-builder, shop,
 * slider or form assets that other plugins enqueue site-wide. Drop them there only.
 */
function sepehr_front_page_asset_is_foreign( $handle ) {
	if ( 0 === strpos( $handle, 'sepehr' ) ) {
		return false;
	}
	// Keep WooCommerce order attribution: it records where buyers came from (Google, Instagram…).
	if ( 0 === strpos( $handle, 'sourcebuster' ) || false !== strpos( $handle, 'order-attribution' ) ) {
		return false;
	}
	// Keep Contact Form 7 when the free-program form on the front page uses it.
	if ( 0 === strpos( $handle, 'contact-form-7' ) && false !== strpos( (string) get_theme_mod( 'sepehr_lead_shortcode', '' ), 'contact-form-7' ) ) {
		return false;
	}
	return (bool) preg_match( '/^(elementor|e-|swiper|font-awesome|fontawesome|eicons|woodmart|wd-|xts|woocommerce|wc-|sourcebuster|mc4wp|contact-form-7|ssp|revslider|rs-|wp-block-library|global-styles|classic-theme-styles)/', $handle );
}

function sepehr_dequeue_front_page_foreign_assets() {
	if ( ! is_front_page() || is_customize_preview() ) {
		return;
	}
	foreach ( array( wp_styles(), wp_scripts() ) as $deps ) {
		foreach ( (array) $deps->queue as $handle ) {
			if ( sepehr_front_page_asset_is_foreign( $handle ) ) {
				$deps->dequeue( $handle );
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'sepehr_dequeue_front_page_foreign_assets', 9999 );
// Some plugins enqueue late (while rendering); sweep again before the footer prints.
add_action( 'wp_footer', 'sepehr_dequeue_front_page_foreign_assets', 1 );

// WooCommerce cart fragments fire an uncached AJAX request on every page view.
// Keep them only where the cart actually changes.
add_action( 'wp_enqueue_scripts', function () {
	if ( ! function_exists( 'is_woocommerce' ) ) {
		return;
	}
	if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
		return;
	}
	wp_dequeue_script( 'wc-cart-fragments' );
}, 99 );
