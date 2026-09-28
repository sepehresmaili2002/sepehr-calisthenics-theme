<?php
/**
 * Access to business facts. The facts themselves live in the companion
 * plugin "Sepehr SEO & GEO" so they survive a theme change.
 *
 * @package sepehr
 */

defined( 'ABSPATH' ) || exit;

/**
 * Read one fact, with a default when the companion plugin is not active.
 *
 * @param string $key
 * @param mixed  $default
 * @return mixed
 */
function sepehr_fact( $key, $default = '' ) {
	if ( ! function_exists( 'sepehr_facts' ) ) {
		return $default;
	}
	$facts = sepehr_facts();
	return isset( $facts[ $key ] ) ? $facts[ $key ] : $default;
}

add_action( 'admin_notices', function () {
	if ( function_exists( 'sepehr_facts' ) || ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	echo '<div class="notice notice-error"><p>';
	echo esc_html__( 'قالب سپهر اسماعیلی به افزونه «Sepehr SEO & GEO» نیاز دارد. لطفاً آن را از بخش افزونه‌ها فعال کنید.', 'sepehr' );
	echo '</p></div>';
} );

/**
 * Site menu (header and footer). Kept in code on purpose: WordPress would otherwise
 * auto-assign the previous theme's menus to this theme.
 *
 * @return array<int,array{url:string,label:string}>
 */
function sepehr_default_nav_items() {
	return array(
		array( 'url' => home_url( '/#course' ), 'label' => __( 'دوره آنلاین', 'sepehr' ) ),
		array( 'url' => home_url( '/#class' ), 'label' => __( 'کلاس حضوری تهران', 'sepehr' ) ),
		array( 'url' => home_url( '/#vip' ), 'label' => __( 'تمرین خصوصی VIP', 'sepehr' ) ),
		array( 'url' => home_url( '/#what' ), 'label' => __( 'کلیستنیکس چیست؟', 'sepehr' ) ),
		array( 'url' => home_url( '/#coach' ), 'label' => __( 'درباره مربی', 'sepehr' ) ),
		array( 'url' => home_url( '/#faq' ), 'label' => __( 'سؤالات متداول', 'sepehr' ) ),
	);
}

/**
 * Print the site menu.
 */
function sepehr_menu() {
	echo '<ul class="nav-list">';
	foreach ( sepehr_default_nav_items() as $item ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $item['url'] ), esc_html( $item['label'] ) );
	}
	echo '</ul>';
}
