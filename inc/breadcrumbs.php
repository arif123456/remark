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
		$enable_bradcrumb = get_theme_mod( 'remark_enable_breadcrumb', 'hide' );

		if ( $enable_bradcrumb === 'show' ) {
			?>
				<div class="bg-slate-800 border-t-2 border-slate-100 py-16 -mt-8 mb-6">
					<div class="container mx-auto text-center">
						<div class="px-8 text-white">
							<?php 
								echo '<a class="text-white visited:text-white" href="' . esc_url( home_url() ) . '" rel="nofollow">' . esc_html( 'Home', 'remark' ) . '</a>';
								if ( is_category() ) {
									echo '<i class="fa-solid fa-angles-right mx-2 text-xs text-white"></i>';
									$category = get_the_category();
									$category_link = get_category_link( $category[0]->term_id );
									echo '<a class="visited:text-[#BB0000] text-[#BB0000]" href="' . esc_url( $category_link ) . '">' . $category[0]->cat_name . '</a>';
									
								} elseif ( is_single() ) {
									echo '<i class="fa-solid fa-angles-right mx-2 text-xs text-white"></i>';
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
									echo '<a href="' . esc_url( $tag_link ) . '">' . $tag[0]->name . '</a>';
									
								}
							?>
						</div>
					</div>
				</div>
			<?php
		}
	}
}
