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
			<div class="remark-search-wrap flex-none md:flex lg:flex gap-9 pt-16 pb-10 md:pb-16 lg:pb-24">
				<div class="remar-search-content w-full md:w-3/4 lg:w-3/4">
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
							?>

							<?php get_template_part( 'template-parts/content', 'search' ); ?>

						<?php endwhile; ?>

						<?php 
						the_posts_pagination( array(
							'prev_text' => __( 'Prev', 'remark' ),
							'next_text' => __( 'Next', 'remark' ),
						) ); 
						?>

					<?php else : ?>

						<?php 
						get_template_part( 'template-parts/content', 'none' ); 
						?>

					<?php endif; ?>
				</div>
				<div class="remark__search-sidebar w-full md:w-1/4 lg:w-1/4 pt-8 md:pt-0 lg:pt-0">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
