<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package remark
 */

?>

<section class="no-results not-found bg-white pt-4 md:pt-8 lg:pt-8 pb-16 px-8 md:px-12 lg:px-12">
	<header class="page-header">
		<h1 class="page-title text-3xl">
			<span class="text-[#BB0000]"><?php echo get_search_query(); ?></span>
			<?php esc_html_e( '- search results', 'remark' ); ?>
		</h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'remark' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			get_search_form();
			?>
				<p class="pt-4 text-[#3a3a3a] leading-[30px]"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'remark' ); ?></p>
				<h2 class="pt-4"><?php esc_html_e( 'No posts to display', 'remark' ); ?></h2>
			<?php
			

		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'remark' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
