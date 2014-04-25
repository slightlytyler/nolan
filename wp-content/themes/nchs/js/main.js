(function(jQuery,sr){
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
  var table = jQuery( '<table />' ).addClass( 'table table-striped' );
  // console.log( data );
  jQuery.each( data.feed.entry, function ( i, v ) {
    var row = jQuery( '<tr />' );
    jQuery.each( v.content.$t.split( ',' ), function ( idx, val ){
      var value = val.split( ':' )
      var cell = jQuery( '<td />' );
      if( i === 0 )
        cell = jQuery( '<th />' );
      cell.text( value[1].trim() );
      row.append( cell );
    });
    table.append( row );
  });
  jQuery('.spreadsheet').append( table );
}

var reset = true;
var tail_resize = function( tail_size ) {
  var banner_tail = 10;
  if( jQuery('body').hasClass('page-template-page-sport-php') === true )
    banner_tail = ( ( jQuery('.banner').outerWidth() - 2 ) /2 );
  else
    banner_tail = ( ( jQuery('.banner').outerWidth() - 32 ) /2 );
  jQuery('.banner-right').css({ 'width': banner_tail, 'border-left-width': banner_tail });
  jQuery('.banner-left').css({ 'width': banner_tail, 'border-right-width': banner_tail });
  jQuery('.banner-left').animate({ 'border-top-width':  tail_size+'px' }, 1000 );
  jQuery('.banner-right').animate({ 'border-top-width':  tail_size+'px' }, 1000 );
  reset = false;
}
var tail_resize_reset = function() {
  reset = true;
  jQuery('.banner-right').css({ 'border-top-width': '0' });
  jQuery('.banner-left').css({ 'border-top-width': '0' });
}

var fix_page_container = function() {
  // @todo Unset this fix for mobile view
  var sidebar_tall = jQuery(".right").height();
  // @note this if is not strictly necessary with min-height
  if( sidebar_tall > jQuery(".page-content").height() ) {
    jQuery('.page-content').css({ 'min-height': sidebar_tall + 'px' });
  }
}

tail_resize( 30 );

jQuery(window).smartresize(function(){
  tail_resize( 30 );
});

jQuery(window).load(function() {
  fix_page_container();
  // Fix search widget without title
});

setTimeout(function () {
  fix_page_container();
}, 750 );

setTimeout(function () {
  fix_page_container();
}, 3000 );

jQuery(window).resize(function(){
  if( !reset ) {
    tail_resize_reset();
    fix_page_container();
  }
});

if( jQuery('body').hasClass('page-template-page-table-php') === true ) {
  var gdata = {};
  gdata.io = {};
  gdata.io.handleScriptLoaded = table_done;
}

jQuery('.nchs_banner').hover(function(){
  jQuery(this).css({'top':'0px'});
}, function(){
  jQuery(this).css({'top':'-119px'});
});

jQuery('.flexslider').flexslider({
  animation: "slide",
  controlNav: true,
  manualControls: ".control-nav button"
});

jQuery( '.widget_search' )
  .not( 'h3' )
  .find( '.form-group' )
  .css( 'margin-top', '30px' );

// if( jQuery('body').hasClass('page-template-page-table-php') === true ) {
//   //docs.google.com/spreadsheets/d/1_VHSGDt19QbriEOR55C1WwT1fIm1YPBHuekzsV1kJVs/pubhtml
//   For loading tables client side
//   var url = '//spreadsheets.google.com/feeds/list/' + spreadsheet_id + '/od6/public/basic';
//   jQuery.ajax({
//     type: 'GET',
//     data: { 'alt': 'json-in-script' },
//     url: url,
//     async: false,
//     contentType: "application/json",
//     dataType: 'jsonp'
//   })
//   .done( table_done );
// }
