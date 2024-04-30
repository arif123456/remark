<?php
/**
 * The template for displaying all pages
 *
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

?>
	<div class="content-area" id="primary">
		<main id="main" class="site-main">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</div>
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
