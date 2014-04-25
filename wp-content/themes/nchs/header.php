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
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/libs/modernizr-2.5.3.min.js"></script>
  </head>
<?php
get_template_part('head', 'body');
get_template_part('head', 'topnav');
$pt = get_query_var('post_type');
if( is_home() ) {
  // echo '<h1>Home</h1>';
  get_template_part('head', 'slideshow');
}
elseif( is_archive() ) {
  // echo '<h1>Archive</h1>';
  if( $pt == 'event' ) {
    get_template_part('head', 'venue');
  }
  else {
    ?>
    <div class='slider_section'>
      <div class="slide1_title">
        <h3><?php the_field( $pt . '_title', 'options' ) ?></h3>
      </div>
      <img src="<?php echo get_field( $pt . '_header', 'options')['sizes']['nchs-slide-foreground'] ?>" />
    </div>
    <?php
  }
}
elseif( is_page() ) {
  // echo "<h1>Page</h1>";
  get_template_part('head', 'page');
}
elseif( is_single() ) {
  // echo "<h1>Single</h1>";
  get_template_part('head', 'page');
}
else {
  echo "<div class='slider_section'></div>";
}

// print_r($pt);

// if( is_page( $page = 'athletics') || (is_archive() && in_array( get_query_var('post_type'), array('coach','player') ) ) )
// get_template_part('titles-athletics');
get_template_part('nav');
?>