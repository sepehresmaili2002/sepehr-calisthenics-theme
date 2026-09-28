<?php
/**
 * Site footer. Name, address and phone here match the schema exactly (NAP consistency).
 *
 * @package sepehr
 */

defined( 'ABSPATH' ) || exit;

$ig = sepehr_fact( 'instagram' );
$tg = sepehr_fact( 'telegram' );
?>
<footer class="site-footer">
	<div class="shell footer-grid">
		<div class="footer-about">
			<span class="brand-mark" lang="en">SEPEHR ESMAEILY</span>
			<p><?php echo esc_html( sepehr_fact( 'tagline' ) ); ?>، <?php esc_html_e( 'زیر نظر', 'sepehr' ); ?> <?php echo esc_html( sepehr_fact( 'person_name' ) ); ?>.</p>
		</div>

		<nav class="footer-links" aria-label="<?php esc_attr_e( 'دسترسی سریع', 'sepehr' ); ?>">
			<h2 class="footer-title"><?php esc_html_e( 'دسترسی سریع', 'sepehr' ); ?></h2>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'container'      => false,
				'menu_class'     => 'footer-list',
				'depth'          => 1,
				'fallback_cb'    => 'sepehr_fallback_menu',
			) );
			?>
		</nav>

		<div class="footer-contact">
			<h2 class="footer-title"><?php esc_html_e( 'تماس و آدرس', 'sepehr' ); ?></h2>
			<address>
				<span><?php echo esc_html( sepehr_fact( 'address_display' ) ); ?></span>
				<a href="tel:<?php echo esc_attr( sepehr_fact( 'phone_e164' ) ); ?>"><?php echo esc_html( sepehr_fact( 'phone_display' ) ); ?></a>
			</address>
		</div>

		<div class="footer-social">
			<h2 class="footer-title"><?php esc_html_e( 'شبکه‌های اجتماعی', 'sepehr' ); ?></h2>
			<?php if ( $ig ) : ?>
				<a href="<?php echo esc_url( 'https://instagram.com/' . $ig ); ?>" rel="me noopener" target="_blank"><?php esc_html_e( 'اینستاگرام', 'sepehr' ); ?> <span dir="ltr">@<?php echo esc_html( $ig ); ?></span></a>
			<?php endif; ?>
			<?php if ( $tg ) : ?>
				<a href="<?php echo esc_url( 'https://t.me/' . $tg ); ?>" rel="me noopener" target="_blank"><?php esc_html_e( 'تلگرام', 'sepehr' ); ?> <span dir="ltr">@<?php echo esc_html( $tg ); ?></span></a>
			<?php endif; ?>
		</div>
	</div>
	<div class="shell footer-bottom">
		<span>© <?php echo esc_html( sepehr_fa_digits( wp_date( 'Y' ) ) ); ?> <?php echo esc_html( sepehr_fact( 'site_name', get_bloginfo( 'name' ) ) ); ?></span>
	</div>
</footer>
<script>
(function(){var b=document.querySelector('.nav-btn'),n=document.getElementById('site-nav');if(!b||!n)return;
b.addEventListener('click',function(){var o=n.classList.toggle('is-open');b.setAttribute('aria-expanded',o?'true':'false');});
n.addEventListener('click',function(e){if(e.target.closest('a')){n.classList.remove('is-open');b.setAttribute('aria-expanded','false');}});})();
</script>
<?php wp_footer(); ?>
</body>
</html>
