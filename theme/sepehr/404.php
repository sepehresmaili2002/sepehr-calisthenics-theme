<?php
/**
 * Not found.
 *
 * @package sepehr
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main" class="shell section">
	<h1><?php esc_html_e( 'این صفحه پیدا نشد', 'sepehr' ); ?></h1>
	<p class="muted"><?php esc_html_e( 'شاید آدرس تغییر کرده باشد. از اینجا ادامه بده:', 'sepehr' ); ?></p>
	<div class="actions">
		<a class="btn btn-cta" href="<?php echo esc_url( function_exists( 'sepehr_course_url' ) ? sepehr_course_url() : home_url( '/#course' ) ); ?>"><?php esc_html_e( 'دوره آنلاین کلیستنیکس', 'sepehr' ); ?></a>
		<a class="btn btn-outline" href="<?php echo esc_url( home_url( '/#class' ) ); ?>"><?php esc_html_e( 'کلاس حضوری تهران', 'sepehr' ); ?></a>
		<a class="btn btn-ghost" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'صفحه اصلی', 'sepehr' ); ?></a>
	</div>
</main>
<?php
get_footer();
