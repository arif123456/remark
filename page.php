<?php
/**
 * The template for displaying all pages
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
		<div class="container mx-auto">
			<div class="gap-10 py-10">
				<div class="w-full">
					<div class="bg-white p-10 pt-2">
						<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content', 'page' );

						endwhile; // End of the loop.
						?>
					</div>
				</div>
			</div>
		</div>

	</main><!-- #main -->

<?php
get_footer();
