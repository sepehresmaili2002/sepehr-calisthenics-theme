<?php
/**
 * Landing page: in-person calisthenics class in Tehran (Evin).
 * Search intent: «کلاس کلیستنیکس تهران»، «باشگاه کلیستنیکس در تهران»، «مربی کلیستنیکس تهران».
 *
 * @package sepehr
 */

defined( 'ABSPATH' ) || exit;

get_header();

$person     = sepehr_fact( 'person_name' );
$phone_e164 = sepehr_fact( 'phone_e164' );
$phone      = sepehr_fact( 'phone_display' );
$address    = sepehr_fact( 'address_display' );
$sessions   = (array) sepehr_fact( 'sessions', array() );
$support    = sepehr_fact( 'support_telegram' );
$map_url    = function_exists( 'sepehr_map_url' ) ? sepehr_map_url() : '';
$course_url = function_exists( 'sepehr_course_url' ) ? sepehr_course_url() : home_url( '/' );
?>
<main id="main">

	<section class="hero shell" aria-labelledby="page-title">
		<div class="hero-copy">
			<p class="eyebrow"><span class="rule" aria-hidden="true"></span>اوین، تهران · ویژه آقایان</p>
			<h1 id="page-title">کلاس کلیستنیکس حضوری <span class="gold">در تهران</span></h1>
			<p class="lead">تمرین زیر نظر مستقیم <?php echo esc_html( $person ); ?>، با تمرکز روی اجرای درست حرکت‌ها، ساختن قدرت و یاد گرفتن مهارت‌های کلیستنیکس. نزدیک به <?php echo esc_html( sepehr_fact( 'nearby' ) ); ?>.</p>
			<div class="actions">
				<a class="btn btn-cta btn-lg" href="tel:<?php echo esc_attr( $phone_e164 ); ?>"><?php sepehr_icon( 'phone', 20 ); ?><?php echo esc_html( 'رزرو: ' . $phone ); ?></a>
				<?php if ( $support ) : ?>
					<a class="btn btn-outline btn-lg" href="<?php echo esc_url( 'https://t.me/' . $support ); ?>" target="_blank" rel="noopener">پیام در تلگرام</a>
				<?php endif; ?>
			</div>
			<ul class="facts">
				<li><?php sepehr_icon( 'pin', 18 ); ?><span><?php echo esc_html( $address ); ?></span></li>
				<?php foreach ( $sessions as $s ) : ?>
					<li><?php sepehr_icon( 'clock', 18 ); ?><span><strong><?php echo esc_html( $s['name'] ); ?>:</strong> <?php echo esc_html( $s['days_label'] . '، ' . $s['time_label'] ); ?></span></li>
				<?php endforeach; ?>
			</ul>
		</div>
		<figure class="hero-media">
			<?php sepehr_media( 'sepehr_class_hero_image', 'sepehr-hero', 'سپهر اسماعیلی در کلاس کلیستنیکس حضوری در تهران، در حال کمک به اجرای حرکت هنداستند شاگرد', '[عکس کلاس: سپهر در حال آموزش به شاگرد]', true ); ?>
		</figure>
	</section>

	<!-- Sessions -->
	<section class="band-dark" aria-labelledby="sessions-title">
		<div class="shell split-6-6">
			<div class="class-copy">
				<p class="kicker gold">روزها و ساعت‌ها</p>
				<h2 id="sessions-title">سانس‌های کلاس کلیستنیکس اوین</h2>
				<p class="muted">کلاس‌ها هفته‌ای سه جلسه برگزار می‌شن. سانس استاندارد گروهیه و توی سانس پریمیوم برنامه‌ی تمرینت مخصوص خودت طراحی می‌شه.</p>
				<address class="addr"><?php sepehr_icon( 'pin' ); ?><span><?php echo esc_html( $address ); ?></span></address>
				<div class="actions">
					<a class="btn btn-cta" href="tel:<?php echo esc_attr( $phone_e164 ); ?>"><?php sepehr_icon( 'phone', 20 ); ?><?php echo esc_html( 'رزرو و ثبت‌نام: ' . $phone ); ?></a>
					<?php if ( $map_url ) : ?>
						<a class="btn btn-ghost" href="<?php echo esc_url( $map_url ); ?>" target="_blank" rel="noopener">مسیریابی در نشان</a>
					<?php endif; ?>
				</div>
			</div>
			<div class="sessions">
				<?php foreach ( $sessions as $s ) : ?>
					<div class="session<?php echo ! empty( $s['premium'] ) ? ' session--premium' : ''; ?>">
						<div class="session-head">
							<h3><?php echo esc_html( $s['name'] ); ?></h3>
							<span class="pill"><?php echo esc_html( $s['label'] ); ?></span>
						</div>
						<p class="session-time"><?php sepehr_icon( 'clock', 18 ); ?><?php echo esc_html( $s['days_label'] . ' · ' . $s['time_label'] ); ?></p>
						<?php if ( ! empty( $s['note'] ) ) : ?>
							<p class="muted-sm"><?php echo esc_html( $s['note'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- What you learn -->
	<section class="shell section" aria-labelledby="learn-title">
		<p class="kicker gold">توی کلاس چی می‌گذره؟</p>
		<h2 id="learn-title">توی کلاس کلیستنیکس چی یاد می‌گیری؟</h2>
		<div class="grid-3">
			<article class="card">
				<span class="icon-box"><?php sepehr_icon( 'check', 26 ); ?></span>
				<h3>اجرای درست حرکت‌ها</h3>
				<p>فرم صحیح بارفیکس، شنا، دیپ، اسکات و پلانک؛ مربی کنارته و تک‌تک حرکت‌ها رو از نزدیک اصلاح می‌کنه تا بدون آسیب پیشرفت کنی.</p>
			</article>
			<article class="card">
				<span class="icon-box"><?php sepehr_icon( 'bar', 26 ); ?></span>
				<h3>مهارت‌های کلیستنیکس</h3>
				<p>قدم‌به‌قدم به سمت حرکت‌های مهارتی مثل هنداستند، ماسل‌آپ و حرکت‌های کنترل بدن، متناسب با سطح خودت.</p>
			</article>
			<article class="card">
				<span class="icon-box"><?php sepehr_icon( 'weight', 26 ); ?></span>
				<h3>آمادگی جسمانی و سبک زندگی</h3>
				<p>تقویت قدرت، استقامت و انعطاف، به‌همراه نکته‌های تغذیه و سبک زندگی که نتیجه‌ی تمرین رو ماندگار می‌کنه.</p>
			</article>
		</div>
		<ul class="includes">
			<li class="includes-title">مناسب برای:</li>
			<li><?php sepehr_icon( 'check', 18 ); ?>مبتدی‌هایی که می‌خوان اصولی شروع کنن</li>
			<li><?php sepehr_icon( 'check', 18 ); ?>کسایی که از وزنه و دستگاه خسته شدن</li>
			<li><?php sepehr_icon( 'check', 18 ); ?>علاقه‌مندهای ژیمناستیک و پارکور</li>
			<li><?php sepehr_icon( 'check', 18 ); ?>هر کسی که بدن قوی و کارآمد می‌خواد</li>
		</ul>
	</section>

	<?php sepehr_reviews_section( 6 ); ?>

	<!-- Pre-registration -->
	<section class="shell section" aria-labelledby="register-title">
		<div class="register">
			<div>
				<p class="kicker gold">رزرو جا</p>
				<h2 id="register-title">پیش‌ثبت‌نام کلاس حضوری</h2>
				<p class="muted">شماره‌ات رو بذار تا برای هماهنگی سانس و شروع کلاس باهات تماس بگیریم. یا مستقیم با <a href="tel:<?php echo esc_attr( $phone_e164 ); ?>"><?php echo esc_html( $phone ); ?></a> تماس بگیر<?php echo $support ? '، یا توی تلگرام به <a href="' . esc_url( 'https://t.me/' . $support ) . '" target="_blank" rel="noopener" dir="ltr">@' . esc_html( $support ) . '</a> پیام بده' : ''; // phpcs:ignore WordPress.Security.EscapeOutput -- escaped above. ?>.</p>
			</div>
			<?php sepehr_lead_form( 'class', 'ثبت پیش‌ثبت‌نام کلاس' ); ?>
		</div>
	</section>

	<!-- FAQ -->
	<section class="shell section split-4-8" aria-labelledby="faq-title">
		<div>
			<span class="bar-accent" aria-hidden="true"></span>
			<h2 id="faq-title">سؤالات متداول کلاس حضوری</h2>
		</div>
		<div class="faq">
			<div class="faq-item">
				<h3>کلاس کلیستنیکس حضوری کجای تهرانه؟</h3>
				<p><?php echo esc_html( $address ); ?>؛ نزدیک به <?php echo esc_html( sepehr_fact( 'nearby' ) ); ?>.<?php if ( $map_url ) : ?> <a href="<?php echo esc_url( $map_url ); ?>" target="_blank" rel="noopener">مسیریابی در نشان</a><?php endif; ?></p>
			</div>
			<div class="faq-item">
				<h3>روزها و ساعت کلاس‌ها چیه؟</h3>
				<p>
					<?php foreach ( $sessions as $s ) : ?>
						<?php echo esc_html( $s['name'] . ': ' . $s['days_label'] . '، ' . $s['time_label'] . '.' ); ?>
					<?php endforeach; ?>
				</p>
			</div>
			<div class="faq-item">
				<h3>برای شرکت توی کلاس تجربه‌ی قبلی لازمه؟</h3>
				<p>نه. تمرین‌ها از سطح خودت شروع می‌شن و هر حرکت نسخه‌ی ساده‌تری داره؛ مربی کمکت می‌کنه قدم‌به‌قدم جلو بری.</p>
			</div>
			<div class="faq-item">
				<h3>شهریه‌ی کلاس چقدره؟</h3>
				<p>شهریه بسته به سانس (استاندارد یا پریمیوم) فرق می‌کنه. برای اطلاع از شهریه با <?php echo esc_html( $phone ); ?> تماس بگیر<?php echo $support ? ' یا توی تلگرام به @' . esc_html( $support ) . ' پیام بده' : ''; ?>.</p>
			</div>
			<div class="faq-item">
				<h3>کلاس برای خانم‌ها هم هست؟</h3>
				<p>کلاس‌های حضوری اوین فعلاً ویژه‌ی <?php echo esc_html( sepehr_fact( 'class_audience' ) ); ?> است. خانم‌ها می‌تونن از <a href="<?php echo esc_url( $course_url ); ?>">دوره‌ی آنلاین کلیستنیکس</a> استفاده کنن که برای <?php echo esc_html( sepehr_fact( 'course_audience' ) ); ?> طراحی شده.</p>
			</div>
			<div class="faq-item">
				<h3>تهران نیستم؛ راه دیگه‌ای برای تمرین با سپهر هست؟</h3>
				<p>آره، <a href="<?php echo esc_url( $course_url ); ?>">دوره‌ی آنلاین «<?php echo esc_html( sepehr_fact( 'course_name' ) ); ?>»</a> برای هر جای ایران قابل استفاده‌ست.</p>
			</div>
		</div>
	</section>

	<div class="shell"><?php sepehr_updated_line(); ?></div>
</main>
<?php
get_footer();
