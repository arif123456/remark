<?php
// Exit if accessed directly
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( class_exists( 'WP_Customize_Control' ) ) {

    class Remark_Customizer_Range_Control extends WP_Customize_Control {

        /**
         * Render the slider control of the customizer
         */
        public function render_content() {
            ?>
                <div class="remark-customize-control-wrapper">
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <div class="slider-custom-control control-wrap customize-control-remark-slider">
                        <div id="slider_control" class="slider remark-slider-range" data-min="<?php echo esc_attr( @$this->input_attrs['min'] ); ?>" data-max="<?php echo esc_attr( @$this->input_attrs['max'] ); ?>" data-step="<?php echo esc_attr( @$this->input_attrs['step'] ); ?>"></div>
                        <input type="number" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" step="<?php echo esc_attr( @$this->input_attrs['step'] ); ?>" min="<?php echo esc_attr( $this->input_attrs['min'] ); ?>" max="<?php echo esc_attr( @$this->input_attrs['max'] ); ?>" value="" class="customize-control-slider-value" <?php $this->link(); ?> />
                        <span class="slider-number-value" style="display:none"></span>
                    </div>
                </div>
            <?php
        }
    }
}
?>