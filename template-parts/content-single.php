<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package remark
 */

	$feature_image = get_theme_mod( 'remark_single_blog_post_feature_image', true );
	$post_title = get_theme_mod( 'remark_single_blog_post_title_tag', true );
	$author_meta = get_theme_mod( 'remark_signle_blog_post_author', true );
	$comment_meta = get_theme_mod( 'remark_single_blog_post_comment', true );
	$publish_date = get_theme_mod( 'remark_single_blog_post_publish_date', true );
	$post_category = get_theme_mod( 'remark_single_blog_post_category', true );
	$tag = get_theme_mod( 'remark_single_blog_post_tag', true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mb-7'); ?>>

	<?php if ( ! empty( $feature_image ) ) { ?>

	<div class="mb-7">

		<?php 

			if ( has_post_thumbnail() ) {

				remark_post_thumbnail();

			}
		
		?>

	</div>

	<?php } ?>
	
	<div class="bg-white p-8 mb-7">
		<?php if ( ! empty( $post_title ) ) { ?> 
		<?php if ( get_the_title() ) : ?>
			<h2 class="text-3xl font-bold mb-2"><?php the_title(); ?></h2>
		<?php endif; ?>
		<?php if ( is_sticky() ) echo '<span class="sticky-post">' . __( 'Sticky post', 'remark' ) . '</span>'; ?>
		<?php } ?>
		
		<div class="block md:flex lg:flex items-center justify-between gap-10 mb-2">
			<?php if ( ! empty( $author_meta ) ) { ?> 
			<div>
				<a class="mb-8 md:mb-0 lg:mb-0 flex items-center" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
						<span class="mr-2 rounded-full border border-gray-100 shadow-sm">
							<?php
								echo get_avatar(get_the_author_meta('user_email'), 38)
							?>
						</span>
						<span class="text-sm font-semibold text-gray-500">
							<?php 
									global $current_user; wp_get_current_user();
									echo get_the_author(); 
							
							?>
						</span>
				</a>
			</div>
			<?php } ?>

			<?php if ( ! empty( $publish_date ) ) { ?>
			<div class="text-sm font-semibold text-gray-500">
				<?php echo get_the_date( 'M j, Y' ); ?>
			</div>
			<?php } ?>

			<?php if ( ! empty( $comment_meta ) ) { ?>
			<div>
				<?php 
					if ( comments_open() ) {
							comments_popup_link( '0', '1', '%', 'post-comments' );
					} ?>
			</div>
			<?php } ?>
			
			<?php if ( ! empty( $post_category ) ) { ?>
			<div>
				<?php

					$categories = get_the_category();
					if ( is_array( $categories) || is_object( $categories )) {
						foreach ( $categories as $category ) {
							$category_link = get_category_link( $category->term_id );
							echo '<span><a class="text-xs font-semibold bg-red-700 text-white uppercase ml-4 py-1	px-3" href="'. esc_url( $category_link ) .'">'. $category->cat_name .'</a></span>';
						}
					}

				?>
			</div>
			<?php } ?>
		</div>
	</div>
	<div class="entry-content bg-white p-8 text-base font-normal text-gray-500 leading-6">
		<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'remark' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);

		?>
		<?php if ( ! empty( $tag ) ) { ?> 
			<div class="block">
		<ul class="flex items-center clear-both pb-3">
			<span class="text-base font-bold text-slate-800 mr-2"><?php esc_html_e( 'Tags:', 'remark' ); ?></span>
			<?php 
				$tags = get_the_tags();
				if ( is_array( $tags ) || is_object( $tags ) ) {
					foreach( $tags as $tag ) {
						echo '<li><a class="text-sm	font-font-normal text-slate-800 bg-[#F2F4F3] hover:bg-red-700 hover:text-white rounded-lg py-1 px-4 mr-2" href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . $tag->name . '</a></li>';
						
					}
				}
				
			?>
		</ul>
		</div>
		<?php } ?>
	</div><!-- .entry-content -->
	
</article><!-- #post-<?php the_ID(); ?> -->
