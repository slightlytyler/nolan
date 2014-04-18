<?php
/**
* The Header for our theme.
*
* Displays all of the <head> section and everything up till <div id="main">
*
* @package WordPress
* @subpackage Nolan2
* @since Vype 1.0
*/
?>
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
    $class = "";
    // can this be detected with the just added body classes instead?
    if (is_home())
      $class .= "home ";
    elseif (is_page( $page = 'athletics') || (is_archive() && in_array(get_query_var('post_type'), array('coach', 'player'))))
      $class .= "athletics ";
    elseif (is_page() || is_single())
      $class .= "interior ";
    global $post;
    $parents = get_post_ancestors( $post->ID );
    $id = ($parents) ? $parents[count($parents)-1]: $post->ID;
    $parent = get_page($id);
    if (strcmp($parent->post_name, "athletics") == 0) {
      $class .= $parent->post_name;
    }
  ?>
  <body <?php body_class($class); ?>>
    <div class="navbar navbar-top"><!-- navbar-fixed-top -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="navbar-collapse collapse navbar-inverse">
        <?php
          nhcs_get_nav( 'nchs-main-menu' );
          nhcs_get_nav( 'nchs-nav-menu', true ); // mobile_only
        ?>
        <form class="navbar-form navbar-right" role="search">
          <div class="form-group input-group">
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-success">
                <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </form>
        <ul class="social-nav nav navbar-nav navbar-right visible-md visible-lg">
          <li>
            <a href="#facebook">
              <i class='fa fa-facebook-square'></i>
            </a>
          </li>
          <li>
            <a href="#twitter">
              <i class='fa fa-twitter-square'></i>
            </a>
          </li>
          <li>
            <a href="#gplus">
              <i class='fa fa-google-plus-square'></i>
            </a>
          </li>
          <li>
            <a href="#pinterest">
              <i class='fa fa-pinterest-square'></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
<?php
if(!is_single() && !is_home()) :
  if (is_page( $page = 'athletics') || (is_archive() && in_array(get_query_var('post_type'), array('coach', 'player')))):
   get_template_part('titles-athletics');
  else:
    get_template_part('titles');
  endif;
  get_template_part('nav');
  echo '<div class="page_container">';
endif;
?>
