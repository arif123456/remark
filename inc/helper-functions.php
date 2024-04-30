<?php

class Remark_Helper_Function {

    /**
     * Instance
     *
     * @var $instance
     */
    private static $instance;

    /**
     * Initiator
     *
     * @since 1.0.0
     * @return object
     */
    public static function get_instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    public function __construct() {
        add_action( 'wp_head', array( $this, 'remark_custom_css' ) );
        add_filter( 'body_class', array( $this, 'remark_body_classes' ) );

    }

    /**
     * All theme functions hook into the remark_head_css filter for this function.
     *
     * @param obj $output output value.
     * @since 1.0.0
     */
    public function remark_custom_css( $output = null ) {

        // Add filter for adding custom css via other functions.
        $output = apply_filters( 'remark_head_css', $output );

        if ( ! empty( $output ) ) {
            echo "<!-- Remark Dynamic CSS -->\n<style type=\"text/css\">\n" . wp_strip_all_tags( $this->remark_minify_css( $output ) ) . "\n</style>";
        }

    }

    /**
     * Minify CSS
     *
     * @since 1.0.0
     */
    public function remark_minify_css( $css = '' ) {

        // Return if no CSS
        if ( ! $css ) {
            return;
        }

                // Normalize whitespace
        $css = preg_replace( '/\s+/', ' ', $css );

        // Remove ; before }
        $css = preg_replace( '/;(?=\s*})/', '', $css );

        // Remove space after , : ; { } */ >
        $css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

        // Remove space before , ; { }
        $css = preg_replace( '/ (,|;|\{|})/', '$1', $css );

        // Strips leading 0 on decimal values (converts 0.5px into .5px)
        $css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

        // Strips units if value is 0 (converts 0px to 0)
        $css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

        // Trim
        $css = trim( $css );

        // Return minified CSS
        return $css;
    }
    
    /**
     * Adds custom classes to the array of body classes.
     *
     * @param array $classes Classes for the body element.
     * @return array
     */
    function remark_body_classes( $classes ) {

        $layout_style = get_theme_mod( 'remark_container_layout', 'fullwidth' );
        $content_layout = get_theme_mod( 'remark_content_layout', 'one-container' );

        // Adds a class of hfeed to non-singular pages.
        if ( ! is_singular() ) {
            $classes[] = 'hfeed';
        }

        // Adds a class of no-sidebar when there is no sidebar present.
        if ( ! is_active_sidebar( 'sidebar-1' ) ) {
            $classes[] = 'no-sidebar';
        }

        $remark_enable_bradcrumb = get_theme_mod( 'remark_enable_breadcrumb', 'hide' );
        if ( $remark_enable_bradcrumb === 'show' ) {
            $classes[] = 'remark-breadcrumb-active';
        }

        // Boxed layout.
        if ( 'boxed' == $layout_style ) {
            $classes[] = 'boxed-layout';

        }

        if ( 'fullwidth' == $layout_style ) {
            $classes[] = 'full-width';

        }

        // Content layout.
        if ( 'seperator-continer' == $content_layout ) {
            $classes[] = 'sepearate-container';

        }

        if ( 'one-container' == $content_layout ) {
            $classes[] = 'one-container';

        }

        return $classes;
    }

    /**
     * Get sidebar layout.
     *
     * @param obj $output output value.
     * @since 1.0.0
     */
    public function remark_get_layout() {

    }
}
Remark_Helper_Function::get_instance();