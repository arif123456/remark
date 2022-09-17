<?php
/**
 * Breadcrumbs
 */
if ( ! function_exists( 'remark_breadcrumbs' ) ) {
	/**
	 * Breadcrumbs
	 *
	 * @since 1.0.0
	 */
	function remark_breadcrumbs() {
		$remark_enable_bradcrumb = get_theme_mod( 'remark_enable_breadcrumb', 'hide' );

		if ( $remark_enable_bradcrumb === 'show' ) {
			?>
				<div class="py-4 -mb-[30px]">
					<div class="container mx-auto">
						<div class="text-[#17222b] text-[16px]">
							<?php 
								echo '<i class="fa-solid fa-house text-[#bb0000] mr-1 text-[15px]"></i><a class="text-[#17222b] visited:text-[#17222b] hover:text-[#bb0000]" href="' . esc_url( home_url() ) . '" rel="nofollow">' . esc_html( 'Home', 'remark' ) . '</a>';
								if ( is_category() ) {
									echo '<i class="fa-solid fa-angles-right mx-2 text-xs text-[#17222b]"></i>';
									$category = get_the_category();
									$category_link = get_category_link( $category[0]->term_id );
									echo '<a class="visited:text-[#17222b] text-[#17222b] hover:text-[#bb0000]" href="' . esc_url( $category_link ) . '">' . $category[0]->cat_name . '</a>';
									
								} elseif ( is_single() ) {
									echo '<i class="fa-solid fa-angles-right mx-2 text-xs text-[#17222b]"></i>';
									the_title();
									
								} elseif( is_page() ) {
									echo '<i class="fa-solid fa-angles-right mx-2 text-xs"></i>';
									echo the_title();
								} elseif ( is_search() ) {
									echo '<i class="fa-solid fa-angles-right mx-2 text-xs"></i> Search Results for...';
									echo '"<em>';
									echo the_search_query();
									echo '</em>"';
								} elseif (  is_tag() ) {
									echo '<i class="fa-solid fa-angles-right mx-2 text-xs"></i>';
									$tag = get_the_tags();
									$tag_link = get_category_link( $tag[0]->term_id );
									echo '<a class="hover:text-[#bb0000]" href="' . esc_url( $tag_link ) . '">' . $tag[0]->name . '</a>';
									
								}
							?>
						</div>
					</div>
				</div>
			<?php
		}
	}
}
