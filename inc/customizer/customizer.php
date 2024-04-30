<?php
/**
 * remark Theme Customizer
 *
 * @package remark
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
// include_once ABSPATH . 'wp-includes/class-wp-customize-control.php';

function remark_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'remark_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'remark_customize_partial_blogdescription',
			)
		);
	}

	/*==========================
	Blog Settings
	==========================*/
		/* General Options */
		$wp_customize->add_panel( 'remark_general_option_panel', 
			array(
				//'priority'       => 100,
				'title'            => __( 'Remark: General', 'remark' ),
				'priority'    => 40,
			) 
		);

		/**
		 * Layout
		 */
		$wp_customize->add_section( 'remark__site_layout', 
			array(
				'title'         => __( 'Layout', 'remark' ),
				'priority'      => 1,
				'panel'         => 'remark_general_option_panel'
			) 
		);

		/**
		 * Sidebar
		 */
		$wp_customize->add_section( 'remark__sidebar_layout', 
			array(
				'title'         => __( 'Sidebar', 'remark' ),
				'priority'      => 1,
				'panel'         => 'remark_general_option_panel'
			) 
		);

		/**
		 * Style
		 */
		$wp_customize->add_section( 'remark__style_panel', 
			array(
				'title'         => __( 'Colors', 'remark' ),
				'priority'      => 1,
				'panel'         => 'remark_general_option_panel'
			) 
		);

		/**
		 * Heading Pages
		 */
		$wp_customize->add_setting(
			'remark_pages_heading_layout',
			array(
				'sanitize_callback' => 'wp_kses',
			)
		);

		$wp_customize->add_control(
			new Remark_Customizer_Heading_Control(
				$wp_customize,
				'remark_pages_heading_layout',
				array(
					'label'    => esc_html__( 'Layout', 'remark' ),
					'section'  => 'remark__site_layout',
					'priority' => 10,
				)
			)
		);

		/**
		 * Container Layout
		 */

		 $wp_customize->add_setting(
			'remark_container_layout',
				array(
					'transport'				=> 'refresh',
					'default'				=> 'fullwidth',
					'sanitize_callback' 	=> 'wp_kses_post',
				)
			);

		$wp_customize->add_control(
			'remark_container_layout',
			array(
				'label'				=> esc_html__( 'Container Layout', 'remark' ),
				'section'         	=> 'remark__site_layout',
				'priority'        	=> 10,
				'type'				=> 'select',
				'choices'           => array(
					'fullwidth'		=> __( 'Full Width', 'remark' ),
					'boxed'      	=> __( 'Boxed', 'remark' ),
				),

			)
		);

		/**
		 * Content Layout
		 */

		 $wp_customize->add_setting(
			'remark_content_layout',
			array(
				'transport'		=>	'refresh',
				'default'		=>	'one-container',
				'sanitize_callback' 	=> 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'remark_content_layout',
			array(
				'label'						=> esc_html__( 'Content Layout', 'remark' ),
				'section'         			=> 'remark__site_layout',
				'priority'        			=> 10,
				'type'						=> 'select',
				'choices'					=>	array(
					'seperator-continer'	=> __( 'Seperator Container', 'remark' ),
					'one-container'			=> __( 'One Container', 'remark' )
				),
				'active_callback' => 'remark_has_boxed_layout',

			)
		);

		/**
		 * Main Container Width
		 */
		$wp_customize->add_setting(
			'remark_general_site_layout',
			array(
				'transport'         => 'refresh',
				'default'           => '1200',
				'sanitize_callback' => 'remark_sanitize_number',
			)
		);

		$wp_customize->add_control(
			new Remark_Customizer_Range_Control(
				$wp_customize,
				'remark_general_site_layout',
				array(
					'label'           => esc_html__( 'Container Width (px)', 'remark' ),
					'section'         => 'remark__site_layout',
					'priority'        => 10,
					'input_attrs'     => array(
						'min'  => 700,
						'max'  => 2000,
						'step' => 5,
					),
					'active_callback'	=> 'show_container_width'
				)
			)
		);

		/**
		 * Main Container Width
		 */
		$wp_customize->add_setting(
			'remark_general_site_boxed_width',
			array(
				'transport'         => 'refresh',
				'default'           => '1170',
				'sanitize_callback' => 'remark_sanitize_number',
			)
		);

		$wp_customize->add_control(
			new Remark_Customizer_Range_Control(
				$wp_customize,
				'remark_general_site_boxed_width',
				array(
					'label'           => esc_html__( 'Boxed Width (px)', 'remark' ),
					'section'         => 'remark__site_layout',
					'priority'        => 10,
					'input_attrs'     => array(
						'min'  => 700,
						'max'  => 2000,
						'step' => 5,
					),
					'active_callback'	=> 'show_boxed_width'
				)
			)
		);

		/**
		 * Content Width
		 */
		$wp_customize->add_setting(
			'remark_general_content_width',
			array(
				'transport'         => 'refresh',
				'default'           => '75',
				'sanitize_callback' => 'remark_sanitize_number',
			)
		);

		$wp_customize->add_control(
			new Remark_Customizer_Range_Control(
				$wp_customize,
				'remark_general_content_width',
				array(
					'label'           => esc_html__( 'Content Width (%)', 'remark' ),
					'section'         => 'remark__site_layout',
					'priority'        => 10,
					'input_attrs'     => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				)
			)
		);

		/**
		 * Sidebar Width
		 */
		$wp_customize->add_setting(
			'remark_general_sidebar_width',
			array(
				'transport'         => 'refresh',
				'default'           => '25',
				'sanitize_callback' => 'remark_sanitize_number',
			)
		);

		$wp_customize->add_control(
			new Remark_Customizer_Range_Control(
				$wp_customize,
				'remark_general_sidebar_width',
				array(
					'label'           => esc_html__( 'Sidebar Width (%)', 'remark' ),
					'section'         => 'remark__site_layout',
					'priority'        => 10,
					'input_attrs'     => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				)
			)
		);

		/**
		 * Heading Pages
		 */
		$wp_customize->add_setting(
			'remark_pages_heading',
			array(
				'sanitize_callback' => 'wp_kses',
			)
		);

		$wp_customize->add_control(
			new Remark_Customizer_Heading_Control(
				$wp_customize,
				'remark_pages_heading',
				array(
					'label'    => esc_html__( 'Color', 'remark' ),
					'section'  => 'remark__site_layout',
					'priority' => 10,
					'active_callback' => 'remark_has_boxed_layout',
				)
			)
		);

		/**
		 * Outer background
		 */
		$wp_customize->add_setting(
			'remark_siter_outer_background',
			array(
				'transport'         => 'refresh',
				'default'           => '#e9e9e9',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'remark_siter_outer_background',
				array(
					'label'           => esc_html__( 'Outer Background', 'remark' ),
					'section'         => 'remark__site_layout',
					'priority'        => 10,
					'active_callback' => 'remark_has_boxed_layout',
				)
			)
		);

		/**
		 * Outer background
		 */
		$wp_customize->add_setting(
			'remark_siter_inner_background',
			array(
				'transport'         => 'refresh',
				'default'           => '#ffffff',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'remark_siter_inner_background',
				array(
					'label'           => esc_html__( 'Inner Background', 'remark' ),
					'section'         => 'remark__site_layout',
					'priority'        => 10,
					'active_callback' => 'remark_has_boxed_layout',
				)
			)
		);

		/**
		 * Heading Pages
		 */
		$wp_customize->add_setting(
			'remark_pages_heading_padding',
			array(
				'sanitize_callback' => 'wp_kses',
			)
		);

		$wp_customize->add_control(
			new Remark_Customizer_Heading_Control(
				$wp_customize,
				'remark_pages_heading_padding',
				array(
					'label'    => esc_html__( 'Padding', 'remark' ),
					'section'  => 'remark__site_layout',
					'priority' => 10,
				)
			)
		);

		/**
		 * Content Padding
		 */

		 $wp_customize->add_setting(
			'remark_content_padding',
			array(
				'transport'				=>	'refresh',
				'default'				=>	'0',
				'sanitize_callback' 	=> 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'remark_content_padding',
			array(
				'label'						=> 	esc_html__( 'Content Padding (PX)', 'remark' ),
				'description' 				=>	esc_html__('Add a custom content padding', 'remark'),
				'section'         			=> 	'remark__site_layout',
				'priority'        			=> 	10,
				'type'						=> 	'text',

			)
		);

		/**
		 * Sidebar Padding
		 */

		 $wp_customize->add_setting(
			'remark_sidebar_padding',
			array(
				'transport'				=>	'refresh',
				'default'				=>	'30',
				'sanitize_callback' 	=> 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'remark_sidebar_padding',
			array(
				'label'						=> 	esc_html__( 'Sidebar Padding (PX)', 'remark' ),
				'description' 				=>	esc_html__('Add a custom sidebar padding', 'remark'),
				'section'         			=> 	'remark__site_layout',
				'priority'        			=> 	10,
				'type'						=> 	'text',
				'active_callback' 			=> 	'remark_has_seperate_layout',

			)
		);

		/**
		 * Margin section
		 */
		$wp_customize->add_setting(
			'remark_pages_heading_margin',
			array(
				'sanitize_callback' => 'wp_kses',
			)
		);

		$wp_customize->add_control(
			new Remark_Customizer_Heading_Control(
				$wp_customize,
				'remark_pages_heading_margin',
				array(
					'label'    => esc_html__( 'Margin', 'remark' ),
					'section'  => 'remark__site_layout',
					'priority' => 10,
				)
			)
		);

		/**
		 * Body margin
		 */

		 $wp_customize->add_setting(
			'remark_container_box_margin',
			array(
				'transport'				=>	'refresh',
				'default'				=>	'0',
				'sanitize_callback' 	=> 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'remark_container_box_margin',
			array(
				'label'						=> 	esc_html__( 'Container Box Margin (PX)', 'remark' ),
				'description' 				=>	esc_html__('Add a custom contaimer margin', 'remark'),
				'section'         			=> 	'remark__site_layout',
				'priority'        			=> 	10,
				'type'						=> 	'text',
				'active_callback' 			=> 	'remark_has_boxed_layout',

			)
		);

		/**
		 * Body margin
		 */

		 $wp_customize->add_setting(
			'remark_sidebar_margin_bottom',
			array(
				'transport'				=>	'refresh',
				'default'				=>	'30',
				'sanitize_callback' 	=> 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'remark_sidebar_margin_bottom',
			array(
				'label'						=> 	esc_html__( 'Sidebar margin bottom (PX)', 'remark' ),
				'description' 				=>	esc_html__('Add a custom sidebar margin bottom', 'remark'),
				'section'         			=> 	'remark__site_layout',
				'priority'        			=> 	10,
				'type'						=> 	'text',
				// 'active_callback' 			=> 	'remark_has_one_container_layout',

			)
		);

		/**
		 * Heading Pages
		 */
		$wp_customize->add_setting(
			'remark_pages_heading_sidebar',
			array(
				'sanitize_callback' => 'wp_kses',
			)
		);

		$wp_customize->add_control(
			new Remark_Customizer_Heading_Control(
				$wp_customize,
				'remark_pages_heading_sidebar',
				array(
					'label'    => esc_html__( 'Sidebar Layout', 'remark' ),
					'section'  => 'remark__sidebar_layout',
					'priority' => 10,
				)
			)
		);

		/**
		 * Content Layout
		 */

		 $wp_customize->add_setting(
			'remark_page_sidebar_layout',
			array(
				'transport'				=>	'refresh',
				'default'				=>	'right-sidebar',
				'sanitize_callback' 	=> 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'remark_page_sidebar_layout',
			array(
				'label'						=> esc_html__( 'Sidebar Layout', 'remark' ),
				'section'         			=> 'remark__sidebar_layout',
				'priority'        			=> 10,
				'type'						=> 'select',
				'choices'					=>	array(
					'right-sidebar'			=> __( 'Right Sidebar', 'remark' ),
					'left-sidebar'			=> __( 'Left Sidebar', 'remark' ),
					'no-sidebar'			=> __( 'No Sidebar', 'remark' )
				)

			)
		);

		/**
		 * Content Layout
		 */

		 $wp_customize->add_setting(
			'remark_post_sidebar_layout',
			array(
				'transport'				=>	'refresh',
				'default'				=>	'right-sidebar',
				'sanitize_callback' 	=> 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'remark_post_sidebar_layout',
			array(
				'label'						=> esc_html__( 'Blog Sidebar Layout', 'remark' ),
				'section'         			=> 'remark__sidebar_layout',
				'priority'        			=> 10,
				'type'						=> 'select',
				'choices'					=>	array(
					'right-sidebar'			=> __( 'Right Sidebar', 'remark' ),
					'left-sidebar'			=> __( 'Left Sidebar', 'remark' ),
					'no-sidebar'			=> __( 'No Sidebar', 'remark' )
				)

			)
		);

		/**
		 * Content Layout
		 */

		 $wp_customize->add_setting(
			'remark_single_post_sidebar_layout',
			array(
				'transport'				=>	'refresh',
				'default'				=>	'right-sidebar',
				'sanitize_callback' 	=> 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'remark_single_post_sidebar_layout',
			array(
				'label'						=> esc_html__( 'Single Post Sidebar Layout', 'remark' ),
				'section'         			=> 'remark__sidebar_layout',
				'priority'        			=> 10,
				'type'						=> 'select',
				'choices'					=>	array(
					'right-sidebar'			=> __( 'Right Sidebar', 'remark' ),
					'left-sidebar'			=> __( 'Left Sidebar', 'remark' ),
					'no-sidebar'			=> __( 'No Sidebar', 'remark' )
				)

			)
		);

		/**
		 * Style Control
		 */

		$wp_customize->add_setting(
			'remark_pages_heading_primary_color',
			array(
				'sanitize_callback' => 'wp_kses',
			)
		);

		$wp_customize->add_control(
			new Remark_Customizer_Heading_Control(
				$wp_customize,
				'remark_pages_heading_primary_color',
				array(
					'label'    => esc_html__( 'Theme Color', 'remark' ),
					'section'  => 'remark__style_panel',
					'priority' => 10,
				)
			)
		);


		$wp_customize->add_setting(
			'remark_primary_color',
			array(
				'transport'         => 'refresh',
				'default'           => '#bb2a26',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'remark_primary_color',
				array(
					'label'           => esc_html__( 'Primary Color', 'remark' ),
					'section'         => 'remark__style_panel',
					'priority'        => 10,
				)
			)
		);
		$wp_customize->add_setting(
			'remark_text_color',
			array(
				'transport'         => 'refresh',
				'default'           => '#4b4f58',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'remark_text_color',
				array(
					'label'           => esc_html__( 'Text Color', 'remark' ),
					'section'         => 'remark__style_panel',
					'priority'        => 10,
				)
			)
		);

		$wp_customize->add_setting(
			'remark_heading_color',
			array(
				'transport'         => 'refresh',
				'default'           => '#000000',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'remark_heading_color',
				array(
					'label'           => esc_html__( 'Heading Color', 'remark' ),
					'section'         => 'remark__style_panel',
					'priority'        => 10,
				)
			)
		);


		$wp_customize->add_setting(
			'remark_link_color',
			array(
				'transport'         => 'refresh',
				'default'           => '#40454d',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'remark_link_color',
				array(
					'label'           => esc_html__( 'Link Color', 'remark' ),
					'section'         => 'remark__style_panel',
					'priority'        => 10,
				)
			)
		);

		$wp_customize->add_setting(
			'remark_link_hover_color',
			array(
				'transport'         => 'refresh',
				'default'           => '#bb2a26',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'remark_link_hover_color',
				array(
					'label'           => esc_html__( 'Link Hover Color', 'remark' ),
					'section'         => 'remark__style_panel',
					'priority'        => 10,
				)
			)
		);

		$wp_customize->add_setting(
			'remark_pages_heading_header_color',
			array(
				'sanitize_callback' => 'wp_kses',
			)
		);

		$wp_customize->add_control(
			new Remark_Customizer_Heading_Control(
				$wp_customize,
				'remark_pages_heading_header_color',
				array(
					'label'    => esc_html__( 'Header Color', 'remark' ),
					'section'  => 'remark__style_panel',
					'priority' => 10,
				)
			)
		);

		$wp_customize->add_setting(
			'remark_header_bg_color',
			array(
				'transport'         => 'refresh',
				'default'           => '#ffffff',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'remark_header_bg_color',
				array(
					'label'           => esc_html__( 'Background', 'remark' ),
					'section'         => 'remark__style_panel',
					'priority'        => 10,
				)
			)
		);

		$wp_customize->add_setting(
			'remark_pages_heading_primary_navigation_color',
			array(
				'sanitize_callback' => 'wp_kses',
			)
		);

		$wp_customize->add_control(
			new Remark_Customizer_Heading_Control(
				$wp_customize,
				'remark_pages_heading_primary_navigation_color',
				array(
					'label'    => esc_html__( 'Primary Navigation Color', 'remark' ),
					'section'  => 'remark__style_panel',
					'priority' => 10,
				)
			)
		);

		$wp_customize->add_setting(
			'remark_primary_navigation_bg_color',
			array(
				'transport'         => 'refresh',
				'default'           => '#ffffff',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'remark_primary_navigation_bg_color',
				array(
					'label'           => esc_html__( 'Background', 'remark' ),
					'section'         => 'remark__style_panel',
					'priority'        => 10,
				)
			)
		);

		$wp_customize->add_setting(
			'remark_primary_navigation_text_color',
			array(
				'transport'         => 'refresh',
				'default'           => '#ffffff',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'remark_primary_navigation_text_color',
				array(
					'label'           => esc_html__( 'Text Color', 'remark' ),
					'section'         => 'remark__style_panel',
					'priority'        => 10,
				)
			)
		);

		$wp_customize->add_setting(
			'remark_primary_navigation_link_color',
			array(
				'transport'         => 'refresh',
				'default'           => '#ffffff',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'remark_primary_navigation_link_color',
				array(
					'label'           => esc_html__( 'Link Color', 'remark' ),
					'section'         => 'remark__style_panel',
					'priority'        => 10,
				)
			)
		);

		$wp_customize->add_setting(
			'remark_primary_navigation_link_hover_color',
			array(
				'transport'         => 'refresh',
				'default'           => '#ffffff',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'remark_primary_navigation_link_hover_color',
				array(
					'label'           => esc_html__( 'Link Hover', 'remark' ),
					'section'         => 'remark__style_panel',
					'priority'        => 10,
				)
			)
		);

		$wp_customize->add_setting(
			'remark_primary_navigation_text_current_color',
			array(
				'transport'         => 'refresh',
				'default'           => '#ffffff',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'remark_primary_navigation_text_current_color',
				array(
					'label'           => esc_html__( 'Current Color', 'remark' ),
					'section'         => 'remark__style_panel',
					'priority'        => 10,
				)
			)
		);

		$wp_customize->add_setting(
			'remark_primary_navigation_submenu_bg_color',
			array(
				'transport'         => 'refresh',
				'default'           => '#ffffff',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'remark_primary_navigation_submenu_bg_color',
				array(
					'label'           => esc_html__( 'Sub-Menu Background', 'remark' ),
					'section'         => 'remark__style_panel',
					'priority'        => 10,
				)
			)
		);
		$wp_customize->add_setting(
			'remark_primary_navigation_submenu_text_color',
			array(
				'transport'         => 'refresh',
				'default'           => '#ffffff',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'remark_primary_navigation_submenu_text_color',
				array(
					'label'           => esc_html__( 'Sub-Menu Text', 'remark' ),
					'section'         => 'remark__style_panel',
					'priority'        => 10,
				)
			)
		);

		/* ===================================
		Style Section
		=================================== */

	  /* Blog Options */
		$wp_customize->add_panel( 'remark_blog_option_panel', 
			array(
				//'priority'       => 100,
				'title'            => __( 'Remark: Blog / Archive', 'remark' ),
				'priority'    => 40,
			) 
		);

		$wp_customize->add_section( 'remark_blog_post_structure', 
				array(
						'title'         => __( 'Post Structure', 'remark' ),
						'priority'      => 1,
						'panel'         => 'remark_blog_option_panel'
				) 
		);

		$wp_customize->add_section( 'remark_blog_post_title_meta', 
				array(
						'title'         => __( 'Meta', 'remark' ),
						'priority'      => 1,
						'panel'         => 'remark_blog_option_panel',
				) 
		);

		$wp_customize->add_section( 'remark_blog_post_content', 
				array(
						'title'         => __( 'Post Content', 'remark' ),
						'priority'      => 1,
						'panel'         => 'remark_blog_option_panel',
				) 
		);

		$wp_customize->add_section( 'remark_blog_post_layout_section', 
				array(
						'title'         => __( 'Layout', 'remark' ),
						'priority'      => 1,
						'panel'         => 'remark_blog_option_panel'
				) 
		);

		$wp_customize->add_section( 'remark_breadcrumbs_section', 
			array(
					'title'         => __( 'Breadcrumbs', 'remark' ),
					'priority'      => 1,
					'panel'         => 'remark_blog_option_panel'
			) 
		);

		$wp_customize->add_section( 'remark_blog_sidebar_layout_section', 
				array(
						'title'         => __( 'Sidebar', 'remark' ),
						'priority'      => 1,
						'panel'         => 'remark_blog_option_panel'
				) 
		);

		/* Feature Image */
		$wp_customize->add_setting( 'remark_blog_post_feature_image',
			array(
					'sanitize_callback' => 'remark_sanitize_checkbox',
					'transport'         => 'refresh',
					'default'       =>  true
			)
		);

		$wp_customize->add_control( 'remark_blog_post_feature_image', 
				array(
						'type'        => 'checkbox',
						'label'       => __( 'Featured Image', 'remark' ),
						'priority'    => 10,
						'section'     => 'remark_blog_post_structure',
				) 
		);

		/* Post Title */
		$wp_customize->add_setting( 'remark_blog_post_title_tag',
				array(
						'sanitize_callback' => 'remark_sanitize_checkbox',
						'transport'         => 'refresh',
						'default'       =>  true
				)
		);

		$wp_customize->add_control( 'remark_blog_post_title_tag', 
				array(
						'type'        => 'checkbox',
						'label'       => __( 'Title & Blog Meta', 'remark' ),
						'priority'    => 10,
						'section'     => 'remark_blog_post_structure',
				) 
		);

		/* Author */
		$wp_customize->add_setting( 'remark_blog_post_author',
				array(
						'sanitize_callback' => 'remark_sanitize_checkbox',
						'transport'         => 'refresh',
						'default'       =>  true
				)
		);

		$wp_customize->add_control( 'remark_blog_post_author', 
				array(
						'type'        => 'checkbox',
						'label'       => __( 'Author', 'remark' ),
						'priority'    => 10,
						'section'     => 'remark_blog_post_title_meta',
				) 
		);

		/* Date */
		$wp_customize->add_setting( 'remark_blog_post_publish_date',
				array(
						'sanitize_callback' => 'remark_sanitize_checkbox',
						'transport'         => 'refresh',
						'default'       =>  true
				)
		);

		$wp_customize->add_control( 'remark_blog_post_publish_date', 
				array(
						'type'        => 'checkbox',
						'label'       => __( 'Publish Date'. 'remark' ),
						'priority'    => 10,
						'section'     => 'remark_blog_post_title_meta',
				) 
		);


		/* Comment */
		$wp_customize->add_setting( 'remark_blog_post_comment',
				array(
						'sanitize_callback' => 'remark_sanitize_checkbox',
						'transport'         => 'refresh',
						'default'       =>  false
				)
		);

		$wp_customize->add_control( 'remark_blog_post_comment', 
				array(
						'type'        => 'checkbox',
						'label'       => __( 'Comment', 'remark' ),
						'priority'    => 10,
						'section'     => 'remark_blog_post_title_meta',
				) 
		);

		/* Category */
		$wp_customize->add_setting( 'remark_blog_post_category',
				array(
						'sanitize_callback' => 'remark_sanitize_checkbox',
						'transport'         => 'refresh',
						'default'       =>  false
				)
		);

		$wp_customize->add_control( 'remark_blog_post_category', 
				array(
						'type'        => 'checkbox',
						'label'       => __( 'Category', 'remark' ),
						'priority'    => 10,
						'section'     => 'remark_blog_post_title_meta',
				) 
		);


		/* Post Content */
		$wp_customize->add_setting( 'remark_post_content_show',
				array(
						'sanitize_callback' => 'remark_sanitize_checkbox',
						'transport'         => 'refresh',
						'default'       =>  true
				)
		);

		$wp_customize->add_control( 'remark_post_content_show', 
				array(
						'type'        => 'checkbox',
						'label'       => __( 'Content', 'remark' ),
						'priority'    => 10,
						'section'     => 'remark_blog_post_content',
				) 
		);

		$wp_customize->add_setting( 'remark_blog_post_content_option',
				array(
						'transport'         => 'refresh',
						'default'   => 'excerpt',
						'sanitize_callback' => 'remark_sanitize_post_content_option'
				)
		);

		$wp_customize->add_control( 'remark_blog_post_content_option', 
				array(
						'type'        => 'radio',
						'label'       => __( 'Post Content', 'remark' ),
						'priority'    => 10,
						'section'     => 'remark_blog_post_content',
						'choices'           => array(
							'full-content'       => __( 'Full Content', 'remark' ),
							'excerpt'      => __( 'Excerpt', 'remark' ),
						),
				) 
		);

		/* Post Layout */
		$wp_customize->add_setting( 'remark_blog_post_layout_option',
				array(
						'transport'         => 'refresh',
						'default'   => 'one-column',
						'sanitize_callback' => 'wp_kses_post'
				)
		);

		$wp_customize->add_control( 'remark_blog_post_layout_option', 
				array(
						'type'        => 'select',
						'label'       => __( 'Post Layout', 'remark' ),
						'description' => __( 'This layout settings only blog page & archive page (Without Search result Page)', 'remark' ),
						'priority'    => 10,
						'section'     => 'remark_blog_post_layout_section',
						'choices'           => array(
							'one-column'       => __( '1 Column', 'remark' ),
							'two-column'      => __( '2 Column', 'remark' ),
						),
				) 
		);

	/*==========================
	End Blog Settings
	==========================*/

	/*==========================
	 Start Single Post Setting 
	==========================*/
		$wp_customize->add_panel( 'remark_single_blog_post_panel', 
			array(
					'title'            => __( 'Remark: Single Post', 'remark' ),
					'priority'    => 40,
			) 
		);

		$wp_customize->add_section( 'remark_single_blog_post_structure_section', 
			array(
					'title'         => __( 'Post Structure', 'remark' ),
					'priority'      => 1,
					'panel'         => 'remark_single_blog_post_panel'
			) 
		);

		$wp_customize->add_section( 'remark_single_blog_post_title_meta_section', 
			array(
					'title'         => __( 'Meta', 'remark' ),
					'priority'      => 1,
					'panel'         => 'remark_single_blog_post_panel'
			) 
		);

		$wp_customize->add_section( 'remark_single_blog_layout_section', 
			array(
					'title'         => __( 'Sidebar', 'remark' ),
					'priority'      => 1,
					'panel'         => 'remark_single_blog_post_panel'
			) 
		);

		/* Feature Image */
		$wp_customize->add_setting( 'remark_single_blog_post_feature_image',
			array(
					'sanitize_callback' => 'remark_sanitize_checkbox',
					'transport'         => 'refresh',
					'default'       =>  true
			)
		);

		$wp_customize->add_control( 'remark_single_blog_post_feature_image', 
			array(
					'type'        => 'checkbox',
					'label'       => __( 'Featured Image', 'remark' ),
					'priority'    => 10,
					'section'     => 'remark_single_blog_post_structure_section',
			) 
		);

		/* Post Title */
		$wp_customize->add_setting( 'remark_single_blog_post_title_tag',
			array(
					'sanitize_callback' => 'remark_sanitize_checkbox',
					'transport'         => 'refresh',
					'default'       =>  true
			)
		);

		$wp_customize->add_control( 'remark_single_blog_post_title_tag', 
			array(
					'type'        => 'checkbox',
					'label'       => __( 'Title & Blog Meta', 'remark' ),
					'priority'    => 10,
					'section'     => 'remark_single_blog_post_structure_section',
			) 
		);

		/* Author */
		$wp_customize->add_setting( 'remark_signle_blog_post_author',
			array(
					'sanitize_callback' => 'remark_sanitize_checkbox',
					'transport'         => 'refresh',
					'default'       =>  true
			)
		);

		$wp_customize->add_control( 'remark_signle_blog_post_author', 
			array(
					'type'        => 'checkbox',
					'label'       => __( 'Author', 'remark' ),
					'priority'    => 10,
					'section'     => 'remark_single_blog_post_title_meta_section',
			) 
		);

		/* Date */
		$wp_customize->add_setting( 'remark_single_blog_post_publish_date',
			array(
					'sanitize_callback' => 'remark_sanitize_checkbox',
					'transport'         => 'refresh',
					'default'       =>  true
			)
		);

		$wp_customize->add_control( 'remark_single_blog_post_publish_date', 
			array(
					'type'        => 'checkbox',
					'label'       => __( 'Publish Date', 'remark' ),
					'priority'    => 10,
					'section'     => 'remark_single_blog_post_title_meta_section',
			) 
		);

		/* Comment */
		$wp_customize->add_setting( 'remark_single_blog_post_comment',
			array(
					'sanitize_callback' => 'remark_sanitize_checkbox',
					'transport'         => 'refresh',
					'default'       =>  false
			)
		);

		$wp_customize->add_control( 'remark_single_blog_post_comment', 
			array(
					'type'        => 'checkbox',
					'label'       => __( 'Comment', 'remark' ),
					'priority'    => 10,
					'section'     => 'remark_single_blog_post_title_meta_section',
			) 
		);

		/* Category */
		$wp_customize->add_setting( 'remark_single_blog_post_category',
			array(
					'sanitize_callback' => 'remark_sanitize_checkbox',
					'transport'         => 'refresh',
					'default'       =>  false
			)
		);

		$wp_customize->add_control( 'remark_single_blog_post_category', 
			array(
					'type'        => 'checkbox',
					'label'       => __( 'Category', 'remark' ),
					'priority'    => 10,
					'section'     => 'remark_single_blog_post_title_meta_section',
			) 
		);

		/* Tag */
		$wp_customize->add_setting( 'remark_single_blog_post_tag',
			array(
					'sanitize_callback' => 'remark_sanitize_checkbox',
					'transport'         => 'refresh',
					'default'       =>  true
			)
		);

		$wp_customize->add_control( 'remark_single_blog_post_tag', 
			array(
					'type'        => 'checkbox',
					'label'       => __( 'Tag', 'remark' ),
					'priority'    => 10,
					'section'     => 'remark_single_blog_post_title_meta_section',
			) 
		);

		/* Sidebar */
		$wp_customize->add_setting( 'remark_single_blog_post_layout',
			array(
				'sanitize_callback' => 'remark_sanitize_single_post_layout',
				'transport'         => 'refresh',
				'default'       =>  'sidebar_hide'
			)
		);

		$wp_customize->add_control( 'remark_single_blog_post_layout', 
			array(
				'type'        => 'radio',
				'label'       => __( 'Sidebar', 'remark' ),
				'priority'    => 10,
				'section'     => 'remark_single_blog_layout_section',
				'choices'           => array(
					'sidebar_hide'       => __( 'Hide', 'remark' ),
					'sidebar_show'      => __( 'Show', 'remark' ),
				),
			) 
		);

		/* Breadcrumbs */
		$wp_customize->add_setting( 'remark_enable_breadcrumb',
			array(
					'sanitize_callback' => 'remark_sanitize_breadcrumb',
					'transport'         => 'refresh',
					'default'   => 'hide',
			)
		);

		$wp_customize->add_control( 'remark_enable_breadcrumb', 
			array(
				'type'        => 'radio',
				'label'       => __( 'Breadcrumbs', 'remark' ),
				'priority'    => 10,
				'section'     => 'remark_breadcrumbs_section',
				'choices'           => array(
						'hide'       => __( 'Hide', 'remark' ),
						'show'      => __( 'Show', 'remark' ),
				),
			) 
		);
		/*==========================
		End Single Post Setting 
		==========================*/

		$wp_customize->add_section( 'remark_header_section', 
			array(
				'title'         => __( 'Remark: Header', 'remark' ),
				'priority'      => 40,
			) 
		);

		$wp_customize->add_setting( 'remark_header_my_account',
			array(
				'sanitize_callback' => 'remark_sanitize_header',
				'transport'         => 'refresh',
				'default'   => 'hide',
			)
		);

		$wp_customize->add_control( 'remark_header_my_account', 
			array(
				'type'        => 'radio',
				'label'       => __( 'Enable Header My Account', 'remark' ),
				'priority'    => 10,
				'section'     => 'remark_header_section',
				'choices'           => array(
					'hide'       => __( 'Hide', 'remark' ),
					'show'      => __( 'Show', 'remark' ),
				),
			) 
		);


		$wp_customize->add_setting( 'remark_header_cart',
			array(
				'sanitize_callback' => 'remark_sanitize_header',
				'transport'         => 'refresh',
				'default'   => 'hide',
			)
		);

		$wp_customize->add_control( 'remark_header_cart', 
			array(
				'type'        => 'radio',
				'label'       => __( 'Enable Header Cart', 'remark' ),
				'priority'    => 10,
				'section'     => 'remark_header_section',
				'choices'           => array(
					'hide'       => __( 'Hide', 'remark' ),
					'show'      => __( 'Show', 'remark' ),
				),
			) 
		);

}
add_action( 'customize_register', 'remark_customize_register' );

/**
 * Load sanitization callback func
 *
 * @return void
 */
require_once( REMARK_THEME_DIR .'inc/customizer/sanitization-callbacks.php' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function remark_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function remark_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function remark_customize_preview_js() {
	wp_enqueue_script( 'remark-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), REMARK_VERSION, true );
}
add_action( 'customize_preview_init', 'remark_customize_preview_js' );
