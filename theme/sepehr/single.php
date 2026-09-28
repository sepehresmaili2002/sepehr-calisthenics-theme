<?php
/**
 * Single article. Visible author, credentials and dates: the E-E-A-T signals
 * search engines and AI assistants look for before quoting a page.
 *
 * @package sepehr
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<main id="main" class="shell">
		<article <?php post_class(); ?>>
			<header class="page-head">
				<h1><?php the_title(); ?></h1>
				<p class="byline">
					<span><?php esc_html_e( 'نویسنده:', 'sepehr' ); ?> <a href="<?php echo esc_url( home_url( '/#coach' ) ); ?>" rel="author"><?php echo esc_html( sepehr_fact( 'person_name', get_the_author() ) ); ?></a></span>
					<span><?php esc_html_e( 'انتشار:', 'sepehr' ); ?> <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></span>
					<?php if ( get_the_modified_time( 'U' ) > get_the_time( 'U' ) + DAY_IN_SECONDS ) : ?>
						<span><?php esc_html_e( 'به‌روزرسانی:', 'sepehr' ); ?> <time datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php echo esc_html( get_the_modified_date() ); ?></time></span>
					<?php endif; ?>
				</p>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<figure class="entry-media"><?php the_post_thumbnail( 'large', array( 'loading' => 'eager', 'fetchpriority' => 'high' ) ); ?></figure>
			<?php endif; ?>

			<div class="entry">
				<?php the_content(); ?>

				<aside class="author-box" aria-label="<?php esc_attr_e( 'درباره نویسنده', 'sepehr' ); ?>">
					<div>
						<strong><?php echo esc_html( sepehr_fact( 'person_name' ) . '، ' . sepehr_fact( 'job_title' ) ); ?></strong>
						<p><?php echo esc_html( sepehr_fact( 'credential' ) . '. ' . sepehr_fact( 'students_label' ) . ' شاگرد حضوری. ' ); ?><a href="<?php echo esc_url( home_url( '/#coach' ) ); ?>"><?php esc_html_e( 'بیشتر درباره مربی', 'sepehr' ); ?></a></p>
					</div>
				</aside>
			</div>
		</article>
		<?php
		if ( comments_open() || get_comments_number() ) {
			echo '<div class="entry">';
			comments_template();
			echo '</div>';
		}
		?>
	</main>
	<?php
endwhile;

get_footer();
