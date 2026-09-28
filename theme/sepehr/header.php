<?php
/**
 * Site header.
 *
 * @package sepehr
 */

defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>document.documentElement.classList.add('js')</script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e( 'رفتن به محتوای اصلی', 'sepehr' ); ?></a>

<header class="site-header">
	<div class="shell header-row">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php if ( has_custom_logo() ) : ?>
				<?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'medium', false, array( 'class' => 'brand-logo', 'alt' => sepehr_fact( 'site_name', get_bloginfo( 'name' ) ) ) ); ?>
			<?php else : ?>
				<span class="brand-mark" lang="en">SEPEHR ESMAEILY</span>
			<?php endif; ?>
			<span class="brand-sub"><?php echo esc_html( sepehr_fact( 'job_title', get_bloginfo( 'description' ) ) ); ?></span>
		</a>

		<button class="nav-btn" type="button" aria-expanded="false" aria-controls="site-nav" aria-label="<?php esc_attr_e( 'منو', 'sepehr' ); ?>"><?php sepehr_icon( 'menu', 26 ); ?></button>
		<nav id="site-nav" class="site-nav" aria-label="<?php esc_attr_e( 'منوی اصلی', 'sepehr' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'nav-list',
				'depth'          => 1,
				'fallback_cb'    => 'sepehr_fallback_menu',
			) );
			?>
		</nav>

		<div class="header-actions">
			<?php if ( function_exists( 'wc_get_cart_url' ) ) : ?>
				<a class="icon-btn" href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="<?php esc_attr_e( 'سبد خرید', 'sepehr' ); ?>"><?php sepehr_icon( 'cart' ); ?></a>
			<?php endif; ?>
			<a class="btn btn-cta btn-sm" href="<?php echo esc_url( function_exists( 'sepehr_course_url' ) ? sepehr_course_url() : home_url( '/#course' ) ); ?>"><?php esc_html_e( 'شروع دوره', 'sepehr' ); ?></a>
		</div>
	</div>
</header>
