<!doctype html>  
<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php wp_title( '|', true, 'right' ); ?></title> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- media-queries.js (fallback) -->
    <!--[if lt IE 9]>
      <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>     
    <![endif]-->
    <!-- html5.js (fallback) -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/libs/modernizr-2.5.3.min.js"></script>
  </head>
<?php

get_template_part('head', 'body');
get_template_part('head', 'topnav');

if( is_home() ) {
  echo '<h1>Home</h1>';
  get_template_part('head', 'slideshow');
}
elseif( is_archive() ) {
  echo '<h1>Archive</h1>';
  echo get_query_var('post_type');
  // Theme Options Headers
}
elseif( is_page_template( 'single-event.php' ) ) {
  // get_template_part('head', 'venue');
?>
<div class='venue-map'>
  <?php $venue_id = get_queried_object_id(); ?>
  <div class="slide1_title">
    <h1><?php printf( __( 'Events at: %s', 'eventorganiser' ), '<span>' .eo_get_venue_name($venue_id). '</span>' );?></h1>
  </div>
<?php
  if( $venue_description = eo_get_venue_description( $venue_id ) )
    echo '<div class="venue-archive-meta">'.$venue_description.'</div>';
  echo eo_get_venue_map( $venue_id, array('width'=>"100%") );
?>
  </div>
</div>
<?php
}
// elseif( is_single() || is_page() ) {
//   get_template_part('head', 'page');
// }
// elseif( is_page_template() ) {
//   get_template_part('head', 'venue');
// }


// if( is_page( $page = 'athletics') || (is_archive() && in_array( get_query_var('post_type'), array('coach','player') ) ) )
//   get_template_part('titles-athletics');
get_template_part('nav');
?>