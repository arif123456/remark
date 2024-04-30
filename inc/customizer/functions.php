<?php
/**
 * Load file of customizer 
 *
 * @package remark
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizer additions.
 */
require_once REMARK_THEME_DIR . '/inc/customizer/customizer.php';

/**
 * Customizer custom control.
 */
require_once REMARK_THEME_DIR . '/inc/customizer/inc/customizer-custom-control.php';

/**
 * Customizer custom control.
 */
require_once REMARK_THEME_DIR . '/inc/customizer/inc/heading-control.php';

/**
 * Customizer helper.
 */
require_once REMARK_THEME_DIR . '/inc/customizer/customizer-helper.php';

/**
 * Load custom customizer css
 */
require_once REMARK_THEME_DIR . '/inc/customizer/inc/customizer-css.php';