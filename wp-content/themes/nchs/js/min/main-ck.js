!function(e,t){var n=function(e,t,n){var r;return function i(){function i(){n||e.apply(a,o),r=null}var a=this,o=arguments;r?clearTimeout(r):n&&e.apply(a,o),r=setTimeout(i,t||500)}};e.fn[t]=function(e){return e?this.bind("resize",n(e)):this.trigger(t)}}(jQuery,"smartresize");var table_done=function(e){var t=jQuery("<table />").addClass("table table-striped");jQuery.each(e.feed.entry,function(e,n){var r=jQuery("<tr />");jQuery.each(n.content.$t.split(","),function(t,n){var i=n.split(":"),a=jQuery("<td />");0===e&&(a=jQuery("<th />")),a.text(i[1].trim()),r.append(a)}),t.append(r)}),jQuery(".spreadsheet").append(t)},reset=!0,tail_resize=function(e){var t=10;t=jQuery("body").hasClass("page-template-page-sport-php")===!0?(jQuery(".banner").outerWidth()-2)/2:(jQuery(".banner").outerWidth()-32)/2,jQuery(".banner-right").css({width:t,"border-left-width":t}),jQuery(".banner-left").css({width:t,"border-right-width":t}),jQuery(".banner-left").animate({"border-top-width":e+"px"},1e3),jQuery(".banner-right").animate({"border-top-width":e+"px"},1e3),reset=!1},tail_resize_reset=function(){reset=!0,jQuery(".banner-right").css({"border-top-width":"0"}),jQuery(".banner-left").css({"border-top-width":"0"})},fix_page_container=function(){var e=jQuery(".right").height();e>jQuery(".page-content").height()&&jQuery(".page-content").css({"min-height":e+"px"})};if(tail_resize(30),jQuery(window).smartresize(function(){tail_resize(30)}),jQuery(window).load(function(){fix_page_container()}),setTimeout(function(){fix_page_container()},750),setTimeout(function(){fix_page_container()},3e3),jQuery(window).resize(function(){reset||(tail_resize_reset(),fix_page_container())}),jQuery("body").hasClass("page-template-page-table-php")===!0){var gdata={};gdata.io={},gdata.io.handleScriptLoaded=table_done}$nchs_banner=jQuery(".nchs_banner");var down=!1;jQuery("body").hasClass("home")&&setTimeout(function(){$nchs_banner.animate({top:"0px"}),down=!0},1e3),jQuery(".home a").click(function(){console.log(down),down&&$nchs_banner.css({top:"-119px"})}),$nchs_banner.hover(function(){jQuery(this).css({top:"0px"})},function(){jQuery(this).css({top:"-119px"}),down=!1}),jQuery(".flexslider").flexslider({animation:"slide",controlNav:!0,slideshow:!1,manualControls:".control-nav button"}),jQuery(".coach_slider").flexslider({animation:"slide",controlNav:!1,slideshow:!1,itemWidth:350,minItems:3,maxItems:3,directionNav:!0}),jQuery(".coach_slider .next").click(function(){jQuery(".flex-next")[0].click()}),jQuery(".coach_slider .previous").click(function(){jQuery(".flex-prev")[0].click()}),jQuery(".widget_search").not("h3").find(".form-group").css("margin-top","30px");