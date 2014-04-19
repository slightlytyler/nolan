if (typeof jQuery !== 'undefined') {
  jQuery(function($) {
    $(document).ready(function(){
      // ****************************************** PLACEHOLDER       
      function placeholder() { // placeholder for inputs textarea
        //placeholder for form    
        $('input, textarea').focus(function() {
          if($(this).attr('placeholder') == $(this).val()){
              $(this).val('');  
              $(this).data('placeholder', $(this).attr('placeholder'));
              $(this).attr('placeholder','');  
          }
        });
        $('input, textarea').blur(function() {
          if ($(this).val() == '') {
            $(this).val($(this).data('placeholder'));
            $(this).attr('placeholder',$(this).data('placeholder'));  
          }
        });
      };
      placeholder();
      $('.flexslider').flexslider({ // Slider - http://flexslider.woothemes.com/
        animation: "slide",
        controlNav: true,
        manualControls: ".control-nav button"
      });
      $('.coach_slider').flexslider({
        animation: "slide",
        controlNav: false,
        itemWidth: 187,
        animationLoop: true,
        slideshow: false,
        move: 1
      });
      $('.team_box').flexslider({ // Slider - http://flexslider.woothemes.com/
        animation: "slide",
        controlNav: false,
        direction: "vertical"
      });
      $(document).on('click', '.main_menu_btn', function(){
        $('.main_menu').toggle();
      })
      $(window).load(function() {
        if($(".right_sidebar").height() > $(".page_container").height()){
        $(".page_container").height(parseInt($(".right_sidebar").height())+100);
      }
      });
    });
  });
};
