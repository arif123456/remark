<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package remark
 */

 $remark_post_layout = get_theme_mod( 'remark_blog_post_layout_option', 'one-column' );

if ( 'one-column' == $remark_post_layout ) {
	$remark_post_layout = 'w-full';
} else {
	$remark_post_layout = 'w-full md:w-full lg:w-1/2';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $remark_post_layout . ' remark__post-item' ); ?>>
	<div class="inner-article">
		<?php 
			/**
			 * @func remark_post_action
			*/
			do_action( 'remark_post_action' );
		?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
