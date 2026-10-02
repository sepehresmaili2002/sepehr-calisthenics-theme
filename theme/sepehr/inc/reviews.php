<?php
/**
 * Real student reviews, copied word for word from the coach's profile on Behtarino
 * (بهترینو). Shown as testimonials only — deliberately no Review/AggregateRating
 * schema: Google ignores self-hosted reviews of one's own business and may treat
 * them as spam.
 *
 * @package sepehr
 */

defined( 'ABSPATH' ) || exit;

/**
 * @return array<int,array{name:string,date:string,text:string}>
 */
function sepehr_reviews() {
	return array(
		array(
			'name' => 'علیرضا حامدی',
			'date' => '۲۴ خرداد ۱۴۰۵',
			'text' => 'سپهر جان مربی بسیار خوش‌اخلاق و حرفه‌ای‌ای هست. همیشه روی اجرای درست حرکات تأکید می‌کنه و با حوصله نکات لازم رو توضیح می‌ده. تمرین‌هایی هم که می‌ده کاملاً اصولی و علمی هستن و مشخصه که با فکر و دانش طراحی شدن. از تمرین کردن باهاش خیلی راضی هستم.',
		),
		array(
			'name' => 'هورداد',
			'date' => '۳۱ اردیبهشت ۱۴۰۵',
			'text' => 'ممنونم از آقا سپهر عزیز که هم با دقت و حوصله بدن مارو ساخت هم کلی نکته ازش یاد گرفتیم. من علاوه بر رو فرم اومدن بدنم، واقعا قوی‌تر شدم و یک حرکاتی رو می‌تونم انجام بدم که قبلاً فکرش هم نمی‌کردم.',
		),
		array(
			'name' => 'حسین',
			'date' => '۲۱ خرداد ۱۴۰۵',
			'text' => 'مربی بسیار خوش‌اخلاق و کاربلدیه، تقریبا ۱ ماهه دارم باهاش ورزش می‌کنم و خیلی راضیم. به نظرم اولین معیار برای ورزش، ارتباط گرفتن و ایجاد شدن حس خوبه، که با سپهر این اتفاق برای من افتاد.',
		),
		array(
			'name' => 'آرش نصیری',
			'date' => '۲ خرداد ۱۴۰۵',
			'text' => 'آقا سپهر هم روی بدنت کار می‌کنه هم روی لایف استایلت و هر سوالی داری راهنماییت می‌کنه. واقعا ممنونم ازشون.',
		),
		array(
			'name' => 'پارسا',
			'date' => '۲۰ شهریور ۱۴۰۵',
			'text' => 'آقا سپهر یکی از باحوصله‌ترین و بهترین مربی‌هاست، واقعا حرف نداره.',
		),
		array(
			'name' => 'علی اکبری',
			'date' => '۲ خرداد ۱۴۰۵',
			'text' => 'مرسی که انقدر وقت می‌ذاری برای شاگردانت و پسر با ادب و با علمی هستی. آرزوی موفقیت‌های روزافزون دارم برات.',
		),
	);
}

/**
 * Testimonials section.
 *
 * @param int    $limit
 * @param string $title
 */
function sepehr_reviews_section( $limit = 6, $title = 'شاگردها درباره سپهر چی می‌گن' ) {
	$reviews = array_slice( sepehr_reviews(), 0, $limit );
	?>
	<section class="shell section" aria-labelledby="reviews-title">
		<p class="kicker gold">نظر شاگردها</p>
		<h2 id="reviews-title"><?php echo esc_html( $title ); ?></h2>
		<div class="reviews">
			<?php foreach ( $reviews as $r ) : ?>
				<figure class="review">
					<blockquote><p><?php echo esc_html( $r['text'] ); ?></p></blockquote>
					<figcaption><strong><?php echo esc_html( $r['name'] ); ?></strong><span><?php echo esc_html( $r['date'] ); ?></span></figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
		<p class="muted-sm reviews-source">نظرها عیناً از صفحه‌ی سپهر اسماعیلی در «بهترینو» نقل شده‌اند.</p>
	</section>
	<?php
}
