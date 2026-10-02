<?php
/**
 * Landing page: online course «نقشه راه ساخت بدن با کلیستنیکس» — pre-registration.
 * Search intent: «دوره آنلاین کلیستنیکس»، «خرید دوره کلیستنیکس»، «دوره جامع کلیستنیکس»،
 * «آموزش کلیستنیکس مبتدی در خانه».
 *
 * @package sepehr
 */

defined( 'ABSPATH' ) || exit;

get_header();

$person      = sepehr_fact( 'person_name' );
$course_name = sepehr_fact( 'course_name' );
$audience    = sepehr_fact( 'course_audience' );
$support     = sepehr_fact( 'support_telegram' );
$price       = sepehr_price_label();
$class_url   = function_exists( 'sepehr_page_url' ) ? sepehr_page_url( 'class' ) : home_url( '/#class' );
?>
<main id="main">

	<section class="hero shell" aria-labelledby="page-title">
		<div class="hero-copy">
			<p class="eyebrow"><span class="rule" aria-hidden="true"></span>آنلاین · سراسر ایران · <?php echo esc_html( $audience ); ?></p>
			<p class="badge-open">پیش‌ثبت‌نام باز است</p>
			<h1 id="page-title">دوره آنلاین کلیستنیکس: <span class="gold"><?php echo esc_html( $course_name ); ?></span></h1>
			<p class="lead">یه نقشه‌ی راه کامل از صفر تا پیشرفته برای ساختن بدنی قوی، کارآمد و خوش‌فرم؛ توی خونه، پارک یا باشگاه، با ویدیوی آموزشی هر حرکت و پشتیبانی مستقیم.</p>
			<div class="actions">
				<a class="btn btn-cta btn-lg" href="#lead-form">پیش‌ثبت‌نام رایگان<?php sepehr_icon( 'arrow', 20 ); ?></a>
				<a class="btn btn-outline btn-lg" href="#course-faq">سؤالات متداول</a>
			</div>
			<ul class="ticks">
				<li><?php sepehr_icon( 'check', 18 ); ?>مناسب مبتدی تا پیشرفته</li>
				<li><?php sepehr_icon( 'check', 18 ); ?><?php echo esc_html( $audience ); ?></li>
				<li><?php sepehr_icon( 'check', 18 ); ?>ویدیو + پشتیبانی</li>
			</ul>
		</div>
		<figure class="hero-media">
			<?php sepehr_media( 'sepehr_course_hero_image', 'sepehr-hero', 'نتیجه‌ی تمرین کلیستنیکس: عضلات پشت و سرشانه‌ی سپهر اسماعیلی، مدرس دوره آنلاین کلیستنیکس', '[عکس دوره آنلاین]', true ); ?>
		</figure>
	</section>

	<!-- What's inside -->
	<section class="shell section" aria-labelledby="inside-title">
		<p class="kicker gold">محتوای دوره</p>
		<h2 id="inside-title">دوره آنلاین کلیستنیکس شامل چیه؟</h2>
		<ul class="includes includes--grid">
			<li><?php sepehr_icon( 'check', 18 ); ?>برنامه‌ی تمرینی قدم‌به‌قدم از پایه تا پیشرفته</li>
			<li><?php sepehr_icon( 'check', 18 ); ?>ویدیوی آموزشی تک‌تک حرکت‌ها</li>
			<li><?php sepehr_icon( 'check', 18 ); ?>برنامه‌ی غذایی متناسب با هدفت</li>
			<li><?php sepehr_icon( 'check', 18 ); ?>پشتیبانی و جواب سؤال‌هات</li>
		</ul>

		<h3 class="sub-title">سه مسیر تمرینی؛ یکی رو بسته به شرایطت انتخاب می‌کنی</h3>
		<div class="grid-3">
			<article class="card">
				<span class="icon-box"><?php sepehr_icon( 'bar', 26 ); ?></span>
				<h3>بدنسازی با کلیستنیکس</h3>
				<p>هم بدنت رو می‌سازی، هم مهارت‌های کلیستنیکس مثل ماسل‌آپ و هنداستند رو یاد می‌گیری.</p>
			</article>
			<article class="card">
				<span class="icon-box"><?php sepehr_icon( 'home', 26 ); ?></span>
				<h3>بدنسازی در خانه بدون وسیله</h3>
				<p>ساختن بدن با کمترین تجهیزات، زمان و هزینه؛ مخصوص وقتی که به باشگاه دسترسی نداری.</p>
			</article>
			<article class="card">
				<span class="icon-box"><?php sepehr_icon( 'weight', 26 ); ?></span>
				<h3>کلیستنیکس ترکیبی با وزنه</h3>
				<p>هم حجم، هم قدرت؛ برای کسی که باشگاه می‌ره یا توی خونه وزنه داره.</p>
			</article>
		</div>
	</section>

	<!-- How it works -->
	<section class="band-dark" aria-labelledby="steps-title">
		<div class="shell">
			<p class="kicker gold">مراحل</p>
			<h2 id="steps-title">پیش‌ثبت‌نام دوره چطوری کار می‌کنه؟</h2>
			<ol class="steps">
				<li><strong>پیش‌ثبت‌نام</strong><span>اسم و شماره‌ات رو همین پایین ثبت کن؛ هیچ پرداختی لازم نیست.</span></li>
				<li><strong>اطلاع زودتر از همه</strong><span>قیمت و زمان شروع دوره اول از همه به پیش‌ثبت‌نامی‌ها اعلام می‌شه.</span></li>
				<li><strong>انتخاب مسیر</strong><span>بسته به شرایط و هدفت، مسیر تمرینی مناسبت مشخص می‌شه.</span></li>
				<li><strong>شروع تمرین</strong><span>با ویدیوی هر حرکت، برنامه‌ی غذایی و پشتیبانی شروع می‌کنی.</span></li>
			</ol>
		</div>
	</section>

	<!-- Coach (short) -->
	<section class="shell section split-4-8" aria-labelledby="coach-title">
		<figure class="coach-media">
			<?php sepehr_media( 'sepehr_coach_image', 'sepehr-hero', 'سپهر اسماعیلی، مربی کلیستنیکس و مدرس دوره آنلاین', '[پرتره سپهر اسماعیلی]' ); ?>
		</figure>
		<div class="coach-copy">
			<p class="kicker gold">مدرس دوره</p>
			<h2 id="coach-title"><?php echo esc_html( $person . '، ' . sepehr_fact( 'job_title' ) ); ?></h2>
			<p><?php echo esc_html( $person ); ?> با <?php echo esc_html( sepehr_fact( 'credential' ) ); ?>، <?php echo esc_html( sepehr_fa_digits( sepehr_fact( 'sport_years', 17 ) ) ); ?> سال سابقه‌ی ورزشی و نزدیک به ۱۰۰ شاگرد حضوری موفق، همون روشی رو که توی کلاس‌های حضوری تهران استفاده می‌کنه، توی این دوره به‌صورت قدم‌به‌قدم آورده.</p>
			<p><a class="link-strong" href="<?php echo esc_url( home_url( '/#coach' ) ); ?>">بیشتر درباره‌ی سپهر ←</a></p>
		</div>
	</section>

	<?php sepehr_reviews_section( 3, 'شاگردهای حضوری درباره‌ی سپهر چی می‌گن' ); ?>

	<!-- Pre-registration -->
	<section class="shell section" aria-labelledby="register-title">
		<div class="register">
			<div>
				<p class="kicker gold">پیش‌ثبت‌نام</p>
				<h2 id="register-title">پیش‌ثبت‌نام دوره «<?php echo esc_html( $course_name ); ?>»</h2>
				<p class="muted">رایگانه و تعهدی نداره. به‌محض باز شدن ثبت‌نام، با همین شماره خبرت می‌کنیم.<?php echo $support ? ' سؤال داری؟ توی تلگرام به <a href="' . esc_url( 'https://t.me/' . $support ) . '" target="_blank" rel="noopener" dir="ltr">@' . esc_html( $support ) . '</a> پیام بده.' : ''; // phpcs:ignore WordPress.Security.EscapeOutput -- escaped above. ?></p>
			</div>
			<?php sepehr_lead_form( 'course', 'ثبت پیش‌ثبت‌نام دوره' ); ?>
		</div>
	</section>

	<!-- FAQ -->
	<section id="course-faq" class="shell section split-4-8" aria-labelledby="faq-title">
		<div>
			<span class="bar-accent" aria-hidden="true"></span>
			<h2 id="faq-title">سؤالات متداول دوره آنلاین</h2>
		</div>
		<div class="faq">
			<div class="faq-item">
				<h3>قیمت دوره‌ی آنلاین کلیستنیکس چقدره؟</h3>
				<p><?php echo $price ? esc_html( 'قیمت دوره ' . $price . ' تومانه.' ) : 'قیمت هنوز اعلام نشده و اول از همه به پیش‌ثبت‌نامی‌ها خبر داده می‌شه.'; ?></p>
			</div>
			<div class="faq-item">
				<h3>دوره برای مبتدی‌ها مناسبه؟</h3>
				<p>آره. دوره از ساده‌ترین نسخه‌ی هر حرکت شروع می‌شه و قدم‌به‌قدم جلو می‌ره؛ لازم نیست قبلاً ورزش کرده باشی.</p>
			</div>
			<div class="faq-item">
				<h3>برای دوره به وسیله یا باشگاه نیاز دارم؟</h3>
				<p>نه. مسیر «بدنسازی در خانه» بدون وسیله انجام می‌شه. برای پیشرفت بیشتر یه میله‌ی بارفیکس کافیه و اگه باشگاه می‌ری، مسیر ترکیبی با وزنه هم هست.</p>
			</div>
			<div class="faq-item">
				<h3>دوره برای خانم‌ها هم مناسبه؟</h3>
				<p>آره، دوره‌ی آنلاین برای <?php echo esc_html( $audience ); ?> طراحی شده.</p>
			</div>
			<div class="faq-item">
				<h3>پشتیبانی دوره چطوریه؟</h3>
				<p>سؤال‌هات درباره‌ی حرکت‌ها و برنامه رو از تیم پشتیبانی می‌پرسی<?php echo $support ? ' (تلگرام: @' . esc_html( $support ) . ')' : ''; ?> و راهنمایی می‌گیری.</p>
			</div>
			<div class="faq-item">
				<h3>توی تهرانم؛ کلاس حضوری هم دارید؟</h3>
				<p>آره، <a href="<?php echo esc_url( $class_url ); ?>">کلاس کلیستنیکس حضوری در اوین تهران</a> هم برگزار می‌شه (ویژه‌ی <?php echo esc_html( sepehr_fact( 'class_audience' ) ); ?>).</p>
			</div>
		</div>
	</section>

	<div class="shell"><?php sepehr_updated_line(); ?></div>
</main>
<?php
get_footer();
