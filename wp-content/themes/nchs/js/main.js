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

      if( $('body').hasClass('page-template-page-table-php') === true ) {
        // //docs.google.com/spreadsheets/d/1_VHSGDt19QbriEOR55C1WwT1fIm1YPBHuekzsV1kJVs/pubhtml
        var url = '//spreadsheets.google.com/feeds/list/' + spreadsheet_id + '/od6/public/basic';
        $.ajax({
          type: 'GET',
          data: { 'alt': 'json-in-script' },
          url: url,
          async: false,
          contentType: "application/json",
          dataType: 'jsonp'
        })
        .done( function( data ) {
          console.log( JSON.stringify( data ) );
          var $table = $( '<table />' ).addClass( 'table table-striped' );
          console.log( data );
          $.each( data.feed.entry, function ( i, v ) {
            var $row = $( '<tr />' );
            $.each( v.content.$t.split( ',' ), function ( idx, val ){
              var value = val.split( ':' )
              var $cell = $( '<td />' );
              if( i === 0 )
                $cell = $( '<th />' );
              $cell.text( value[1].trim() );
              $row.append( $cell );
            });
            $table.append( $row );
          });
          $('.col-sm-8').append( $table );
        });
      }
    });
  });
};
