<?php
/**
 * Front page. Hand-built, server-rendered markup: every answer an AI assistant
 * might quote is plain HTML text, one clear heading per question.
 * Tone: friendly, semi-formal Persian; facts stated plainly in the first sentence.
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
			<p class="eyebrow"><span class="rule" aria-hidden="true"></span>دوره آنلاین در سراسر ایران · کلاس حضوری در تهران</p>
			<h1 id="hero-title">آموزش کلیستنیکس؛ <span class="gold">بدنی قوی، کارآمد و خوش‌فرم بساز</span></h1>
			<p class="lead">از اولین بارفیکس و شنا تا حرکت‌های حرفه‌ای، قدم‌به‌قدم با ویدیوی آموزشی و پشتیبانی مستقیم مربی. توی خونه، پارک یا باشگاه.</p>
			<div class="actions">
				<a class="btn btn-cta btn-lg" href="<?php echo esc_url( $course_url ); ?>">دوره «<?php echo esc_html( $course_name ); ?>»<?php sepehr_icon( 'arrow', 20 ); ?></a>
				<a class="btn btn-outline btn-lg" href="#class">کلاس حضوری تهران</a>
			</div>
			<ul class="ticks">
				<li><?php sepehr_icon( 'check', 18 ); ?>مناسب مبتدی تا پیشرفته</li>
				<li><?php sepehr_icon( 'check', 18 ); ?>آقایان و بانوان</li>
				<li><?php sepehr_icon( 'check', 18 ); ?>ویدیو + پشتیبانی</li>
			</ul>
		</div>
		<figure class="hero-media">
			<?php sepehr_media( 'sepehr_hero_image', 'sepehr-hero', 'سپهر اسماعیلی، مربی کلیستنیکس، در حال اجرای حرکت بارفیکس', '[عکس اصلی: سپهر در حال اجرای حرکت کلیستنیکس]', true ); ?>
			<figcaption class="hero-badge">
				<span class="muted-sm">مربی</span>
				<strong><?php echo esc_html( $person ); ?></strong>
				<span class="gold-sm"><?php echo esc_html( sepehr_fact( 'credential' ) ); ?></span>
			</figcaption>
		</figure>
	</section>

	<!-- Trust stats -->
	<section class="shell stats" aria-label="سوابق مربی">
		<div class="stat"><strong><?php echo esc_html( sepehr_fa_digits( sepehr_fact( 'sport_years', 17 ) ) ); ?>+</strong><span>سال سابقه ورزشی</span></div>
		<div class="stat"><strong><?php echo esc_html( sepehr_fa_digits( sepehr_fact( 'coaching_years', 4 ) ) ); ?></strong><span>سال مربیگری رسمی</span></div>
		<div class="stat"><strong>~۱۰۰</strong><span>شاگرد حضوری موفق</span></div>
		<div class="stat"><strong>۳</strong><span>مسیر تمرینی در دوره آنلاین</span></div>
	</section>

	<!-- Three ways to train -->
	<section class="shell section" aria-labelledby="paths-title">
		<h2 id="paths-title">دوره آنلاین، کلاس حضوری یا تمرین خصوصی؟</h2>
		<div class="grid-3 paths">
			<a class="path-card path-card--gold" href="#course">
				<span class="kicker">آنلاین · هر جای ایران</span>
				<span class="path-title"><?php echo esc_html( 'دوره ' . $course_name ); ?></span>
				<span class="path-text">برنامه‌ی کامل از صفر تا پیشرفته، با ویدیوی آموزشی هر حرکت و پشتیبانی مستقیم. هم برای آقایون، هم برای خانم‌ها.</span>
				<span class="path-more gold">مشاهده دوره ←</span>
			</a>
			<a class="path-card" href="#class">
				<span class="kicker muted">حضوری · تهران، اوین</span>
				<span class="path-title">کلاس کلیستنیکس حضوری در تهران</span>
				<span class="path-text">تمرین زیر نظر مستقیم مربی؛ سانس استاندارد و سانس پریمیوم با برنامه‌ی شخصی‌سازی‌شده. ویژه‌ی آقایون.</span>
				<span class="path-more">روزها، ساعت‌ها و ثبت‌نام ←</span>
			</a>
			<a id="vip" class="path-card path-card--vip" href="tel:<?php echo esc_attr( $phone_e164 ); ?>">
				<span class="kicker">یک‌به‌یک · اختصاصی</span>
				<span class="path-title"><?php echo esc_html( sepehr_fact( 'vip_name' ) ); ?></span>
				<span class="path-text">جلسه‌های یک‌به‌یک با خود سپهر؛ برنامه‌ی کاملاً اختصاصی، اصلاح دقیق فرم حرکت‌ها و پیگیری نزدیک تا وقتی به هدفت برسی.</span>
				<span class="path-more gold">هماهنگی و رزرو: <?php echo esc_html( $phone ); ?></span>
			</a>
		</div>
	</section>

	<!-- What is calisthenics: answer first, quotable -->
	<section id="what" class="band-light" aria-labelledby="what-title">
		<div class="shell split-5-7">
			<div>
				<span class="bar-accent" aria-hidden="true"></span>
				<h2 id="what-title">کلیستنیکس چیست؟</h2>
			</div>
			<div class="prose-lg">
				<p><strong>کلیستنیکس (Calisthenics)</strong> یعنی ساختن قدرت، فرم بدن و کنترل حرکتی با حرکت‌هایی مثل بارفیکس، شنا، دیپ، اسکات و پلانک. پایه‌اش تمرین با وزن بدنه و توی سطح پیشرفته با وزنه‌ی اضافه (Weighted Calisthenics) و مهارت‌هایی مثل ماسل‌آپ و هنداستند ادامه پیدا می‌کنه.</p>
				<p>اسمش از دو کلمه‌ی یونانی به معنی «زیبایی» و «قدرت» اومده و تقریباً هر جایی قابل انجامه: خونه، پارک یا باشگاه.</p>
				<?php if ( $guide_url ) : ?>
					<p><a class="link-strong" href="<?php echo esc_url( $guide_url ); ?>">راهنمای کامل کلیستنیکس برای مبتدی‌ها ←</a></p>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- Online course -->
	<section id="course" class="shell section" aria-labelledby="course-title">
		<div class="course-head">
			<div class="course-intro">
				<p class="kicker gold">دوره آنلاین کلیستنیکس</p>
				<h2 id="course-title"><?php echo esc_html( $course_name ); ?></h2>
				<p class="muted">اگه مبتدی هستی نگران نباش: همه‌چیز از پایه‌ای‌ترین حالت تا پیشرفته با ویدیو توضیح داده شده و تیم پشتیبانی کنارته. بسته به شرایطت، یکی از این سه مسیر رو دنبال می‌کنی:</p>
			</div>
			<div class="price-card">
				<span class="muted-sm">قیمت دوره</span>
				<?php if ( $price ) : ?>
					<span class="price"><span class="gold"><?php echo esc_html( $price ); ?></span> <small>تومان</small></span>
				<?php else : ?>
					<span class="price price--soon">به‌زودی اعلام می‌شه</span>
				<?php endif; ?>
				<a class="btn btn-cta" href="<?php echo esc_url( $course_url ); ?>"><?php echo $price ? 'خرید و شروع دوره' : 'جزئیات و ثبت‌نام'; ?></a>
			</div>
		</div>

		<div class="grid-3">
			<article class="card">
				<span class="icon-box"><?php sepehr_icon( 'bar', 26 ); ?></span>
				<h3>بدنسازی با کلیستنیکس</h3>
				<p>هم بدنت رو می‌سازی، هم مهارت‌های کلیستنیکس مثل ماسل‌آپ و هنداستند رو یاد می‌گیری. مخصوص کسی که ژیمناستیک یا پارکور رو دوست داره.</p>
			</article>
			<article class="card">
				<span class="icon-box"><?php sepehr_icon( 'home', 26 ); ?></span>
				<h3>بدنسازی در خانه بدون وسیله</h3>
				<p>ساختن بدن با کمترین تجهیزات، زمان و هزینه. برای وقتی که به باشگاه دسترسی نداری، زیاد سفر می‌ری یا حوصله‌ی وزنه زدن نداری.</p>
			</article>
			<article class="card">
				<span class="icon-box"><?php sepehr_icon( 'weight', 26 ); ?></span>
				<h3>کلیستنیکس ترکیبی با وزنه</h3>
				<p>هم حجم، هم قدرت. برای کسی که باشگاه می‌ره یا توی خونه وزنه داره و از برنامه‌های تکراری خسته شده.</p>
			</article>
		</div>

		<ul class="includes">
			<li class="includes-title">همراه هر مسیر:</li>
			<li><?php sepehr_icon( 'check', 18 ); ?>برنامه‌ی غذایی متناسب با هدفت</li>
			<li><?php sepehr_icon( 'check', 18 ); ?>ویدیوی آموزشی تک‌تک حرکت‌ها</li>
			<li><?php sepehr_icon( 'check', 18 ); ?>پشتیبانی و جواب سؤال‌هات</li>
			<li><?php sepehr_icon( 'check', 18 ); ?>مناسب آقایون و خانم‌ها</li>
		</ul>
	</section>

	<!-- In-person class -->
	<section id="class" class="band-dark" aria-labelledby="class-title">
		<div class="shell split-6-6">
			<div class="class-copy">
				<p class="kicker gold"><?php echo esc_html( 'کلاس حضوری · ویژه ' . sepehr_fact( 'class_audience' ) ); ?></p>
				<h2 id="class-title">کلاس کلیستنیکس حضوری در تهران (اوین)</h2>
				<p class="muted">آموزش اصولی کلیستنیکس با تمرکز روی تقویت فاکتورهای آمادگی جسمانی، زیر نظر مستقیم <?php echo esc_html( $person ); ?>. نزدیک به <?php echo esc_html( sepehr_fact( 'nearby' ) ); ?>.</p>
				<address class="addr"><?php sepehr_icon( 'pin' ); ?><span><?php echo esc_html( $address ); ?></span></address>
				<div class="actions">
					<a class="btn btn-cta" href="tel:<?php echo esc_attr( $phone_e164 ); ?>"><?php sepehr_icon( 'phone', 20 ); ?><?php echo esc_html( 'رزرو و ثبت‌نام: ' . $phone ); ?></a>
					<a class="btn btn-ghost" href="<?php echo esc_url( $map_url ); ?>" target="_blank" rel="noopener">مسیریابی</a>
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

	<!-- Coach (E-E-A-T), third person -->
	<section id="coach" class="shell section split-4-8" aria-labelledby="coach-title">
		<figure class="coach-media">
			<?php sepehr_media( 'sepehr_coach_image', 'sepehr-hero', 'سپهر اسماعیلی، مربی کلیستنیکس در تهران', '[پرتره سپهر اسماعیلی]' ); ?>
		</figure>
		<div class="coach-copy">
			<p class="kicker gold">درباره مربی</p>
			<h2 id="coach-title"><?php echo esc_html( $person . '، ' . sepehr_fact( 'job_title' ) ); ?></h2>
			<p><?php echo esc_html( $person ); ?> ورزش رو از ۷ سالگی با کاراته شروع کرد و از نوجوونی کمک‌مربی بود. بعدتر سراغ پارکور رفت و کلیستنیکس همیشه ستون اصلی تمرین‌هاش بوده.</p>
			<p>از ۴ سال پیش با <?php echo esc_html( sepehr_fact( 'credential' ) ); ?> به‌صورت حرفه‌ای مربیگری می‌کنه و دانش تخصصیش در کلیستنیکس رو با مطالعه‌ی مداوم متدها، پژوهش‌ها و منابع مربی‌ها و ورزشکارهای سطح اول دنیا به‌روز نگه می‌داره. تا امروز نزدیک به ۱۰۰ شاگرد حضوری با کمک سپهر به هدفشون رسیدن.</p>
			<p class="muted">هدفش اینه که هر کسی، از هر سطحی، بتونه یه بدن قوی، کارآمد و خوش‌فرم بسازه؛ با برنامه‌ای اصولی که قدم‌به‌قدم جلو می‌ره.</p>
			<p class="social">
				<?php if ( $ig ) : ?><a href="<?php echo esc_url( 'https://instagram.com/' . $ig ); ?>" rel="me noopener" target="_blank">اینستاگرام <span dir="ltr">@<?php echo esc_html( $ig ); ?></span></a><?php endif; ?>
				<?php if ( $tg ) : ?><a href="<?php echo esc_url( 'https://t.me/' . $tg ); ?>" rel="me noopener" target="_blank">تلگرام <span dir="ltr">@<?php echo esc_html( $tg ); ?></span></a><?php endif; ?>
			</p>
		</div>
	</section>

	<!-- Free starter program (the one orange moment) -->
	<section class="shell" aria-labelledby="free-title">
		<div class="lead-box">
			<div>
				<h2 id="free-title">برنامه کلیستنیکس در خانه برای مبتدی — رایگان</h2>
				<p>یه هفته تمرین مبتدی بدون وسیله، مستقیم برای خودت.</p>
			</div>
			<div class="lead-form">
				<?php if ( $lead_code ) : ?>
					<?php echo do_shortcode( $lead_code ); // phpcs:ignore WordPress.Security.EscapeOutput -- sanitized shortcode from Customizer. ?>
				<?php else : ?>
					<a class="btn btn-dark btn-lg" href="<?php echo esc_url( $lead_link ); ?>" target="_blank" rel="noopener">دریافت برنامه رایگان</a>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- FAQ: each heading is a question people really ask; the first sentence is the answer -->
	<section id="faq" class="shell section split-4-8" aria-labelledby="faq-title">
		<div>
			<span class="bar-accent" aria-hidden="true"></span>
			<h2 id="faq-title">سؤالات متداول درباره کلیستنیکس</h2>
		</div>
		<div class="faq">
			<div class="faq-item">
				<h3>کلیستنیکس در خانه بدون وسیله جواب می‌ده؟</h3>
				<p>آره. با حرکت‌هایی مثل شنا، اسکات، لانج، دیپ روی صندلی و پلانک می‌شه توی خونه قدرت و فرم بدن رو ساخت. برای پیشرفت بیشتر، یه میله‌ی بارفیکس کافیه.</p>
			</div>
			<div class="faq-item">
				<h3>کلیستنیکس برای مبتدی‌ها مناسبه؟ از کجا شروع کنم؟</h3>
				<p>آره. کلیستنیکس از ساده‌ترین نسخه‌ی هر حرکت شروع می‌شه و قدم‌به‌قدم سخت‌تر می‌شه. دوره‌ی «<?php echo esc_html( $course_name ); ?>» دقیقاً از همین نقطه شروع می‌کنه و هر حرکت با ویدیو آموزش داده شده.</p>
			</div>
			<div class="faq-item">
				<h3>کلیستنیکس بهتره یا بدنسازی با وزنه؟</h3>
				<p>هر کدوم هدف خودش رو داره: کلیستنیکس قدرت کاربردی، کنترل بدن و فرم متناسب می‌سازه و همه‌جا قابل انجامه؛ وزنه برای حجم‌گیری سریع‌تره. مسیر ترکیبی دوره هر دو رو با هم داره.</p>
			</div>
			<div class="faq-item">
				<h3>بهترین دوره‌ی کلیستنیکس فارسی رو چطور انتخاب کنم؟</h3>
				<p>دوره‌ای رو انتخاب کن که مربیش مدرک رسمی و سابقه‌ی واقعی شاگرد داشته باشه، برای هر حرکت ویدیوی آموزشی داشته باشه، پیشرفتت رو مرحله‌به‌مرحله برنامه‌ریزی کنه و پشتیبانی برای جواب دادن به سؤال‌هات داشته باشه.</p>
			</div>
			<div class="faq-item">
				<h3>دوره‌ی آنلاین کلیستنیکس برای خانم‌ها هم مناسبه؟</h3>
				<p>آره، دوره‌ی آنلاین برای <?php echo esc_html( sepehr_fact( 'course_audience' ) ); ?> طراحی شده. کلاس‌های حضوری اوین فعلاً ویژه‌ی <?php echo esc_html( sepehr_fact( 'class_audience' ) ); ?> است.</p>
			</div>
			<div class="faq-item">
				<h3>تمرین خصوصی VIP با کلاس حضوری چه فرقی داره؟</h3>
				<p>توی تمرین خصوصی VIP فقط خودت و مربی هستین: برنامه کاملاً برای بدن و هدف تو طراحی می‌شه و فرم تک‌تک حرکت‌هات از نزدیک اصلاح می‌شه. برای هماهنگی با <?php echo esc_html( $phone ); ?> تماس بگیر.</p>
			</div>
			<div class="faq-item">
				<h3>کلاس کلیستنیکس حضوری در تهران کجاست و چه ساعتیه؟</h3>
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
