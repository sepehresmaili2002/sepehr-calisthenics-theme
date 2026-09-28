<?php
/**
 * Front-page title and meta description, targeted at the approved keywords:
 * «آموزش کلیستنیکس»، «کلاس کلیستنیکس تهران»، «دوره کلیستنیکس» — owner's two goals
 * (online course nationwide, in-person class in Tehran) in one snippet.
 *
 * Other pages keep whatever is set per page in Rank Math.
 *
 * @package sepehr-seo-geo
 */

defined( 'ABSPATH' ) || exit;

function sepehr_front_title() {
	return 'آموزش کلیستنیکس آنلاین و کلاس حضوری در تهران | سپهر اسماعیلی';
}

function sepehr_front_description() {
	$f = sepehr_facts();
	return sprintf(
		'دوره آنلاین «%1$s» برای %2$s در سراسر ایران و کلاس کلیستنیکس حضوری در اوین تهران، زیر نظر %3$s با %4$s.',
		$f['course_name'],
		$f['course_audience'],
		$f['person_name'],
		$f['credential']
	);
}

if ( defined( 'RANK_MATH_VERSION' ) || class_exists( 'RankMath' ) ) {
	add_filter( 'rank_math/frontend/title', function ( $title ) {
		return is_front_page() ? sepehr_front_title() : $title;
	}, 99 );
	add_filter( 'rank_math/frontend/description', function ( $desc ) {
		return is_front_page() ? sepehr_front_description() : $desc;
	}, 99 );
	add_filter( 'rank_math/opengraph/facebook/og_title', function ( $t ) {
		return is_front_page() ? sepehr_front_title() : $t;
	}, 99 );
	add_filter( 'rank_math/opengraph/facebook/og_description', function ( $d ) {
		return is_front_page() ? sepehr_front_description() : $d;
	}, 99 );
	add_filter( 'rank_math/opengraph/facebook/og_site_name', function () {
		return sepehr_facts()['site_name'];
	}, 99 );
} else {
	add_filter( 'pre_get_document_title', function ( $title ) {
		return is_front_page() ? sepehr_front_title() : $title;
	}, 99 );
	add_action( 'wp_head', function () {
		if ( is_front_page() ) {
			printf( '<meta name="description" content="%s">' . "\n", esc_attr( sepehr_front_description() ) );
		}
	}, 2 );
}
