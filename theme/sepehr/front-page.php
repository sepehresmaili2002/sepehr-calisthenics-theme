<?php
/**
 * Front page. Hand-built, server-rendered markup: every answer an AI assistant
 * might quote is plain HTML text, one clear heading per question.
 *
 * @package sepehr
 */

defined( 'ABSPATH' ) || exit;

get_header();

$person      = sepehr_fact( 'person_name' );
$course_name = sepehr_fact( 'course_name' );
$course_url  = function_exists( 'sepehr_course_url' ) ? sepehr_course_url() : home_url( '/#course' );
$price       = sepehr_price_label();
$phone_e164  = sepehr_fact( 'phone_e164' );
$phone       = sepehr_fact( 'phone_display' );
$address     = sepehr_fact( 'address_display' );
$sessions    = (array) sepehr_fact( 'sessions', array() );
$map_url     = get_theme_mod( 'sepehr_map_url', '' );
$map_url     = $map_url ? $map_url : 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode( $address );
$guide_url   = get_theme_mod( 'sepehr_guide_url', '' );
$lead_code   = get_theme_mod( 'sepehr_lead_shortcode', '' );
$lead_link   = get_theme_mod( 'sepehr_lead_fallback', '' );
$lead_link   = $lead_link ? $lead_link : 'https://t.me/' . sepehr_fact( 'telegram' );
$ig          = sepehr_fact( 'instagram' );
$tg          = sepehr_fact( 'telegram' );
?>
<main id="main">

	<!-- Hero -->
	<section class="hero shell" aria-labelledby="hero-title">
		<div class="hero-copy">
			<p class="eyebrow"><span class="rule" aria-hidden="true"></span><?php esc_html_e( 'دوره آنلاین در سراسر ایران · کلاس حضوری در تهران', 'sepehr' ); ?></p>
			<h1 id="hero-title">آموزش کلیستنیکس؛ <span class="gold">بدنی قوی، کارآمد و خوش‌فرم بساز</span></h1>
			<p class="lead">از اولین بارفیکس و شنا تا حرکات حرفه‌ای، قدم‌به‌قدم با ویدیوی آموزشی و پشتیبانی مستقیم مربی. در خانه، پارک یا باشگاه.</p>
			<div class="actions">
				<a class="btn btn-cta btn-lg" href="<?php echo esc_url( $course_url ); ?>">دوره «<?php echo esc_html( $course_name ); ?>»<?php sepehr_icon( 'arrow', 20 ); ?></a>
				<a class="btn btn-outline btn-lg" href="#class"><?php esc_html_e( 'کلاس حضوری تهران', 'sepehr' ); ?></a>
			</div>
			<ul class="ticks">
				<li><?php sepehr_icon( 'check', 18 ); ?><?php esc_html_e( 'مناسب مبتدی تا پیشرفته', 'sepehr' ); ?></li>
				<li><?php sepehr_icon( 'check', 18 ); ?><?php esc_html_e( 'آقایان و بانوان', 'sepehr' ); ?></li>
				<li><?php sepehr_icon( 'check', 18 ); ?><?php esc_html_e( 'ویدیو + پشتیبانی', 'sepehr' ); ?></li>
			</ul>
		</div>
		<figure class="hero-media">
			<?php sepehr_media( 'sepehr_hero_image', 'sepehr-hero', 'سپهر اسماعیلی، مربی کلیستنیکس، در حال اجرای حرکت بارفیکس', '[عکس اصلی: سپهر در حال اجرای حرکت کلیستنیکس]', true ); ?>
			<figcaption class="hero-badge">
				<span class="muted-sm"><?php esc_html_e( 'مربی', 'sepehr' ); ?></span>
				<strong><?php echo esc_html( $person ); ?></strong>
				<span class="gold-sm"><?php echo esc_html( sepehr_fact( 'credential' ) ); ?></span>
			</figcaption>
		</figure>
	</section>

	<!-- Trust stats -->
	<section class="shell stats" aria-label="<?php esc_attr_e( 'سوابق مربی', 'sepehr' ); ?>">
		<div class="stat"><strong><?php echo esc_html( sepehr_fa_digits( sepehr_fact( 'sport_years', 17 ) ) ); ?>+</strong><span><?php esc_html_e( 'سال سابقه ورزشی', 'sepehr' ); ?></span></div>
		<div class="stat"><strong><?php echo esc_html( sepehr_fa_digits( sepehr_fact( 'coaching_years', 4 ) ) ); ?></strong><span><?php esc_html_e( 'سال مربیگری رسمی', 'sepehr' ); ?></span></div>
		<div class="stat"><strong>~۱۰۰</strong><span><?php esc_html_e( 'شاگرد حضوری موفق', 'sepehr' ); ?></span></div>
		<div class="stat"><strong>۵</strong><span><?php esc_html_e( 'مدال کشوری کاراته', 'sepehr' ); ?></span></div>
	</section>

	<!-- Two paths -->
	<section class="shell section" aria-labelledby="paths-title">
		<h2 id="paths-title"><?php esc_html_e( 'دوره آنلاین یا کلاس حضوری کلیستنیکس؟', 'sepehr' ); ?></h2>
		<div class="grid-2">
			<a class="path-card path-card--gold" href="#course">
				<span class="kicker"><?php esc_html_e( 'آنلاین · هر جای ایران', 'sepehr' ); ?></span>
				<span class="path-title"><?php echo esc_html( 'دوره ' . $course_name ); ?></span>
				<span class="path-text">برنامه کامل از پایه تا پیشرفته، با ویدیوی آموزشی هر حرکت و پشتیبانی مستقیم. برای <?php echo esc_html( sepehr_fact( 'course_audience' ) ); ?>.</span>
				<span class="path-more gold"><?php esc_html_e( 'مشاهده دوره', 'sepehr' ); ?> ←</span>
			</a>
			<a class="path-card" href="#class">
				<span class="kicker muted"><?php esc_html_e( 'حضوری · تهران، اوین', 'sepehr' ); ?></span>
				<span class="path-title"><?php esc_html_e( 'کلاس کلیستنیکس حضوری در تهران', 'sepehr' ); ?></span>
				<span class="path-text">تمرین زیر نظر مستقیم مربی؛ سانس استاندارد و سانس پریمیوم با برنامه شخصی‌سازی‌شده. ویژه <?php echo esc_html( sepehr_fact( 'class_audience' ) ); ?>.</span>
				<span class="path-more"><?php esc_html_e( 'روزها، ساعت‌ها و ثبت‌نام', 'sepehr' ); ?> ←</span>
			</a>
		</div>
	</section>

	<!-- What is calisthenics: answer first, quotable -->
	<section id="what" class="band-light" aria-labelledby="what-title">
		<div class="shell split-5-7">
			<div>
				<span class="bar-accent" aria-hidden="true"></span>
				<h2 id="what-title"><?php esc_html_e( 'کلیستنیکس چیست؟', 'sepehr' ); ?></h2>
			</div>
			<div class="prose-lg">
				<p><strong>کلیستنیکس (Calisthenics)</strong> ورزشی برای ساختن قدرت، فرم بدن و کنترل حرکتی با حرکاتی مثل بارفیکس، شنا، دیپ، اسکات و پلانک است. پایه‌ی آن تمرین با وزن بدن است و در سطوح پیشرفته با وزنه‌ی اضافه (Weighted Calisthenics) و مهارت‌هایی مثل ماسل‌آپ و هنداستند ادامه پیدا می‌کند.</p>
				<p>نام کلیستنیکس از دو واژه‌ی یونانی به معنی «زیبایی» و «قدرت» گرفته شده و بدون تجهیزات گران، در خانه، پارک یا باشگاه قابل انجام است.</p>
				<?php if ( $guide_url ) : ?>
					<p><a class="link-strong" href="<?php echo esc_url( $guide_url ); ?>"><?php esc_html_e( 'راهنمای کامل کلیستنیکس برای مبتدی‌ها', 'sepehr' ); ?> ←</a></p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- Online course -->
	<section id="course" class="shell section" aria-labelledby="course-title">
		<div class="course-head">
			<div class="course-intro">
				<p class="kicker gold"><?php esc_html_e( 'دوره آنلاین کلیستنیکس', 'sepehr' ); ?></p>
				<h2 id="course-title"><?php echo esc_html( $course_name ); ?></h2>
				<p class="muted">اگر مبتدی هستی نگران نباش: همه‌چیز از پایه‌ای‌ترین حالت تا پیشرفته با ویدیو توضیح داده شده و تیم پشتیبانی کنارت است. متناسب با شرایطت یکی از سه مسیر تمرینی را دنبال می‌کنی:</p>
			</div>
			<div class="price-card">
				<span class="muted-sm"><?php esc_html_e( 'قیمت دوره', 'sepehr' ); ?></span>
				<?php if ( $price ) : ?>
					<span class="price"><span class="gold"><?php echo esc_html( $price ); ?></span> <small><?php esc_html_e( 'تومان', 'sepehr' ); ?></small></span>
				<?php else : ?>
					<span class="price price--soon"><?php esc_html_e( 'به‌زودی اعلام می‌شود', 'sepehr' ); ?></span>
				<?php endif; ?>
				<a class="btn btn-cta" href="<?php echo esc_url( $course_url ); ?>"><?php echo $price ? esc_html__( 'خرید و شروع دوره', 'sepehr' ) : esc_html__( 'جزئیات و ثبت‌نام', 'sepehr' ); ?></a>
			</div>
		</div>

		<div class="grid-3">
			<article class="card">
				<span class="icon-box"><?php sepehr_icon( 'bar', 26 ); ?></span>
				<h3><?php esc_html_e( 'بدنسازی با کلیستنیکس', 'sepehr' ); ?></h3>
				<p>هم بدنت را می‌سازی و هم مهارت‌های کلیستنیکس مثل ماسل‌آپ و هنداستند را یاد می‌گیری. مناسب کسی که ژیمناستیک یا پارکور دوست دارد.</p>
			</article>
			<article class="card">
				<span class="icon-box"><?php sepehr_icon( 'home', 26 ); ?></span>
				<h3><?php esc_html_e( 'بدنسازی در خانه بدون وسیله', 'sepehr' ); ?></h3>
				<p>ساختن بدن با کمترین تجهیزات، زمان و هزینه. برای کسی که به باشگاه دسترسی ندارد، زیاد سفر می‌کند یا حوصله‌ی وزنه زدن ندارد.</p>
			</article>
			<article class="card">
				<span class="icon-box"><?php sepehr_icon( 'weight', 26 ); ?></span>
				<h3><?php esc_html_e( 'کلیستنیکس ترکیبی با وزنه', 'sepehr' ); ?></h3>
				<p>هم حجم، هم قدرت. برای کسی که باشگاه می‌رود یا در خانه وزنه دارد و از برنامه‌های تکراری خسته شده است.</p>
			</article>
		</div>

		<ul class="includes">
			<li class="includes-title"><?php esc_html_e( 'همراه هر مسیر:', 'sepehr' ); ?></li>
			<li><?php sepehr_icon( 'check', 18 ); ?><?php esc_html_e( 'برنامه‌ی غذایی متناسب با هدفت', 'sepehr' ); ?></li>
			<li><?php sepehr_icon( 'check', 18 ); ?><?php esc_html_e( 'ویدیوی آموزشی تک‌تک حرکات', 'sepehr' ); ?></li>
			<li><?php sepehr_icon( 'check', 18 ); ?><?php esc_html_e( 'پشتیبانی و پاسخ به سؤالات', 'sepehr' ); ?></li>
			<li><?php sepehr_icon( 'check', 18 ); ?><?php echo esc_html( 'مناسب ' . sepehr_fact( 'course_audience' ) ); ?></li>
		</ul>
	</section>

	<!-- In-person class -->
	<section id="class" class="band-dark" aria-labelledby="class-title">
		<div class="shell split-6-6">
			<div class="class-copy">
				<p class="kicker gold"><?php echo esc_html( 'کلاس حضوری · ویژه ' . sepehr_fact( 'class_audience' ) ); ?></p>
				<h2 id="class-title"><?php esc_html_e( 'کلاس کلیستنیکس حضوری در تهران (اوین)', 'sepehr' ); ?></h2>
				<p class="muted">آموزش اصولی کلیستنیکس با تکیه بر تقویت فاکتورهای آمادگی جسمانی، زیر نظر مستقیم <?php echo esc_html( $person ); ?>. نزدیک به <?php echo esc_html( sepehr_fact( 'nearby' ) ); ?>.</p>
				<address class="addr"><?php sepehr_icon( 'pin' ); ?><span><?php echo esc_html( $address ); ?></span></address>
				<div class="actions">
					<a class="btn btn-cta" href="tel:<?php echo esc_attr( $phone_e164 ); ?>"><?php sepehr_icon( 'phone', 20 ); ?><?php echo esc_html( 'رزرو و ثبت‌نام: ' . $phone ); ?></a>
					<a class="btn btn-ghost" href="<?php echo esc_url( $map_url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'مسیریابی', 'sepehr' ); ?></a>
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
				<figure class="class-media">
					<?php sepehr_media( 'sepehr_class_image', 'sepehr-card', 'کلاس کلیستنیکس حضوری سپهر اسماعیلی در اوین تهران', '[عکس کلاس حضوری]' ); ?>
				</figure>
			</div>
		</div>
	</section>

	<!-- Coach (E-E-A-T) -->
	<section id="coach" class="shell section split-4-8" aria-labelledby="coach-title">
		<figure class="coach-media">
			<?php sepehr_media( 'sepehr_coach_image', 'sepehr-hero', 'سپهر اسماعیلی، مربی کلیستنیکس در تهران', '[پرتره سپهر اسماعیلی]' ); ?>
		</figure>
		<div class="coach-copy">
			<p class="kicker gold"><?php esc_html_e( 'درباره مربی', 'sepehr' ); ?></p>
			<h2 id="coach-title"><?php echo esc_html( $person . '، ' . sepehr_fact( 'job_title' ) ); ?></h2>
			<p>ورزش را از ۷ سالگی با کاراته شروع کردم و در مسابقات کشوری کاراته ۵ مدال (۲ طلا و ۳ نقره) گرفتم. از نوجوانی کمک‌مربی بودم، سپس وارد پارکور شدم و کلیستنیکس همیشه ستون اصلی تمرین‌هایم بوده است.</p>
			<p>از ۴ سال پیش با <?php echo esc_html( sepehr_fact( 'credential' ) ); ?> به‌طور حرفه‌ای مربیگری می‌کنم و دانش تخصصی‌ام در کلیستنیکس را با مطالعه‌ی مستمر متدها، پژوهش‌ها و منابع مربیان و ورزشکاران سطح اول جهان به‌روز نگه می‌دارم. تا امروز نزدیک به ۱۰۰ شاگرد حضوری با من به هدفشان رسیده‌اند.</p>
			<p class="muted">هدفم این است که هر کسی، از هر سطحی، بتواند بدنی قوی، کارآمد و خوش‌فرم بسازد؛ با برنامه‌ای اصولی که قدم‌به‌قدم پیش می‌رود.</p>
			<p class="social">
				<?php if ( $ig ) : ?><a href="<?php echo esc_url( 'https://instagram.com/' . $ig ); ?>" rel="me noopener" target="_blank"><?php esc_html_e( 'اینستاگرام', 'sepehr' ); ?> <span dir="ltr">@<?php echo esc_html( $ig ); ?></span></a><?php endif; ?>
				<?php if ( $tg ) : ?><a href="<?php echo esc_url( 'https://t.me/' . $tg ); ?>" rel="me noopener" target="_blank"><?php esc_html_e( 'تلگرام', 'sepehr' ); ?> <span dir="ltr">@<?php echo esc_html( $tg ); ?></span></a><?php endif; ?>
			</p>
		</div>
	</section>

	<!-- Free starter program (the one orange moment) -->
	<section class="shell" aria-labelledby="free-title">
		<div class="lead-box">
			<div>
				<h2 id="free-title"><?php esc_html_e( 'برنامه کلیستنیکس در خانه برای مبتدی — رایگان', 'sepehr' ); ?></h2>
				<p><?php esc_html_e( 'یک هفته تمرین مبتدی بدون وسیله، مستقیم برای خودت.', 'sepehr' ); ?></p>
			</div>
			<div class="lead-form">
				<?php if ( $lead_code ) : ?>
					<?php echo do_shortcode( $lead_code ); // phpcs:ignore WordPress.Security.EscapeOutput -- sanitized shortcode from Customizer. ?>
				<?php else : ?>
					<a class="btn btn-dark btn-lg" href="<?php echo esc_url( $lead_link ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'دریافت برنامه رایگان', 'sepehr' ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- FAQ: each heading is a question people really ask; answer in the first sentence -->
	<section id="faq" class="shell section split-4-8" aria-labelledby="faq-title">
		<div>
			<span class="bar-accent" aria-hidden="true"></span>
			<h2 id="faq-title"><?php esc_html_e( 'سؤالات متداول درباره کلیستنیکس', 'sepehr' ); ?></h2>
		</div>
		<div class="faq">
			<div class="faq-item">
				<h3>آیا کلیستنیکس در خانه بدون وسیله جواب می‌دهد؟</h3>
				<p>بله. با حرکاتی مثل شنا، اسکات، لانج، دیپ روی صندلی و پلانک می‌شود در خانه قدرت و فرم بدن را ساخت. برای پیشرفت بیشتر، یک میله‌ی بارفیکس کافی است.</p>
			</div>
			<div class="faq-item">
				<h3>کلیستنیکس برای مبتدی‌ها مناسب است؟ از کجا شروع کنم؟</h3>
				<p>بله. کلیستنیکس از ساده‌ترین نسخه‌ی هر حرکت شروع می‌شود و قدم‌به‌قدم سخت‌تر می‌شود. دوره‌ی «<?php echo esc_html( $course_name ); ?>» دقیقاً از همین نقطه شروع می‌کند و هر حرکت با ویدیو آموزش داده شده است.</p>
			</div>
			<div class="faq-item">
				<h3>کلیستنیکس بهتر است یا بدنسازی با وزنه؟</h3>
				<p>هر کدام هدف خودش را دارد: کلیستنیکس قدرت کاربردی، کنترل بدن و فرم متناسب می‌سازد و همه‌جا قابل انجام است؛ وزنه برای حجم‌گیری سریع‌تر است. مسیر ترکیبی دوره هر دو را با هم دارد.</p>
			</div>
			<div class="faq-item">
				<h3>بهترین دوره‌ی کلیستنیکس فارسی را چطور انتخاب کنم؟</h3>
				<p>دوره‌ای انتخاب کنید که مربی آن مدرک رسمی و سابقه‌ی واقعی شاگرد داشته باشد، برای هر حرکت ویدیوی آموزشی داشته باشد، پیشرفت را مرحله‌به‌مرحله برنامه‌ریزی کند و پشتیبانی برای پاسخ به سؤال‌ها داشته باشد.</p>
			</div>
			<div class="faq-item">
				<h3>دوره‌ی آنلاین کلیستنیکس برای بانوان هم مناسب است؟</h3>
				<p>بله، دوره‌ی آنلاین برای <?php echo esc_html( sepehr_fact( 'course_audience' ) ); ?> طراحی شده است. کلاس‌های حضوری اوین در حال حاضر ویژه‌ی <?php echo esc_html( sepehr_fact( 'class_audience' ) ); ?> است.</p>
			</div>
			<div class="faq-item">
				<h3>کلاس کلیستنیکس حضوری در تهران کجا و چه ساعتی است؟</h3>
				<p>
					<?php echo esc_html( $address ); ?>.
					<?php foreach ( $sessions as $s ) : ?>
						<?php echo esc_html( $s['name'] . ': ' . $s['days_label'] . '، ' . $s['time_label'] . '.' ); ?>
					<?php endforeach; ?>
					<?php echo esc_html( 'رزرو: ' . $phone ); ?>
				</p>
			</div>
		</div>
	</section>

	<div class="shell"><?php sepehr_updated_line(); ?></div>
</main>
<?php
get_footer();
