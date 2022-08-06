(function ($) {
  /*======================
  Category toggle
  ======================*/

  jQuery(document).ready(function() {
    toggleIcon = $('.site-header .toggle-icon-mobile');
    toggleIcon.on('click', function() {
      $(this).next().slideToggle();
      
    })

    categoryToggle = $('.widget .children');
    categoryToggle.hide();
    categoryToggle.before('<span class="cat-toggle-icon"><i class="fa-solid fa-angle-down"></i></span>');
    hangleIcon = $('.cat-toggle-icon');
    hangleIcon.on('click', function() {
      $(this).toggleClass('active');
      $(this).next().slideToggle();
    })
  })

})(jQuery);