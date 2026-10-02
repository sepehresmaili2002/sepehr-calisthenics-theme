<?php
/**
 * Landing pages the site needs, one per search intent. The plugin creates each
 * page once (published, empty content); the theme renders it from its own
 * page-{slug}.php template, and meta.php / schema.php describe it.
 *
 * If the owner deletes a page it is not re-created.
 *
 * @package sepehr-seo-geo
 */

defined( 'ABSPATH' ) || exit;

/**
 * @return array<string,array{slug:string,title:string}>
 */
function sepehr_pages() {
	return array(
		'class'  => array(
			'slug'  => 'calisthenics-class-tehran',
			'title' => 'کلاس کلیستنیکس حضوری در تهران (اوین)',
		),
		'course' => array(
			'slug'  => 'online-calisthenics-course',
			'title' => 'دوره آنلاین کلیستنیکس: نقشه راه ساخت بدن با کلیستنیکس',
		),
	);
}

/**
 * Permalink of one of the landing pages (falls back to the front-page section).
 *
 * @param string $key class|course
 * @return string
 */
function sepehr_page_url( $key ) {
	$pages = sepehr_pages();
	if ( isset( $pages[ $key ] ) ) {
		$page = get_page_by_path( $pages[ $key ]['slug'] );
		if ( $page && 'publish' === $page->post_status ) {
			return get_permalink( $page );
		}
	}
	return home_url( '/#' . $key );
}

/**
 * Which landing page is being viewed, if any.
 *
 * @return string class|course|''
 */
function sepehr_current_page_key() {
	if ( ! is_page() ) {
		return '';
	}
	$slug = get_post_field( 'post_name', get_queried_object_id() );
	foreach ( sepehr_pages() as $key => $page ) {
		if ( $page['slug'] === $slug ) {
			return $key;
		}
	}
	return '';
}

add_action( 'admin_init', function () {
	if ( ! current_user_can( 'publish_pages' ) ) {
		return;
	}
	$done = (array) get_option( 'sepehr_pages_created', array() );
	foreach ( sepehr_pages() as $key => $page ) {
		if ( in_array( $key, $done, true ) ) {
			continue;
		}
		if ( ! get_page_by_path( $page['slug'], OBJECT, 'page' ) ) {
			wp_insert_post( array(
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_name'    => $page['slug'],
				'post_title'   => $page['title'],
				'post_content' => '',
			) );
		}
		$done[] = $key;
	}
	update_option( 'sepehr_pages_created', array_values( array_unique( $done ) ), false );
} );
