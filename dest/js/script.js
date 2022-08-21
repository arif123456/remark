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

    // jQuery('#primary-menu ul ul a').each(function () {
    //   jQuery(this).focus(function () {
    //     jQuery(this).addClass('focused');
    //       var menuParent = $(this).closest('ul').parent();
    //       jQuery(menuParent).addClass('dropdown-visible');
    //   });
   
    //   jQuery(this).blur(function () {
    //     jQuery(this).removeClass('focused');
    //       var menuParent = $(this).closest('ul').parent();
    //       if (!jQuery('.focused', parent_li).length) {
    //         jQuery(menuParent).removeClass('dropdown-visible');
    //       }
    //   });
    // });


  })

})(jQuery);