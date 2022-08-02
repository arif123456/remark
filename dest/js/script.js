(function ($) {
  /*======================
  Category toggle
  ======================*/

  jQuery(document).ready(function() {
    toggleIcon = $('.site-header .toggle-icon-mobile');
    toggleIcon.on('click', function() {
      $(this).next().slideToggle();
      
    })
  })

})(jQuery);