<?php
/**
 * AI search visibility:
 *  1. robots.txt explicitly welcomes AI search/answer crawlers (ChatGPT, Perplexity,
 *     Claude, Gemini, Copilot, Apple) with the same private-area exclusions as everyone else.
 *  2. /llms.txt — a plain-language summary of who, what, where, for assistants.
 *
 * Note: robots.txt only states permission. If the host's firewall blocks these
 * crawlers, they still cannot read the site — that must be opened on the server.
 *
 * @package sepehr-seo-geo
 */

defined( 'ABSPATH' ) || exit;

/**
 * @return string[]
 */
function sepehr_ai_crawlers() {
	return apply_filters( 'sepehr_ai_crawlers', array(
		'GPTBot', 'OAI-SearchBot', 'ChatGPT-User',
		'PerplexityBot', 'Perplexity-User',
		'ClaudeBot', 'Claude-SearchBot', 'Claude-User',
		'Google-Extended', 'Applebot', 'Applebot-Extended',
		'Bingbot', 'DuckAssistBot',
	) );
}

add_filter( 'robots_txt', function ( $output, $public ) {
	if ( ! $public ) {
		return $output;
	}
	$lines   = array( '', '# AI search and answer engines: welcome.' );
	foreach ( sepehr_ai_crawlers() as $bot ) {
		$lines[] = 'User-agent: ' . $bot;
	}
	$lines[] = 'Allow: /';
	$lines[] = 'Allow: /wp-admin/admin-ajax.php';
	$lines[] = 'Disallow: /wp-admin/';
	$lines[] = 'Disallow: /cart/';
	$lines[] = 'Disallow: /checkout/';
	$lines[] = 'Disallow: /my-account/';
	$lines[] = 'Disallow: /*?add-to-cart=';
	$lines[] = '';
	$lines[] = '# Summary for AI assistants: ' . home_url( '/llms.txt' );
	return rtrim( $output ) . "\n" . implode( "\n", $lines ) . "\n";
}, 1000, 2 );

/**
 * Markdown body of /llms.txt, built from the same facts as the page and the schema.
 *
 * @return string
 */
function sepehr_llms_txt() {
	$f     = sepehr_facts();
	$home  = home_url( '/' );
	$price = sepehr_course_price();

	$out   = array();
	$out[] = '# ' . $f['site_name'];
	$out[] = '';
	$out[] = sprintf( '> %s (%s)، %s در تهران است: دوره آنلاین «%s» برای %s در سراسر ایران و کلاس کلیستنیکس حضوری در اوین تهران ویژه %s.', $f['person_name'], $f['person_name_en'], $f['job_title'], $f['course_name'], $f['course_audience'], $f['class_audience'] );
	$out[] = '';
	$out[] = '## مربی';
	$out[] = sprintf( '- %s، %s؛ %s سال مربیگری رسمی و %s سال سابقه ورزشی (از %s سالگی).', $f['person_name'], $f['credential'], $f['coaching_years'], $f['sport_years'], $f['sport_since_age'] );
	$out[] = '- سابقه: کاراته با ' . $f['awards'] . '؛ کمک‌مربی از نوجوانی؛ پارکور و کلیستنیکس.';
	$out[] = '- ' . $f['students_label'] . ' شاگرد حضوری موفق.';
	$out[] = '';
	$out[] = '## دوره آنلاین: ' . $f['course_name'];
	$out[] = '- برای ' . $f['course_audience'] . '، از مبتدی تا پیشرفته، در سراسر ایران.';
	$out[] = '- سه مسیر: بدنسازی با کلیستنیکس، بدنسازی در خانه بدون وسیله، کلیستنیکس ترکیبی با وزنه.';
	$out[] = '- شامل: ویدیوی آموزشی هر حرکت، برنامه غذایی متناسب با هدف، پشتیبانی.';
	$out[] = '- قیمت: ' . ( null === $price ? 'به‌زودی اعلام می‌شود' : number_format( $price ) . ' تومان' );
	$out[] = '- لینک: ' . sepehr_course_url();
	$out[] = '';
	$out[] = '## کلاس کلیستنیکس حضوری در تهران';
	$out[] = '- آدرس: ' . $f['address_display'] . ' (نزدیک به ' . $f['nearby'] . ')';
	foreach ( $f['sessions'] as $s ) {
		$out[] = sprintf( '- %s (%s): %s، %s', $s['name'], $s['label'], $s['days_label'], $s['time_label'] );
	}
	$out[] = '- ویژه ' . $f['class_audience'] . '. رزرو و ثبت‌نام: ' . $f['phone_display'] . ' (' . $f['phone_e164'] . ')';
	$out[] = '';
	$out[] = '## لینک‌ها';
	$out[] = '- [صفحه اصلی](' . $home . ')';
	$out[] = '- [کلیستنیکس چیست؟](' . $home . '#what)';
	$out[] = '- [دوره آنلاین](' . sepehr_course_url() . ')';
	$out[] = '- [کلاس حضوری تهران](' . $home . '#class)';
	$out[] = '- [درباره مربی](' . $home . '#coach)';
	if ( $f['instagram'] ) {
		$out[] = '- [اینستاگرام](https://www.instagram.com/' . $f['instagram'] . '/)';
	}
	if ( $f['telegram'] ) {
		$out[] = '- [تلگرام](https://t.me/' . $f['telegram'] . ')';
	}
	return implode( "\n", apply_filters( 'sepehr_llms_txt_lines', $out ) ) . "\n";
}

add_action( 'init', function () {
	$path = isset( $_SERVER['REQUEST_URI'] ) ? wp_parse_url( wp_unslash( $_SERVER['REQUEST_URI'] ), PHP_URL_PATH ) : ''; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
	$base = wp_parse_url( home_url( '/' ), PHP_URL_PATH );
	if ( ! $path || rtrim( (string) $base, '/' ) . '/llms.txt' !== $path ) {
		return;
	}
	nocache_headers();
	header( 'Content-Type: text/markdown; charset=utf-8' );
	header( 'X-Robots-Tag: noindex' );
	echo sepehr_llms_txt(); // phpcs:ignore WordPress.Security.EscapeOutput -- plain text built from trusted facts.
	exit;
}, 0 );
