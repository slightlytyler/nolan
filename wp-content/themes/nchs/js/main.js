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

var table_done = function( data ) {
  // console.log( JSON.stringify( data ) );
  var $table = $( '<table />' ).addClass( 'table table-striped' );
  // console.log( data );
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
  $('.spreadsheet').append( $table );
}

var reset = true;
var tail_resize = function( tail_size ) {
  var banner_tail = 10;
  if( $('body').hasClass('page-template-page-sport-php') === true )
    banner_tail = ( ( $('.banner').outerWidth() - 2 ) /2 );
  else
    banner_tail = ( ( $('.banner').outerWidth() - 32 ) /2 );
  $('.banner-right').css({ 'width': banner_tail, 'border-left-width': banner_tail });
  $('.banner-left').css({ 'width': banner_tail, 'border-right-width': banner_tail });
  $('.banner-left').animate({ 'border-top-width':  tail_size+'px' }, 1000 );
  $('.banner-right').animate({ 'border-top-width':  tail_size+'px' }, 1000 );
  reset = false;
}
var tail_resize_reset = function() {
  reset = true;
  $('.banner-right').css({ 'border-top-width': '0' });
  $('.banner-left').css({ 'border-top-width': '0' });
}

var fix_page_container = function() {
  // @todo Unset this fix for mobile view
  var sidebar_tall = $(".right").height();
  // @note this if is not strictly necessary with min-height
  if( sidebar_tall > $(".page-content").height() ) {
    $('.page-content').css({ 'min-height': sidebar_tall + 'px' });
  }
}

tail_resize( 30 );

$(window).smartresize(function(){
  tail_resize( 30 );
});

$(window).load(function() {
  fix_page_container();
});

setTimeout(function () {
  fix_page_container();
}, 750 );

setTimeout(function () {
  fix_page_container();
}, 3000 );

$(window).resize(function(){
  if( !reset ) {
    tail_resize_reset();
    fix_page_container();
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
  .done( table_done );
}

$('.nchs_banner').hover(function(){
      $(this).css({'top':'0px'});
}, function(){
  $(this).css({'top':'-119px'});
});

jQuery(function($) {
  $(document).ready(function(){

    $('.flexslider').flexslider({ // Slider - http://flexslider.woothemes.com/
      animation: "slide",
      controlNav: true,
      manualControls: ".control-nav button"
    });

  });
});

// if (typeof jQuery !== 'undefined') {
  // jQuery(function($) {
  //   $(document).ready(function(){

      // ****************************************** PLACEHOLDER       
      // function placeholder() { // placeholder for inputs textarea
      //   //placeholder for form    
      //   $('input, textarea').focus(function() {
      //     if($(this).attr('placeholder') == $(this).val()){
      //         $(this).val('');  
      //         $(this).data('placeholder', $(this).attr('placeholder'));
      //         $(this).attr('placeholder','');  
      //     }
      //   });
      //   $('input, textarea').blur(function() {
      //     if ($(this).val() == '') {
      //       $(this).val($(this).data('placeholder'));
      //       $(this).attr('placeholder',$(this).data('placeholder'));  
      //     }
      //   });
      // };
      // placeholder();

      // $('.coach_slider').flexslider({
      //   animation: "slide",
      //   controlNav: false,
      //   itemWidth: 187,
      //   animationLoop: true,
      //   slideshow: false,
      //   move: 1
      // });
      // $('.team_box').flexslider({ // Slider - http://flexslider.woothemes.com/
      //   animation: "slide",
      //   controlNav: false,
      //   direction: "vertical"
      // });
      // $(document).on('click', '.main_menu_btn', function(){
      //   $('.main_menu').toggle();
      // })

  //   });
  // });
// };