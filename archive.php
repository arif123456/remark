<?php
/**
 * The template for displaying archive pages
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

	<main id="primary" class="site-main pb-12">
		<div class="container">
			<div class="flex-none md:flex lg:flex gap-9 pt-8 md:pt-12 lg:pt-16">
				<div class="w-full md:w-3/4 lg:w-3/4">
					<?php if ( have_posts() ) : ?>

						<header class="bg-[#f7f7f7] p-4">
							<?php
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="archive-description">', '</div>' );
							?>
						</header><!-- .page-header -->

						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							get_template_part( 'template-parts/content', get_post_type() );

						endwhile;

						the_posts_pagination();

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
