<?php
/**
 * Sanitization Callbacks
 *
 * @package Remark WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Checkbox sanitization callback
 *
 * @param boolean $input.
 * @return boolean (true|false).
 */
function remark_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
			return true;
	} else {
			return false;
	}
}

/**
 * Number sanitization callback
 *
 * @since 1.2.1
 */
 function remark_sanitize_number( $number, $setting ) {
	$number = absint( $number );
	return ( $number ? $number : $setting->default );
}

/**
 * Option sanitization callback
 *
 * @since 1.2.1
 */
function remark_sanitize_post_content_option( $input ) {
	return ( 'excerpt' === $input ) ? 'excerpt' : 'full-content';

}

/**
 * Show/Hide sanitization callback
 *
 * @since 1.2.1
 */
function remark_sanitize_breadcrumb( $input ) {
	return ( 'hide' === $input ) ? 'hide' : 'show';
}

/**
 * Header sanitization callback
 *
 * @since 1.2.1
 */
function remark_sanitize_header( $input ) {
	return ( 'hide' === $input ) ? 'hide' : 'show';
}

/**
 * Post Layout sanitization callback
 *
 * @since 1.2.1
 */
function remark_sanitize_single_post_layout( $input ) {
	return ( 'sidebar_hide' === $input ) ? 'sidebar_hide' : 'sidebar_show';
}

/**
 * Color sanitization callback
 *
 * @since 1.2.1
 */
function remark_sanitize_color( $color ) {
    if ( empty( $color ) || is_array( $color ) ) {
        return '';
    }

    // If string does not start with 'rgba', then treat as hex.
	// sanitize the hex color and finally convert hex to rgba
    if ( false === strpos( $color, 'rgba' ) ) {
        return sanitize_hex_color( $color );
    }

    // By now we know the string is formatted as an rgba color so we need to further sanitize it.
    $color = str_replace( ' ', '', $color );
    sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );

    return 'rgba('.$red.','.$green.','.$blue.','.$alpha.')';
}

?>