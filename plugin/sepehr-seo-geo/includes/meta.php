<?php
/**
 * Titles and meta descriptions for the pages this plugin owns, each aimed at
 * the approved keywords for its search intent:
 *   front page  → «آموزش کلیستنیکس» (both goals in one snippet)
 *   class page  → «کلاس کلیستنیکس تهران»، «باشگاه کلیستنیکس در تهران»
 *   course page → «دوره آنلاین کلیستنیکس»، «خرید دوره کلیستنیکس»
 *
 * Every other page keeps whatever is set for it in Rank Math.
 *
 * @package sepehr-seo-geo
 */

defined( 'ABSPATH' ) || exit;

/**
 * @return array{title:string,description:string}|null
 */
function sepehr_seo_meta() {
	$f = sepehr_facts();

	if ( is_front_page() ) {
		return array(
			'title'       => 'آموزش کلیستنیکس آنلاین و کلاس حضوری در تهران | سپهر اسماعیلی',
			'description' => sprintf( 'دوره آنلاین «%1$s» برای %2$s در سراسر ایران و کلاس کلیستنیکس حضوری در اوین تهران، زیر نظر %3$s با %4$s.', $f['course_name'], $f['course_audience'], $f['person_name'], $f['credential'] ),
		);
	}

	switch ( function_exists( 'sepehr_current_page_key' ) ? sepehr_current_page_key() : '' ) {
		case 'class':
			return array(
				'title'       => 'کلاس کلیستنیکس تهران (اوین) | باشگاه کلیستنیکس غرب تهران',
				'description' => sprintf( 'کلاس کلیستنیکس حضوری در اوین تهران ویژه %1$s، زیر نظر %2$s؛ سانس استاندارد روزهای فرد و سانس پریمیوم با برنامه شخصی‌سازی‌شده روزهای زوج. رزرو: %3$s', $f['class_audience'], $f['person_name'], $f['phone_display'] ),
			);
		case 'course':
			return array(
				'title'       => 'دوره آنلاین کلیستنیکس: ' . $f['course_name'] . ' | پیش‌ثبت‌نام',
				'description' => sprintf( 'دوره جامع آموزش کلیستنیکس از مبتدی تا پیشرفته برای %1$s، در خانه یا باشگاه؛ با ویدیوی هر حرکت، برنامه غذایی و پشتیبانی. پیش‌ثبت‌نام دوره «%2$s» باز است.', $f['course_audience'], $f['course_name'] ),
			);
	}
	return null;
}

if ( defined( 'RANK_MATH_VERSION' ) || class_exists( 'RankMath' ) ) {
	$sepehr_meta_filter = function ( $field ) {
		return function ( $value ) use ( $field ) {
			$meta = sepehr_seo_meta();
			return $meta ? $meta[ $field ] : $value;
		};
	};
	add_filter( 'rank_math/frontend/title', $sepehr_meta_filter( 'title' ), 99 );
	add_filter( 'rank_math/frontend/description', $sepehr_meta_filter( 'description' ), 99 );
	add_filter( 'rank_math/opengraph/facebook/og_title', $sepehr_meta_filter( 'title' ), 99 );
	add_filter( 'rank_math/opengraph/facebook/og_description', $sepehr_meta_filter( 'description' ), 99 );
	add_filter( 'rank_math/opengraph/facebook/og_site_name', function () {
		return sepehr_facts()['site_name'];
	}, 99 );
} else {
	add_filter( 'pre_get_document_title', function ( $title ) {
		$meta = sepehr_seo_meta();
		return $meta ? $meta['title'] : $title;
	}, 99 );
	add_action( 'wp_head', function () {
		$meta = sepehr_seo_meta();
		if ( $meta ) {
			printf( '<meta name="description" content="%s">' . "\n", esc_attr( $meta['description'] ) );
		}
	}, 2 );
}
