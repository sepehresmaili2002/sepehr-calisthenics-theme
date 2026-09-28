<?php
/**
 * Small template helpers.
 *
 * @package sepehr
 */

defined( 'ABSPATH' ) || exit;

/**
 * Inline stroke icon. Decorative: hidden from assistive tech.
 *
 * @param string $name
 * @param int    $size
 */
function sepehr_icon( $name, $size = 22 ) {
	$paths = array(
		'check'  => '<path d="M5 12l5 5 9-10"/>',
		'arrow'  => '<path d="M15 6l-6 6 6 6"/>',
		'pin'    => '<path d="M12 21s-7-6.2-7-11a7 7 0 0114 0c0 4.8-7 11-7 11z"/><circle cx="12" cy="10" r="2.5"/>',
		'phone'  => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 005 5L15 13l5 2v4a2 2 0 01-2 2A16 16 0 013 6a2 2 0 012-2"/>',
		'bar'    => '<path d="M4 4h16"/><path d="M8 4v6a4 4 0 008 0V4"/><path d="M12 14v6"/>',
		'home'   => '<path d="M3 11l9-7 9 7"/><path d="M5 10v10h14V10"/><path d="M10 20v-6h4v6"/>',
		'weight' => '<path d="M2 12h4"/><path d="M18 12h4"/><path d="M6 8v8"/><path d="M18 8v8"/><path d="M6 12h12"/>',
		'menu'   => '<path d="M4 7h16"/><path d="M4 12h16"/><path d="M4 17h16"/>',
		'cart'   => '<circle cx="9" cy="20" r="1.5"/><circle cx="18" cy="20" r="1.5"/><path d="M3 4h2l2.4 11h11.2L21 8H7"/>',
		'clock'  => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
	);
	if ( ! isset( $paths[ $name ] ) ) {
		return;
	}
	printf(
		'<svg class="icon icon-%1$s" width="%2$d" height="%2$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%3$s</svg>',
		esc_attr( $name ),
		(int) $size,
		$paths[ $name ] // phpcs:ignore WordPress.Security.EscapeOutput -- static markup above.
	);
}

/**
 * Western digits → Persian digits (for display only).
 *
 * @param string|int $value
 * @return string
 */
function sepehr_fa_digits( $value ) {
	return strtr( (string) $value, array( '0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴', '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹' ) );
}

/**
 * Image chosen in the Customizer, or a labelled placeholder until one is set.
 *
 * @param string $mod         Theme mod holding an attachment ID.
 * @param string $size        Registered image size.
 * @param string $alt         Descriptive alt text (used when the attachment has none).
 * @param string $placeholder Visible label for the empty state.
 * @param bool   $eager       True for the above-the-fold image (LCP).
 */
function sepehr_media( $mod, $size, $alt, $placeholder, $eager = false ) {
	$id = absint( get_theme_mod( $mod, 0 ) );
	if ( $id && wp_attachment_is_image( $id ) ) {
		$own_alt = trim( (string) get_post_meta( $id, '_wp_attachment_image_alt', true ) );
		echo wp_get_attachment_image( $id, $size, false, array(
			'alt'           => '' !== $own_alt ? $own_alt : $alt,
			'class'         => 'media-img',
			'loading'       => $eager ? 'eager' : 'lazy',
			'fetchpriority' => $eager ? 'high' : 'auto',
			'decoding'      => 'async',
			'sizes'         => '(max-width: 700px) 100vw, 40vw',
		) );
		return;
	}
	printf( '<div class="media-placeholder" role="img" aria-label="%1$s"><span>%2$s</span></div>', esc_attr( $alt ), esc_html( $placeholder ) );
}

/**
 * Price label for the course card.
 *
 * @return string
 */
function sepehr_price_label() {
	$price = function_exists( 'sepehr_course_price' ) ? sepehr_course_price() : null;
	if ( null === $price ) {
		return '';
	}
	return sepehr_fa_digits( number_format( $price, 0, '.', '٬' ) );
}

/**
 * Visible "last updated" line — freshness is a signal AI answers look for.
 */
function sepehr_updated_line() {
	$time = get_the_modified_time( 'U' );
	if ( ! $time ) {
		return;
	}
	printf(
		'<p class="updated">%1$s <time datetime="%2$s">%3$s</time></p>',
		esc_html__( 'آخرین به‌روزرسانی:', 'sepehr' ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);
}
