<?php

/**
 * Displays the next and previous post navigation in single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

$next_post = get_next_post();
$prev_post = get_previous_post();

if ($next_post || $prev_post) {

	$pagination_classes = '';

	if (!$next_post) {
		$pagination_classes = ' only-one only-prev';
	} elseif (!$prev_post) {
		$pagination_classes = ' only-one only-next';
	}

?>

	<nav class="mb-12 bg-white" <?php echo esc_attr($pagination_classes); ?> aria-label="<?php esc_attr_e('Post', 'twentytwenty'); ?>" role="navigation">

		<div class="sm:block md:flex lg:flex justify-between">

			<?php
			if ($prev_post) {
			?>

				<a class="flex items-center text-3xl text-[#112543] sm:pr-0 md:pr-24 lg:pr-24 pb-12" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
					<span class="mr-8" aria-hidden="true">&larr;</span>
					<?php echo wp_kses_post(get_the_post_thumbnail($prev_post->ID, 'thumbnail', array('class' => 'w-24	mr-8'))); ?>
					<span class="text-lg"><?php echo wp_kses_post(get_the_title($prev_post->ID)); ?></span>
				</a>

			<?php
			}

			if ($next_post) {
			?>

				<a class="flex items-center text-3xl text-[#112543] m:pl-0 md:pl-24 lg:pl-24 pb-12" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">

					<?php echo wp_kses_post(get_the_post_thumbnail($next_post->ID, 'thumbnail', array('class' => 'w-24 mr-8'))); ?>
					<span><?php echo wp_kses_post(get_the_title($next_post->ID)); ?></span>
					<span class="ml-8" aria-hidden="true">&rarr;</span>
				</a>
			<?php
			}
			?>

		</div><!-- .pagination-single-inner -->

	</nav><!-- .pagination-single -->

<?php
}
