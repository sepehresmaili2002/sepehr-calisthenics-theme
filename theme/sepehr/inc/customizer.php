<?php
/**
 * Customizer: the few values the owner changes without code.
 * Appearance → Customize → «تنظیمات سایت سپهر».
 *
 * @package sepehr
 */

defined( 'ABSPATH' ) || exit;

add_action( 'customize_register', function ( WP_Customize_Manager $wp_customize ) {
	$wp_customize->add_section( 'sepehr_site', array(
		'title'    => __( 'تنظیمات سایت سپهر', 'sepehr' ),
		'priority' => 30,
	) );

	$text_fields = array(
		'sepehr_course_price'    => array( __( 'قیمت دوره (تومان) — خالی یعنی «به‌زودی»', 'sepehr' ), 'sanitize_text_field' ),
		'sepehr_course_url'      => array( __( 'لینک صفحه خرید دوره (محصول ووکامرس)', 'sepehr' ), 'esc_url_raw' ),
		'sepehr_map_url'         => array( __( 'لینک مسیریابی (نشان / بلد / گوگل مپ)', 'sepehr' ), 'esc_url_raw' ),
		'sepehr_guide_url'       => array( __( 'لینک مقاله «کلیستنیکس چیست»', 'sepehr' ), 'esc_url_raw' ),
		'sepehr_moves_url'       => array( __( 'لینک مقاله «حرکات کلیستنیکس»', 'sepehr' ), 'esc_url_raw' ),
		'sepehr_lead_shortcode'  => array( __( 'شورت‌کد فرم برنامه رایگان (مثلاً فرم تماس ۷)', 'sepehr' ), 'sepehr_sanitize_shortcode' ),
		'sepehr_lead_fallback'   => array( __( 'لینک جایگزین برنامه رایگان (اگر فرم ندارید)', 'sepehr' ), 'esc_url_raw' ),
	);

	foreach ( $text_fields as $id => $field ) {
		$wp_customize->add_setting( $id, array( 'default' => '', 'sanitize_callback' => $field[1] ) );
		$wp_customize->add_control( $id, array( 'label' => $field[0], 'section' => 'sepehr_site', 'type' => 'text' ) );
	}

	$images = array(
		'sepehr_hero_image'  => __( 'عکس اصلی بالای صفحه (عمودی، حداقل ۹۰۰×۱۱۰۰)', 'sepehr' ),
		'sepehr_coach_image' => __( 'پرتره مربی', 'sepehr' ),
		'sepehr_class_image' => __( 'عکس کلاس حضوری (صفحه اصلی)', 'sepehr' ),
		'sepehr_class_hero_image'  => __( 'عکس بالای صفحه «کلاس حضوری تهران»', 'sepehr' ),
		'sepehr_course_hero_image' => __( 'عکس بالای صفحه «دوره آنلاین»', 'sepehr' ),
	);
	foreach ( $images as $id => $label ) {
		$wp_customize->add_setting( $id, array( 'default' => 0, 'sanitize_callback' => 'absint' ) );
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, $id, array(
			'label'     => $label,
			'section'   => 'sepehr_site',
			'mime_type' => 'image',
		) ) );
	}
} );

/**
 * Keep only a single [shortcode ...] tag.
 *
 * @param string $value
 * @return string
 */
function sepehr_sanitize_shortcode( $value ) {
	$value = trim( wp_strip_all_tags( (string) $value ) );
	return preg_match( '/^\[[a-zA-Z0-9_\-]+[^\[\]]*\]$/', $value ) ? $value : '';
}
