<?php
/**
 * Fallback template: blog, archives, search.
 *
 * @package sepehr
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="main" class="shell">
	<header class="page-head">
		<h1>
			<?php
			if ( is_search() ) {
				/* translators: %s: search query */
				printf( esc_html__( 'نتایج جستجو برای «%s»', 'sepehr' ), esc_html( get_search_query() ) );
			} elseif ( is_archive() ) {
				echo esc_html( wp_strip_all_tags( get_the_archive_title() ) );
			} else {
				esc_html_e( 'مقالات کلیستنیکس', 'sepehr' );
			}
			?>
		</h1>
		<?php if ( is_archive() && get_the_archive_description() ) : ?>
			<div class="muted"><?php echo wp_kses_post( get_the_archive_description() ); ?></div>
		<?php endif; ?>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="post-list">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<a class="post-card" href="<?php the_permalink(); ?>">
					<h2 class="path-title"><?php the_title(); ?></h2>
					<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 32 ) ); ?></p>
				</a>
			<?php endwhile; ?>
		</div>
		<nav class="pagination" aria-label="<?php esc_attr_e( 'صفحه‌بندی', 'sepehr' ); ?>">
			<?php echo wp_kses_post( paginate_links( array( 'prev_text' => '→', 'next_text' => '←' ) ) ); ?>
		</nav>
	<?php else : ?>
		<p class="entry"><?php esc_html_e( 'مطلبی پیدا نشد.', 'sepehr' ); ?></p>
	<?php endif; ?>
</main>
<?php
get_footer();
