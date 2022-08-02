<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package remark
 */

get_header();
?>

	<main id="primary" class="site-main container">

		<section class="error-404 not-found bg-white my-24 pt-16 pb-24 px-16 text-center">
			<header class="page-header">
				<h1 class="page-title text-4xl font-bold text-slate-800"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'remark' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p class="text-xl font-semibold"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'remark' ); ?></p>

					<?php
					get_search_form();

					?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
