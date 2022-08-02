<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package remark
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function remark_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'remark_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function remark_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'remark_pingback_header' );

if ( ! function_exists( 'remark_blog_post' ) ) {

	add_action( 'remark_post_action', 'remark_blog_post' );

	/**
	 * Post content.
	 *
	 * @since 1.0.0
	 */
	function remark_blog_post() {
		
		?>
			<?php 
				/**
				 * @func remark_feature_image
				*/
				remark_feature_image()
				
			?>
			<div class="p-4">
				
				
				<?php 
					/**
					 * @func remark_post_title
					*/
					remark_post_title();
					
				?>
			
				<div class="flex-none md:flex lg:flex items-start md:items-center lg:items-center justify-between gap-10 mb-2">
					<?php 
						/**
						 * @func post_author
						 * @func remark_post_date
						 * @func remark_post_comment
						 * @func remark_post_category
						*/
						do_action( 'remark_post_meta' );
					?>	
				</div>
				<?php 
					/**
					 * @func remark_post_content
					*/
					remark_post_content();
				?>
			</div>
		<?php

	}
}

/**
 * Post title
 */
function remark_post_title() {
	$post_title = get_theme_mod( 'remark_blog_post_title_tag', true );
	?>
		<?php if ( ! empty ( $post_title ) ) { ?>
			<?php if ( get_the_title() ) : ?>
				<h2 class="text-lg font-bold mb-2"><a class="text-slate-800 visited:text-slate-800 hover:text-red-700" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php endif; ?>
			<?php if ( is_sticky() ) echo '<span class="sticky-post">' . __( 'Sticky post', 'remark' ) . '</span>'; ?>
		<?php } ?>
	<?php
}

/**
 * Post meta
 */
function remark_post_meta() {
	$comment = get_theme_mod( 'remark_blog_post_comment', true );
	$author = get_theme_mod( 'remark_blog_post_author', true );
	$publish_date = get_theme_mod( 'remark_blog_post_publish_date', true );
	$post_category = get_theme_mod( 'remark_blog_post_category', true );
	
	/**
	 * author
	 */
	if( ! empty( $author ) ) {
		post_author();
	}

	/**
	 * post date
	 */
	if( ! empty( $publish_date ) ) {
		remark_post_date();
	}

	/**
	 * post comment
	 */
	if( ! empty( $comment ) ) {
		remark_post_comment();
	}

	/**
	 * post category
	 */
	if( ! empty( $post_category ) ) {
		remark_post_category();
	}
}
add_action( 'remark_post_meta', 'remark_post_meta' );

/**
 * Post author
 */
function post_author() {
	?>
		<div>
			<a class="mb-8 md:mb-0 lg:mb-0 flex items-center" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
					<span class="mr-2 rounded-full border border-gray-100 shadow-sm">
						<?php
							echo get_avatar(get_the_author_meta('user_email'), 38 );
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
	<?php
}

/**
 * Post date
 */
function remark_post_date() {
	?>
		<div class="text-sm font-semibold text-gray-500 mb-4 md:mb-0 lg:mb-0">
			<i class="fa-solid fa-calendar"></i>
			<?php echo get_the_date( 'M j, Y' ); ?>
		</div>
	<?php
}

/**
 * Post comment
 */
function remark_post_comment() {
	?>
		<div class="mb-4 md:mb-0 lg:mb-0">
			<i class="fa-solid fa-comment"></i>
			<?php 
				if ( comments_open() ) {
						comments_popup_link( '0', '1', '%', 'post-comments' );
				} ?>
		</div>
	<?php
}

/**
 * Post category
 */
function remark_post_category() {
	?>
		<div>
			<?php

				$category = get_the_category();
				$category_link = get_category_link( $category[0]->term_id );
				echo '<span><a class="text-xs font-semibold bg-red-700 hover:text-white visited:text-white text-white uppercase ml-0 md:ml-4 lg:ml-4 py-1 px-3" href="'. esc_url( $category_link ) .'">'. $category[0]->cat_name .'</a></span>';

			?>
		</div>
	<?php
}

/**
 * Post content
 */
function remark_post_content() {
	$show_content = get_theme_mod( 'remark_post_content_show', true );
	$post_content = get_theme_mod( 'remark_blog_post_content_option', true );
	?>
		<?php if ( ! empty( $show_content ) ) { ?>
		<div class="entry-content text-sm	font-normal text-gray-500 leading-6">
			<?php
				
					if ( $post_content == 'excerpt' ) {

						the_excerpt();
					} else {
	
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
	
					}
					
			?>
		</div><!-- .entry-content -->
		<?php } echo '<a href="' . esc_url( get_permalink() ) . '">' . esc_html__( 'Read more', 'remark' ) . '</a>'; ?>
		
	<?php
}

function remark_feature_image() {
	$feature_image = get_theme_mod( 'remark_blog_post_feature_image', true );

	if ( ! empty ( $feature_image ) ) {
		if ( has_post_thumbnail() ) {
			remark_post_thumbnail();
		}
	}
}

if ( ! function_exists( 'remark_header' ) ) {
	add_action( 'remark_header_action', 'remark_header' );
	/**
	 * Theme header.
	 *
	 * @since 1.0.0
	 */
	function remarK_header() {
		?>
			<header id="masthead" class="site-header bg-white shadow-md">
				<div class="container mx-auto">
					<div class="menu-wrap flex-none md:flex lg:flex items-center gap-4 py-6 md:py-0 lg:py-0 items-center">
						<?php 
							/**
							 * Site logo.
							 *
							 * @since 1.0.0
							 */
							remark_site_logo();

							/**
							 * Header navigation.
							 *
							 * @since 1.0.0
							 */
							remark_navigation();
						?>
						
						<div class="remark__header-right-section flex justify-end gap-7 w-full md:w-1/5 lg:w-1/5">
							<?php 
								/**
								 * Header search.
								 *
								 * @since 1.0.0
								 */
								remark_header_search();
							?>
						</div>
					</div>
				</div>
			</header><!-- #masthead -->
		<?php
	}
}


if ( ! function_exists( 'remark_header_search' ) ) {
	/**
	 * Header search
	 *
	 * @since 1.0.0
	 */
	function remark_header_search() {
		?>
			<div class="header-search">
				<?php 
					$enable_search = get_theme_mod( 'remark_header_search', true );
					if ( $enable_search ) {
						?>
							<div class="search-overlay">
								<i class="fa-solid fa-magnifying-glass"></i>
							</div>
							<div class="search_form">
								<!-- <div class="close-icon">
									<i class="fa-solid fa-xmark"></i>
								</div> -->
								<?php get_search_form(); ?>
							</div>
						<?php
					} 
				?>
			</div>
		<?php
	}
}

if ( ! function_exists( 'remark_site_logo' ) ) {
	/**
	 * Site logo
	 *
	 * @since 1.0.0
	 */
	function remark_site_logo() {
		?>
			<div class="site-branding w-full md:w-1/5 lg:w-1/5">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$remark_description = get_bloginfo( 'description', 'display' );
				if ( $remark_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $remark_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->
			<div class="toggle-icon-mobile">
				<i class="fa-solid fa-list"></i>
			</div>
		<?php
	}
	
}

if ( ! function_exists( 'remark_navigation' ) ) {
	/**
	 * Navigation
	 *
	 * @since 1.0.0
	 */
	function remark_navigation() {
		?>
			<nav id="site-navigation" class="w-full md:w-3/5 lg:w-3/5">
				<?php
				wp_nav_menu(
					array(
						'container_id'    => 'primary-menu',
						'container_class' => 'mt-4 p-4 md:mt-0 lg:mt-0 md:p-0 lg:p-0 lg:block',
						'menu_class'      => 'nav-menu flex-none md:flex lg:flex flex-nowrap md:flex-wrap lg:flex-wrap lg:-mx-4 list-none m-0',
						'theme_location'  => 'primary',
						'li_class'        => 'lg:mx-4',
						'fallback_cb'     => false,
						'a_class'     => 'text-sm text-slate-800 visited:text-slate-800 active:text-red-700 hover:text-red-700 font-semibold uppercase pr-5',
					)
				);
				?>
			</nav><!-- #site-navigation -->
		<?php
	}
}

if( ! function_exists( 'remark_footer_inside' ) ) {
	/**
	 * Footer
	 *
	 * @since 1.0.0
	 */
	add_action( 'remark_footer', 'remark_footer_inside' );
	function remark_footer_inside() {
		?>
			<footer id="colophon" class="site-footer">
				
					<?php 
						/**
						 * remark_footer_widget_content hook.
						 *
						 */
						do_action( 'remark_footer_widget_content' );

					?>
				
				
					<?php 
						/**
						 * remark_footer_copyright_content hook.
						 *
						 * * @hooked remark_footer_copyright_content (outputs the HTML for the Theme Options footer copyright text)
						 *
						 */
						do_action( 'remark_footer_copyright_content' );
						
					?>
			</footer><!-- #colophon -->
		<?php
	}
}

if ( ! function_exists( 'remark_footer_widget' ) ) {
	/**
	 * Footer Widget
	 *
	 * @since 1.0.0
	 */
	add_action( 'remark_footer_widget_content', 'remark_footer_widget' );
	function remark_footer_widget() {
		if ( ! is_active_sidebar( 'footer-widget' ) ) {
			return;
		}
		?>
			<div class="bg-[#111111] py-20">
				<div class="container mx-auto">
					<div class="remark__widget-area flex-wrap justify-between flex-none md:flex lg:flex gap-0 md:gap-8 lg:gap-8">
						<?php 
						
							if ( is_active_sidebar( 'footer-widget' ) ) {
								dynamic_sidebar( 'footer-widget' );
								
							}

						?>
					</div>
				</div>
			</div>
		<?php
	}
}

if ( ! function_exists( 'remark_footer_copyright_' ) ) {
	add_action( 'remark_footer_copyright_content', 'remark_footer_copyright' );
	/**
	 * Footer Copyright
	 *
	 * @since 1.0.0
	 */
	function remark_footer_copyright() {
		$copyright_content = get_theme_mod( 'remark_footer_copyright', true );
		?>
			<div class="site-info bg-[#0B0B0B] py-8">
				<div class="container mx-auto text-center text-gray-400	">
					<p class="mb-0">
						<?php 
							if ( ! empty( $copyright_content ) ) {
								echo wp_kses_post( $copyright_content );
							} else {
								?>
									<?php

										echo date_i18n(
												_x( '©Y', 'copyright date format', 'remark' )
										);

										?>
										<span>
										<?php echo bloginfo('name'); ?>
										<?php printf( __( '/ Designed & Built by', 'remark' ) ); ?>
										</span>
										<a class="text-sky-500 hover:text-white visited:text-white" href="<?php echo esc_url( __( 'https://www.wpfound.com/', 'remark' ) ); ?>" target='_blank'><?php printf( __( 'WPFound', 'remark' ) ); ?></a>
								<?php
							}
						?>
					</p>
				</div><!-- .site-info -->
			</div>
		<?php
	}
}