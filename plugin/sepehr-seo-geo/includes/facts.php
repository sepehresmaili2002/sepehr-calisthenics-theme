<?php
/**
 * Single source of truth for the business facts.
 *
 * Search engines and AI assistants cross-check these details (name, address,
 * phone, hours, credentials) across the site, the schema and the web. Keep
 * them identical everywhere: change them here and nowhere else.
 *
 * @package sepehr-seo-geo
 */

defined( 'ABSPATH' ) || exit;

/**
 * @return array<string,mixed>
 */
function sepehr_facts() {
	static $facts = null;
	if ( null !== $facts ) {
		return $facts;
	}

	$facts = array(
		'person_name'     => 'سپهر اسماعیلی',
		'person_name_en'  => 'Sepehr Esmaeily',
		'job_title'       => 'مربی کلیستنیکس',
		'site_name'       => 'آموزش کلیستنیکس سپهر اسماعیلی',
		'tagline'         => 'آموزش کلیستنیکس آنلاین در سراسر ایران و کلاس حضوری در تهران',

		'phone_display'   => '۰۹۹۶۴۹۴۹۷۳۴',
		'phone_e164'      => '+989964949734',
		'instagram'       => 'sepehr_esmaeily',
		'telegram'        => 'sepehr_calisthenics',

		'street'          => 'اوین، خیابان کچویی، پلاک ۲۱',
		'city'            => 'تهران',
		'region'          => 'تهران',
		'country'         => 'IR',
		'address_display' => 'تهران، اوین، خیابان کچویی، پلاک ۲۱',
		'nearby'          => 'سعادت‌آباد، شهرک غرب، ولنجک و غرب تهران',
		// Fill in once known (from Google Maps / Neshan) so maps and AI answers can place the class.
		'geo'             => array( 'lat' => null, 'lng' => null ),

		'course_name'     => 'نقشه راه ساخت بدن با کلیستنیکس',
		'course_audience' => 'آقایان و بانوان',
		'class_audience'  => 'آقایان',

		// Iranian convention: «روزهای زوج» = شنبه، دوشنبه، چهارشنبه — «روزهای فرد» = یکشنبه، سه‌شنبه، پنجشنبه.
		'sessions'        => array(
			array(
				'name'       => 'سانس استاندارد',
				'label'      => 'گروهی',
				'days_label' => 'روزهای فرد (یکشنبه، سه‌شنبه، پنجشنبه)',
				'days'       => array( 'Sunday', 'Tuesday', 'Thursday' ),
				'opens'      => '19:30',
				'closes'     => '20:30',
				'time_label' => 'ساعت ۱۹:۳۰ تا ۲۰:۳۰',
				'premium'    => false,
				'note'       => '',
			),
			array(
				'name'       => 'سانس پریمیوم',
				'label'      => 'برنامه شخصی‌سازی‌شده',
				'days_label' => 'روزهای زوج (شنبه، دوشنبه، چهارشنبه)',
				'days'       => array( 'Saturday', 'Monday', 'Wednesday' ),
				'opens'      => '20:30',
				'closes'     => '21:30',
				'time_label' => 'ساعت ۲۰:۳۰ تا ۲۱:۳۰',
				'premium'    => true,
				'note'       => 'طراحی برنامه تمرینی مخصوص خودت، بر اساس هدف و سطح آمادگی‌ات.',
			),
		),

		'sport_since_age'   => 7,
		'sport_years'       => 17,
		'coaching_years'    => 4,
		'students_label'    => 'نزدیک به ۱۰۰',
		'credential'        => 'مدرک رسمی مربیگری پرورش اندام و آمادگی جسمانی',
		'knows_about'       => array( 'کلیستنیکس', 'Calisthenics', 'Weighted Calisthenics', 'تمرین با وزن بدن', 'بدنسازی در خانه', 'آمادگی جسمانی', 'پارکور' ),

		'vip_name'          => 'تمرین خصوصی VIP',
		'vip_summary'       => 'جلسات تمرین یک‌به‌یک با سپهر اسماعیلی، با برنامه‌ی کاملاً اختصاصی و پیگیری نزدیک.',
	);

	/**
	 * Filter the business facts.
	 *
	 * @param array $facts
	 */
	$facts = apply_filters( 'sepehr_facts', $facts );
	return $facts;
}

/**
 * Current course price (toman) from the theme's Customizer, or null when not priced yet.
 */
function sepehr_course_price() {
	$price = trim( (string) get_theme_mod( 'sepehr_course_price', '' ) );
	$price = preg_replace( '/[^0-9]/', '', strtr( $price, array( '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4', '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9' ) ) );
	return '' === $price ? null : (int) $price;
}

/**
 * URL of the course sales page (WooCommerce product or landing page).
 */
function sepehr_course_url() {
	$url = trim( (string) get_theme_mod( 'sepehr_course_url', '' ) );
	return '' !== $url ? $url : home_url( '/#course' );
}
