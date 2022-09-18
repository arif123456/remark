<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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

	<main id="primary" class="site-main pb-10 md:pb-16 lg:pb-20">

		<div class="container mx-auto">

			<div class="flex-none md:flex lg:flex gap-9 pt-16">

				<div class="w-full md:w-3/4 lg:w-3/4">
					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'single' );

						the_post_navigation(
							array(
								'prev_text' => '<span class="nav-subtitle font-bold	text-slate-700 hover:text-[#BB0000] pl-8"><span class="mr-2" aria-hidden="true">&larr;</span>' . esc_html__( 'Previous:', 'remark' ),
								'next_text' => '<span class="nav-subtitle font-bold	text-slate-700 hover:text-[#BB0000] pr-8">' . esc_html__( 'Next:', 'remark' ) . '<span class="ml-2" aria-hidden="true">&rarr;</span>',
							)
						);

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
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
