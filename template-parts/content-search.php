<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package remark
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white' ); ?>>
	<?php remark_post_thumbnail(); ?>
	<div class="px-6 pt-4 pb-8 mb-8">
		<header class="entry-header mb-2">
			<?php the_title( sprintf( '<h2 class="text-2xl font-bold mb-2"><a class="text-slate-800 visited:text-slate-800 hover:text-red-700" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php
				remark_posted_on();
				remark_posted_by();
				?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="text-sm	font-normal text-gray-500 leading-6">
			<?php echo wp_trim_words( get_the_content(), 45 ); ?>
			<div class="mt-4">
				<a class="inline-block text-xs font-semibold bg-red-700 hover:bg-slate-800 hover:text-white visited:text-white text-white uppercase py-2 px-3" href="<?php echo esc_url( the_permalink() ); ?>"><?php echo esc_html_e( 'Read More', 'remark' ); ?></a>
			</div>
		</div><!-- .entry-summary -->
	</div>
	
</article><!-- #post-<?php the_ID(); ?> -->
