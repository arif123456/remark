<?php
// Exit if accessed directly
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( class_exists( 'WP_Customize_Control' ) ) {

    class Remark_Customizer_Heading_Control extends WP_Customize_Control {

        /**
         * Heading control of the customizer
         */
        public function render_content() {
            ?>
                <div class="remark-customize-control-wrapper">
                    <h4 class="remark-customizer-heading"><?php echo esc_html( $this->label ); ?></h4>
                </div>
            <?php
        }
    }
}
?>