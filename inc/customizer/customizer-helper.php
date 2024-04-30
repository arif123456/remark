<?php

/**
 * Callback function for container width
 *
 * @param boolean $input.
 * @return boolean (true|false).
 */
function show_container_width() {
    return ( get_theme_mod( 'remark_container_layout' ) === 'fullwidth' );
}

/**
 * Callback function for boxed width
 *
 * @param boolean $input.
 * @return boolean (true|false).
 */
function show_boxed_width() {
    return ( get_theme_mod( 'remark_container_layout' ) === 'boxed' );
}

/**
 * Callback function container layout for boxed
 *
 * @param boolean $input.
 * @return boolean (true|false).
 */
function remark_has_boxed_layout() {
	if ( 'boxed' == get_theme_mod( 'remark_container_layout', 'boxed' ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Callback function content layout for seperate
 *
 * @param boolean $input.
 * @return boolean (true|false).
 */
function remark_has_seperate_layout() {
	if ( 'seperator-continer' == get_theme_mod( 'remark_content_layout', 'seperator-continer' ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Callback function content layout for seperate
 *
 * @param boolean $input.
 * @return boolean (true|false).
 */
function remark_has_one_container_layout() {
	if ( 'one-container' == get_theme_mod( 'remark_content_layout', 'one-container' ) ) {
		return true;
	} else {
		return false;
	}
}
