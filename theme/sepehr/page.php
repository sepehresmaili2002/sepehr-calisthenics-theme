<?php
/**
 * Pages. Three layouts:
 *  - WooCommerce cart / checkout / account → light "paper" card (third-party UI stays legible)
 *  - Elementor-built pages → full width, Elementor controls the design
 *  - everything else → readable article column
 *
 * @package sepehr
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	$is_shop_page = function_exists( 'is_cart' ) && ( is_cart() || is_checkout() || is_account_page() );
	$is_elementor = 'builder' === get_post_meta( get_the_ID(), '_elementor_edit_mode', true );

	if ( $is_elementor ) :
		?>
		<main id="main" class="elementor-page-wrap"><?php the_content(); ?></main>
		<?php
	elseif ( $is_shop_page ) :
		?>
		<main id="main" class="shell paper-wrap">
			<h1 class="page-head"><?php the_title(); ?></h1>
			<div class="paper"><?php the_content(); ?></div>
		</main>
		<?php
	else :
		?>
		<main id="main" class="shell">
			<header class="page-head">
				<h1><?php the_title(); ?></h1>
				<?php sepehr_updated_line(); ?>
			</header>
			<div class="entry"><?php the_content(); ?></div>
		</main>
		<?php
	endif;
endwhile;

get_footer();
