<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package remark
 */

get_header();

$remark_single_post_layout = get_theme_mod( 'remark_single_blog_post_layout', 'sidebar_hide' );

?>

	<div class="content-area" id="primary">
		<main id="main" class="site-main">
			<?php if ( 'sidebar_hide' === $remark_single_post_layout ) : ?>
			
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'single-no-sidebar' );

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
			<?php else : ?>
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
			<?php endif; ?>

		</div>
	</main><!-- #main -->
	<?php 
		/**
		 * Load sidebar
		 *
		 * @access protected
		 * @since 1.0.0
		 * @var string
		 */
		get_sidebar(); 
	
	?>

<?php
get_footer();
