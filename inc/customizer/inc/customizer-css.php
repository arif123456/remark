<?php 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Remark_Customizer_CSS class
 *
 */
class Remark_Customizer_CSS {
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
        // add_action( 'wp_head', array( $this, 'remark_customizer_custom_css') );
        add_filter( 'remark_head_css', array( $this, 'remark_customizer_custom_css' ) );
    }

    /**
     * load custom css func
     *
     * @since 1.0.1
     */
    public function remark_customizer_custom_css ( $output ) {
        $main_container_width   = get_theme_mod( 'remark_general_site_layout', '1200' );
        $boxed_width            = get_theme_mod( 'remark_general_site_boxed_width', '1170' );
        $content_width          = get_theme_mod( 'remark_general_content_width', '75' );
        $sidebar_width          = get_theme_mod( 'remark_general_sidebar_width', '25' );
        
        $content_padding        = get_theme_mod( 'remark_content_padding', '30' );
        $sidebar_padding        = get_theme_mod( 'remark_sidebar_padding', '30' );
        $outer_container_margin = get_theme_mod( 'remark_container_box_margin', '30' );
        $sidebar_margin_bottom  = get_theme_mod( 'remark_sidebar_margin_bottom', '30' );
        
        // style
        $remark_primary_color   = get_theme_mod( 'remark_primary_color', '#bb2a26' );
        $boxed_bg_color         = get_theme_mod( 'remark_siter_outer_background', '#e9e9e9' );
        $boxed_content_bg       = get_theme_mod( 'remark_siter_inner_background', '#ffffff' );
        $text_color             = get_theme_mod( 'remark_text_color', '#4b4f58' );
        $heading_color          = get_theme_mod( 'remark_heading_color', '#000000' );
        $link_color             = get_theme_mod( 'remark_link_color', '#40454d' );
        $link_hover_coor        = get_theme_mod( 'remark_link_hover_color', '#bb2a26' );

        $css                    = '';

        // Container width.
        if ( ! empty( $main_container_width ) ) {
            $css .= '.grid-container{max-width:' . $main_container_width . 'px;}';
        }

        // Boxed width.
        if ( ! empty( $boxed_width ) && '1170' != $boxed_width ) {
            $css .= '.boxed-layout #wrapper{width:' . $boxed_width . 'px;}';
        }

        // Content width.
        if ( ! empty( $content_width ) && '72' != $content_width ) {
            $css .= '@media only screen and (min-width: 960px){ .content-area, .content-left-sidebar .content-area{width:' . $content_width . '%;} }';
        }

        // sidebar width.
        if ( ! empty( $sidebar_width ) && '28' != $sidebar_width ) {
            $css .= '@media only screen and (min-width: 960px){ .sidebar-grid, .content-left-sidebar .widget-area{width:' . $sidebar_width . '%;} }';
        }

        // Boxed width.
        if ( ! empty( $boxed_bg_color ) && '1170' != $boxed_bg_color ) {
            $css .= 'body.boxed-layout{background:' . $boxed_bg_color . '}';
        }

        // Boxed content bg.
        if ( ! empty( $boxed_content_bg ) && '1170' != $boxed_content_bg ) {
            $css .= '.boxed-layout.one-container #wrapper, .boxed-layout.sepearate-container .inner-article, .boxed-layout.sepearate-container .widget-area .widget{background:' . $boxed_content_bg . '}';
        }

        // Content padding for seperator container.
        if ( ! empty( $content_padding ) ) {
            $css .= '.boxed-layout.sepearate-container #wrapper .site-content .inner-article{padding: ' . $content_padding . 'px}';
        }

        // Content padding for one container.
        if ( ! empty( $content_padding ) ) {
            $css .= '.boxed-layout.one-container #wrapper .site-content{padding-top: ' . $content_padding . 'px}';
        }
        if ( ! empty( $content_padding ) ) {
            $css .= '.boxed-layout.one-container #wrapper .site-content{padding-bottom: ' . $content_padding . 'px}';
        }

        // Content padding one container.
        if ( ! empty( $content_padding ) ) {
            $css .= '.full-width #wrapper .site-content .inner-article{padding-left: ' . $content_padding . 'px}';
        } else {
            $css .= '.full-width #wrapper .site-content .inner-article{padding-left: ' . $content_padding . 'px}';
        }
        if ( ! empty( $content_padding ) ) {
            $css .= '.full-width #wrapper .site-content .inner-article{padding-right: ' . $content_padding . 'px}';
        } else {
            $css .= '.full-width #wrapper .site-content .inner-article{padding-right: ' . $content_padding . 'px}';

        }

        // Sidebar padding.
        if ( ! empty( $sidebar_padding ) ) {
            $css .= '.boxed-layout.sepearate-container .main-sidebar .widget{padding: ' . $sidebar_padding . 'px}';
        }
        if ( ! empty( $sidebar_margin_bottom ) ) {
            $css .= '#wrapper .main-sidebar .widget{margin-bottom: ' . $sidebar_margin_bottom . 'px}';
        } else {
            $css .= '#wrapper .main-sidebar .widget{margin-bottom: ' . $sidebar_margin_bottom . 'px}';
        }

        // Container outer margin.
        if ( ! empty( $outer_container_margin ) ) {
            $css .= '.boxed-layout #wrapper{margin-top: ' . $outer_container_margin . 'px}';
        }
        if ( ! empty( $outer_container_margin ) ) {
            $css .= '.boxed-layout #wrapper{margin-bottom: ' . $outer_container_margin . 'px}';
        }
        
        if ( ! empty( $heading_color ) ) {
            $css .= '.boxed-layout #wrapper .main-sidebar .widget h2, .boxed-layout #wrapper .main-sidebar .widget label{color: ' . $heading_color . '}';

        }

        if ( ! empty( $link_color ) ) {
            $css .= '.boxed-layout #wrapper .inner-article a, .boxed-layout #wrapper .main-sidebar .widget li a{color: ' . $link_color . '}';

        }
        if ( ! empty( $link_hover_coor ) ) {
            $css .= '.boxed-layout #wrapper .main-sidebar .widget li a:hover{color: ' . $link_hover_coor . '}';

        }

        if ( ! empty( $text_color ) ) {
            $css .= '.boxed-layout #wrapper .inner-article p, .boxed-layout #wrapper .main-sidebar .widget li{color: ' . $text_color . '}';

        }

        // Links color.
			if ( ! empty( $link_color ) && '#333333' != $link_color ) {
				$css .= 'a{color:' . $link_color . ';}';
				$css .= 'a {stroke:' . $link_color . ';}';
			}

			// Links color hover.
			if ( ! empty( $link_hover_coor ) && '#13aff0' != $link_hover_coor ) {
				$css .= 'a:hover{color:' . $link_hover_coor . ';}';
				$css .= 'a:hover {stroke:' . $link_hover_coor . ';}';
			}

        if ( ! empty( $remark_primary_color ) ) {
            $css .= 'body #wrapper .inner-article blockquote{border-left: 4px solid ' . $remark_primary_color . ' !important}';
            $css .= 'body #wrapper .widget-area .widget .widget-title:before, body #wrapper .widget-area .widget h2:before, body #wrapper .widget-area .widget_block .widget-title:before, body #wrapper .widget-area .widget_block h2:before{background: ' . $remark_primary_color . ' !important}';
            $css .= 'body #wrapper button, body #wrapper input[type=button], body #wrapper input[type=reset], body #wrapper input[type=submit]{border: 1px solid ' . $remark_primary_color . ' !important;}';
            $css .= 'body #wrapper button, body #wrapper input[type=button], body #wrapper input[type=reset], body #wrapper input[type=submit]{background: ' . $remark_primary_color . ' !important;}';
            $css .= 'body #wrapper .site-footer a{color: ' . $remark_primary_color . '}';
            $css .= 'body #wrapper .current-menu-item a{color: ' . $remark_primary_color . ' !important}';
            $css .= 'body #wrapper .inner-article .readmore-btn{background: ' . $remark_primary_color . ' !important}';
            $css .= 'body #wrapper .comment-reply-link{background: ' . $remark_primary_color . ' !important}';

        }
        
        // Return CSS.
        if ( ! empty( $css ) ) {
            $output .= '/* Custom CSS */' . $css;
        }

        // Return output css.
        return $output;

    }
    
}
/**
 * Calling 'get_instance()' method
 */
Remark_Customizer_CSS::get_instance();

