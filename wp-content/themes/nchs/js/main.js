var reset = true;
function tail_resize( tail_size ) {
  var banner_tail = ( ( $('.banner').outerWidth() - 30 ) /2 );
  $('.banner-right').css({ 'width': banner_tail, 'border-left-width': banner_tail });
  $('.banner-left').css({ 'width': banner_tail, 'border-right-width': banner_tail });
  $('.banner-left').animate({ 'border-top-width':  tail_size+'px' }, 1000 );
  $('.banner-right').animate({ 'border-top-width':  tail_size+'px' }, 1000 );
  reset = false;
  // .banner-right
}
function tail_resize_reset() {
  reset = true;
  $('.banner-right').css({ 'border-top-width': '0' });
  $('.banner-left').css({ 'border-top-width': '0' });
}
$(window).resize(function(){
  if( !reset )
    tail_resize_reset();
});
(function($,sr){
  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
      var timeout;

      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null;
          };

          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);

          timeout = setTimeout(delayed, threshold || 500);
      };
  }
  // smartresize 
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };
})(jQuery,'smartresize');

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
      $(window).smartresize(function(){
        tail_resize( 30 );
      });
      tail_resize( 30 );
    });
  });
};