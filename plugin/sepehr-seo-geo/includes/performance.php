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
