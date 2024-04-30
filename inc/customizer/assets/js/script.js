/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {
    
    jQuery(document).ready(function() {

        // Set our slider defaults and initialise the slider
        $('.customize-control-remark-slider').each(function() {
            var sliderValue = $(this).find('.customize-control-slider-value');
            var newSlider = $(this).find('#slider_control');
            var sliderMinValue = parseFloat(newSlider.attr('data-min'));
            var sliderMaxValue = parseFloat(newSlider.attr('data-max'));
            var sliderStepValue = parseFloat(newSlider.attr('data-step'));
            var _text = sliderValue.next( '.slider-number-value' );
            
            newSlider.slider({
                range: "min",
                value: sliderValue.val(),
                min: sliderMinValue,
                max: sliderMaxValue,
                step: sliderStepValue,
                slide: function( event, ui ) {
					sliderValue.val( ui.value ).change();
					_text.text( ui.value );
				}
            });
        });
    })
  
  })(jQuery);