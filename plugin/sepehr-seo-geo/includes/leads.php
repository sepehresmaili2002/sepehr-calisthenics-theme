<?php
/**
 * Pre-registration (پیش‌ثبت‌نام): name + mobile number for the online course,
 * the in-person class or the free starter program. Each submission is stored as
 * a private «پیش‌ثبت‌نام» entry in the dashboard and emailed to the site admin.
 *
 * No nonce on purpose: front pages are page-cached, so a nonce would go stale.
 * Spam is held off with a honeypot field, a minimum fill time and a per-IP limit.
 *
 * @package sepehr-seo-geo
 */

defined( 'ABSPATH' ) || exit;

/**
 * @return array<string,string>
 */
function sepehr_lead_interests() {
	return array(
		'course' => 'دوره آنلاین',
		'class'  => 'کلاس حضوری تهران',
		'free'   => 'برنامه رایگان',
	);
}

add_action( 'init', function () {
	register_post_type( 'sepehr_lead', array(
		'labels'          => array(
			'name'          => 'پیش‌ثبت‌نام‌ها',
			'singular_name' => 'پیش‌ثبت‌نام',
			'menu_name'     => 'پیش‌ثبت‌نام‌ها',
			'all_items'     => 'همه پیش‌ثبت‌نام‌ها',
		),
		'public'          => false,
		'show_ui'         => true,
		'show_in_menu'    => true,
		'menu_icon'       => 'dashicons-groups',
		'menu_position'   => 26,
		'supports'        => array( 'title' ),
		'capability_type' => 'post',
		'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
		'map_meta_cap'    => true,
	) );
} );

/**
 * Persian/Arabic digits → Western, keep digits only, normalise to 09xxxxxxxxx.
 *
 * @param string $raw
 * @return string Empty when not a valid Iranian mobile number.
 */
function sepehr_normalize_mobile( $raw ) {
	$digits = strtr( (string) $raw, array(
		'۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
		'٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4', '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
	) );
	$digits = preg_replace( '/\D+/', '', $digits );
	if ( 0 === strpos( $digits, '0098' ) ) {
		$digits = '0' . substr( $digits, 4 );
	} elseif ( 0 === strpos( $digits, '98' ) && 12 === strlen( $digits ) ) {
		$digits = '0' . substr( $digits, 2 );
	} elseif ( 10 === strlen( $digits ) && '9' === $digits[0] ) {
		$digits = '0' . $digits;
	}
	return preg_match( '/^09\d{9}$/', $digits ) ? $digits : '';
}

function sepehr_handle_lead() {
	$back = wp_get_referer();
	$back = $back ? remove_query_arg( 'lead', $back ) : home_url( '/' );
	$fail = function ( $code ) use ( $back ) {
		wp_safe_redirect( add_query_arg( 'lead', $code, $back ) . '#lead-form' );
		exit;
	};

	// phpcs:disable WordPress.Security.NonceVerification.Missing -- see file header.
	if ( ! empty( $_POST['website'] ) ) {
		$fail( 'ok' ); // Bots get a silent "success".
	}
	$started = isset( $_POST['ts'] ) ? (int) $_POST['ts'] : 0;
	if ( $started && time() - $started < 3 ) {
		$fail( 'ok' );
	}

	$phone    = sepehr_normalize_mobile( isset( $_POST['phone'] ) ? wp_unslash( $_POST['phone'] ) : '' );
	$name     = isset( $_POST['lead_name'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_name'] ) ) : '';
	$interest = isset( $_POST['interest'] ) ? sanitize_key( wp_unslash( $_POST['interest'] ) ) : '';
	// phpcs:enable

	$interests = sepehr_lead_interests();
	if ( ! isset( $interests[ $interest ] ) ) {
		$interest = 'course';
	}
	if ( '' === $phone ) {
		$fail( 'phone' );
	}

	$ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	$key = 'sepehr_lead_' . md5( $ip );
	$hit = (int) get_transient( $key );
	if ( $hit >= 5 ) {
		$fail( 'limit' );
	}
	set_transient( $key, $hit + 1, HOUR_IN_SECONDS );

	$id = wp_insert_post( array(
		'post_type'   => 'sepehr_lead',
		'post_status' => 'private',
		'post_title'  => sprintf( '%s — %s', $phone, $interests[ $interest ] ),
	) );
	if ( $id && ! is_wp_error( $id ) ) {
		update_post_meta( $id, '_sepehr_phone', $phone );
		update_post_meta( $id, '_sepehr_name', $name );
		update_post_meta( $id, '_sepehr_interest', $interest );
		update_post_meta( $id, '_sepehr_source', esc_url_raw( $back ) );

		wp_mail(
			get_option( 'admin_email' ),
			'پیش‌ثبت‌نام جدید: ' . $interests[ $interest ],
			"نام: {$name}\nموبایل: {$phone}\nعلاقه‌مند به: {$interests[ $interest ]}\nصفحه: {$back}\n"
		);
	}

	wp_safe_redirect( add_query_arg( 'lead', 'ok', $back ) . '#lead-form' );
	exit;
}
add_action( 'admin_post_nopriv_sepehr_lead', 'sepehr_handle_lead' );
add_action( 'admin_post_sepehr_lead', 'sepehr_handle_lead' );

// Dashboard list: show phone, name, interest and date as columns.
add_filter( 'manage_sepehr_lead_posts_columns', function () {
	return array(
		'cb'              => '<input type="checkbox" />',
		'sepehr_phone'    => 'موبایل',
		'sepehr_name'     => 'نام',
		'sepehr_interest' => 'علاقه‌مند به',
		'date'            => 'تاریخ',
	);
} );
add_action( 'manage_sepehr_lead_posts_custom_column', function ( $column, $post_id ) {
	$interests = sepehr_lead_interests();
	switch ( $column ) {
		case 'sepehr_phone':
			$phone = (string) get_post_meta( $post_id, '_sepehr_phone', true );
			printf( '<a href="tel:%1$s" dir="ltr">%1$s</a>', esc_attr( $phone ) );
			break;
		case 'sepehr_name':
			echo esc_html( (string) get_post_meta( $post_id, '_sepehr_name', true ) );
			break;
		case 'sepehr_interest':
			$i = (string) get_post_meta( $post_id, '_sepehr_interest', true );
			echo esc_html( isset( $interests[ $i ] ) ? $interests[ $i ] : $i );
			break;
	}
}, 10, 2 );
