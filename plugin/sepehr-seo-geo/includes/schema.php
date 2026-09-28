<?php
/**
 * Structured data (JSON-LD) describing the three entities the site is about:
 *   Person      — سپهر اسماعیلی (the coach; author and publisher everywhere)
 *   ExerciseGym — the in-person class in Evin, Tehran (front page)
 *   Course      — the online course (front page)
 *
 * With Rank Math active the nodes are merged into Rank Math's own @graph and
 * its generic front-page nodes (Article, Place, the old «SportsClub») are
 * dropped, so there is one consistent description of the business instead of two.
 * Without Rank Math the graph is printed on its own.
 *
 * @package sepehr-seo-geo
 */

defined( 'ABSPATH' ) || exit;

function sepehr_schema_id( $fragment ) {
	return home_url( '/#' . $fragment );
}

/**
 * @return array<string,mixed>
 */
function sepehr_schema_person() {
	$f     = sepehr_facts();
	$node  = array(
		'@type'         => 'Person',
		'@id'           => sepehr_schema_id( 'person' ),
		'name'          => $f['person_name'],
		'alternateName' => $f['person_name_en'],
		'jobTitle'      => $f['job_title'],
		'description'   => sprintf( '%s در تهران با %s و %s سال مربیگری رسمی؛ مدرس دوره آنلاین «%s».', $f['job_title'], $f['credential'], $f['coaching_years'], $f['course_name'] ),
		'url'           => home_url( '/' ),
		'knowsAbout'    => $f['knows_about'],
		'hasCredential' => array(
			'@type'              => 'EducationalOccupationalCredential',
			'name'               => $f['credential'],
			'credentialCategory' => 'certificate',
		),
		'sameAs'        => array_values( array_filter( array(
			$f['instagram'] ? 'https://www.instagram.com/' . $f['instagram'] . '/' : '',
			$f['telegram'] ? 'https://t.me/' . $f['telegram'] : '',
		) ) ),
	);
	$image = sepehr_schema_image_url( 'sepehr_coach_image' );
	if ( $image ) {
		$node['image'] = $image;
	}
	return $node;
}

/**
 * @return array<string,mixed>
 */
function sepehr_schema_gym() {
	$f     = sepehr_facts();
	$hours = array();
	foreach ( $f['sessions'] as $s ) {
		$hours[] = array(
			'@type'     => 'OpeningHoursSpecification',
			'name'      => $s['name'],
			'dayOfWeek' => array_map( function ( $d ) {
				return 'https://schema.org/' . $d;
			}, $s['days'] ),
			'opens'     => $s['opens'],
			'closes'    => $s['closes'],
		);
	}

	$node = array(
		'@type'                     => 'ExerciseGym',
		'@id'                       => sepehr_schema_id( 'class' ),
		'name'                      => 'کلاس کلیستنیکس ' . $f['person_name'] . ' (اوین، تهران)',
		'description'               => sprintf( 'کلاس کلیستنیکس حضوری در اوین تهران، ویژه %s، با سانس استاندارد و سانس پریمیوم با برنامه شخصی‌سازی‌شده؛ نزدیک به %s.', $f['class_audience'], $f['nearby'] ),
		'url'                       => home_url( '/#class' ),
		'telephone'                 => $f['phone_e164'],
		'address'                   => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => $f['street'],
			'addressLocality' => $f['city'],
			'addressRegion'   => $f['region'],
			'addressCountry'  => $f['country'],
		),
		'areaServed'                => $f['city'],
		'openingHoursSpecification' => $hours,
		'founder'                   => array( '@id' => sepehr_schema_id( 'person' ) ),
		'employee'                  => array( '@id' => sepehr_schema_id( 'person' ) ),
		'sameAs'                    => sepehr_schema_person()['sameAs'],
	);

	if ( ! empty( $f['geo']['lat'] ) && ! empty( $f['geo']['lng'] ) ) {
		$node['geo'] = array( '@type' => 'GeoCoordinates', 'latitude' => $f['geo']['lat'], 'longitude' => $f['geo']['lng'] );
	}
	$map = get_theme_mod( 'sepehr_map_url', '' );
	if ( $map ) {
		$node['hasMap'] = esc_url_raw( $map );
	}
	$image = sepehr_schema_image_url( 'sepehr_class_image' ) ?: sepehr_schema_image_url( 'sepehr_hero_image' );
	if ( $image ) {
		$node['image'] = $image;
	}
	return $node;
}

/**
 * @return array<string,mixed>
 */
function sepehr_schema_course() {
	$f    = sepehr_facts();
	$node = array(
		'@type'             => 'Course',
		'@id'               => sepehr_schema_id( 'course' ),
		'name'              => $f['course_name'],
		'description'       => sprintf( 'دوره آنلاین آموزش کلیستنیکس از مبتدی تا پیشرفته برای %s، با ویدیوی آموزشی هر حرکت، برنامه تمرینی و غذایی و پشتیبانی؛ سه مسیر: بدنسازی با کلیستنیکس، بدنسازی در خانه بدون وسیله و کلیستنیکس ترکیبی با وزنه.', $f['course_audience'] ),
		'url'               => sepehr_course_url(),
		'inLanguage'        => 'fa',
		'provider'          => array( '@id' => sepehr_schema_id( 'person' ) ),
		'instructor'        => array( '@id' => sepehr_schema_id( 'person' ) ),
		'educationalLevel'  => 'مبتدی تا پیشرفته',
		'teaches'           => array( 'حرکات کلیستنیکس', 'بارفیکس', 'شنا', 'دیپ', 'ماسل‌آپ', 'هنداستند', 'برنامه غذایی ورزشی' ),
		'hasCourseInstance' => array(
			'@type'      => 'CourseInstance',
			'courseMode' => 'online',
			'instructor' => array( '@id' => sepehr_schema_id( 'person' ) ),
		),
	);

	$price = sepehr_course_price();
	if ( null !== $price ) {
		$node['offers'] = array(
			'@type'         => 'Offer',
			'category'      => 'Paid',
			'price'         => (string) ( $price * 10 ), // Toman → Rial (ISO 4217 IRR).
			'priceCurrency' => 'IRR',
			'availability'  => 'https://schema.org/InStock',
			'url'           => sepehr_course_url(),
		);
	}
	return $node;
}

/**
 * One-on-one VIP training at the client's own location (Tehran districts 1–3, in person only).
 *
 * @return array<string,mixed>
 */
function sepehr_schema_vip() {
	$f = sepehr_facts();
	return array(
		'@type'       => 'Service',
		'@id'         => sepehr_schema_id( 'vip' ),
		'name'        => $f['vip_name'],
		'serviceType' => 'تمرین خصوصی کلیستنیکس (Personal Training)',
		'description' => $f['vip_summary'],
		'provider'    => array( '@id' => sepehr_schema_id( 'person' ) ),
		'areaServed'  => array_map( function ( $area ) {
			return array( '@type' => 'AdministrativeArea', 'name' => $area );
		}, $f['vip_areas'] ),
		'availableChannel' => array(
			'@type'        => 'ServiceChannel',
			'servicePhone' => array( '@type' => 'ContactPoint', 'telephone' => $f['phone_e164'] ),
		),
		'url'         => home_url( '/#vip' ),
	);
}

/**
 * Full URL of an image chosen in the theme's Customizer.
 *
 * @param string $mod
 * @return string
 */
function sepehr_schema_image_url( $mod ) {
	$id = absint( get_theme_mod( $mod, 0 ) );
	if ( ! $id ) {
		return '';
	}
	$src = wp_get_attachment_image_url( $id, 'full' );
	return $src ? $src : '';
}

/**
 * Replace every {"@id": $from} reference in a Rank Math graph with $to.
 *
 * @param mixed  $value
 * @param string $from
 * @param string $to
 * @return mixed
 */
function sepehr_schema_repoint( $value, $from, $to ) {
	if ( is_array( $value ) ) {
		foreach ( $value as $k => $v ) {
			if ( '@id' === $k && $v === $from ) {
				$value[ $k ] = $to;
			} else {
				$value[ $k ] = sepehr_schema_repoint( $v, $from, $to );
			}
		}
	}
	return $value;
}

if ( defined( 'RANK_MATH_VERSION' ) || class_exists( 'RankMath' ) ) {
	add_filter( 'rank_math/json_ld', function ( $data ) {
		if ( ! is_array( $data ) ) {
			return $data;
		}

		// The site is published by the coach himself: Rank Math's publisher node becomes our Person.
		$person_id = sepehr_schema_id( 'person' );
		if ( isset( $data['publisher']['@id'] ) && $data['publisher']['@id'] !== $person_id ) {
			$data = sepehr_schema_repoint( $data, $data['publisher']['@id'], $person_id );
		}
		$data['publisher'] = sepehr_schema_person();

		if ( is_front_page() ) {
			// Generic nodes Rank Math adds to the home page that misdescribe it.
			unset( $data['richSnippet'], $data['place'] );
			$data['sepehrClass']  = sepehr_schema_gym();
			$data['sepehrCourse'] = sepehr_schema_course();
			$data['sepehrVip']    = sepehr_schema_vip();
			if ( isset( $data['WebPage'] ) && is_array( $data['WebPage'] ) ) {
				$data['WebPage']['about']    = array( array( '@id' => sepehr_schema_id( 'course' ) ), array( '@id' => sepehr_schema_id( 'class' ) ), array( '@id' => sepehr_schema_id( 'vip' ) ) );
				$data['WebPage']['mainEntity'] = array( '@id' => $person_id );
			}
		}
		return $data;
	}, 99 );
} else {
	add_action( 'wp_head', function () {
		$graph = array(
			array(
				'@type'     => 'WebSite',
				'@id'       => home_url( '/#website' ),
				'url'       => home_url( '/' ),
				'name'      => sepehr_facts()['site_name'],
				'inLanguage'=> 'fa-IR',
				'publisher' => array( '@id' => sepehr_schema_id( 'person' ) ),
			),
			sepehr_schema_person(),
		);
		if ( is_front_page() ) {
			$graph[] = sepehr_schema_gym();
			$graph[] = sepehr_schema_course();
			$graph[] = sepehr_schema_vip();
		}
		echo '<script type="application/ld+json">' . wp_json_encode( array( '@context' => 'https://schema.org', '@graph' => $graph ), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . "</script>\n";
	}, 20 );
}
