<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package remark
 */

	$remark_feature_image = get_theme_mod( 'remark_single_blog_post_feature_image', true );
	$remark_post_title    = get_theme_mod( 'remark_single_blog_post_title_tag', true );
	$remark_author_meta   = get_theme_mod( 'remark_signle_blog_post_author', true );
	$remark_comment_meta  = get_theme_mod( 'remark_single_blog_post_comment', false );
	$remark_publish_date  = get_theme_mod( 'remark_single_blog_post_publish_date', true );
	$remark_post_category = get_theme_mod( 'remark_single_blog_post_category', false );
	$remark_blog_post_tag = get_theme_mod( 'remark_single_blog_post_tag', true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb-7' ); ?>>

	<?php if ( ! empty( $remark_feature_image ) ) { ?>
		<?php if ( has_post_thumbnail() ) : ?>
			<div>
				<?php remark_post_thumbnail(); ?>
			</div>
		<?php endif; ?>
	<?php } ?>

	<div class="bg-white p-8 pb-5">
		<?php if ( ! empty( $remark_post_title ) ) { ?> 
			<?php if ( get_the_title() ) : ?>
				<h1 class="break-all mt-0 font-bold text-[#222] visited:text-[#222] mb-6"><?php the_title(); ?></h1>
			<?php endif; ?>
			<?php if ( is_sticky() ) echo '<span class="sticky-post">' . __( 'Sticky post', 'remark' ) . '</span>'; ?>
		<?php } ?>
		
		<ul class="post-meta gap-10 mb-0">
			<?php if ( ! empty( $remark_author_meta ) ) { ?> 
			<li>
				<a class="mb-8 md:mb-0 lg:mb-0 text-sm font-medium text-[#818181] visited:text-[#818181] hover:text-[#BB0000]" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
						<i class="fa fa-user mr-2 text-[#818181]"></i>
						<span>
							<?php 
									global $current_user; wp_get_current_user();
									echo get_the_author(); 
							
							?>
						</span>
				</a>
			</li>
			<?php } ?>

			<?php if ( ! empty( $remark_publish_date ) ) { ?>
			<li class="text-sm mb-4 md:mb-0 lg:mb-0 font-medium text-[#818181] visited:text-[#818181]">
				<i class="far fa-clock mr-2 text-[#818181]"></i>
				<?php echo get_the_date( 'M j, Y' ); ?>
			</li>
			<?php } ?>

			<?php if ( ! empty( $remark_comment_meta ) ) { ?>
				<?php if ( comments_open() ) : ?>
					<li class="text-sm font-medium text-[#818181] visited:text-[#818181] hover:text-[#BB0000]">
						<i class="fa-solid fa-comment mr-2 text-[#818181]"></i>
						<?php comments_popup_link( '0', '1', '%', 'post-comments' ); ?>
					</li>
				<?php endif; ?>
			
			<?php } ?>
			
			<?php if ( ! empty( $remark_post_category ) ) { ?>
			<li class="post-category">
				<?php

					$categories = get_the_category();
					if ( is_array( $categories) || is_object( $categories )) {
						foreach ( $categories as $category ) {
							$category_link = get_category_link( $category->term_id );
							echo '<span><a class="text-sm font-medium bg-[#BB0000] hover:bg-red-800 visited:text-white uppercase ml-4 py-2 px-4" href="' . esc_url( $category_link ) . '">' . $category->cat_name . '</a></span>';
						}
					}

				?>
			</li>
			<?php } ?>
		</ul>
	</div>
	
	<div class="entry-content bg-white pt-0 p-8 px-8 pb-6 text-[#3a3a3a] leading-[30px]">
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
		<?php if ( ! empty( $remark_blog_post_tag ) ) { ?> 
			<?php 
				$post_tags = get_the_tags();
				if ( is_array( $post_tags ) || is_object( $post_tags ) ) : ?>
				<div class="clear-both pb-1 pt-2 pl-0">
					<ul>
						
						<span class="text-base font-bold text-slate-800 mr-2"><?php esc_html_e( 'Tags:', 'remark' ); ?></span>
						<?php
						foreach( $post_tags as $post_tag ) : ?>
							<?php echo '<li class="inline-block mb-2"><a class="text-sm font-font-normal text-slate-800 bg-[#F2F4F3] hover:bg-[#BB0000] hover:text-white visited:text-slate-800 rounded-lg py-2 px-4 mr-2" href="' . esc_url( get_tag_link( $post_tag->term_id ) ) . '">' . $post_tag->name . '</a></li>'; ?>
							
						<?php endforeach; ?>
							
					</ul>
				</div>
			<?php endif;?>
			
		<?php } ?>
	</div><!-- .entry-content -->
	
</article><!-- #post-<?php the_ID(); ?> -->