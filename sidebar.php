<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package remark
 */

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		?>
			<div class="main-sidebar sidebar-grid w-full md:w-1/4 lg:w-1/4 pt-8 md:pt-0 lg:pt-0">
				<aside id="secondary" class="widget-area">
					<section class="widget">
						<?php get_search_form(); ?>
					</section>
					<section class="widget">
						<h2 class="widget-title"><?php esc_html_e( 'Archives', 'remark' ); ?></h2>
						<ul>
							<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
						</ul>
					</section>
				</aside>
			</div>
		<?php
	}
?>

<div class="main-sidebar sidebar-grid">
	<aside id="secondary" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- #secondary -->
</div>

