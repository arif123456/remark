<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package remark
 */

get_header();

/**
 * Breadcrumbs
 *
 * @since 1.0.0
 */
remark_breadcrumbs();

?>

	<main id="primary" class="site-main">

		<div class="container">
			<div class="flex-none md:flex lg:flex gap-10 pt-8 md:p-10 lg:p-10">
				<div class="w-full md:w-3/4 lg:w-3/4">
					<?php if ( have_posts() ) : ?>

						<header class="page-header bg-gray-200 p-4">
							<h1 class="page-title">
								<?php
								/* translators: %s: search query. */
								printf( esc_html__( 'Search Results for: %s', 'remark' ), '<span>' . get_search_query() . '</span>' );
								?>
							</h1>
						</header><!-- .page-header -->

						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );

						endwhile;

						the_posts_pagination( array(
							'prev_text' => __( 'Prev', 'remark' ),
							'next_text' => __( 'Next', 'remark' ),
						) );

						else :

						get_template_part( 'template-parts/content', 'none' );

						endif;
						?>
				</div>
				<div class="w-full md:w-1/4 lg:w-1/4 pt-8 md:pt-0 lg:pt-0">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
