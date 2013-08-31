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
<html <?php language_attributes(); ?>>
  <head>
    <meta charset='utf-8'>
    <title><?php wp_title(); ?></title>
    <meta content='' name='description'>
    <meta content='width=device-width' name='viewport'>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>

    <link type="text/css" media="screen" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-loader.css" rel="stylesheet" />
    <link type="text/css" media="screen" href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet" />
    <link type="text/css" media="screen" href="<?php echo get_template_directory_uri(); ?>/css/flexslider.css" rel="stylesheet" />
    <link type="text/css" media="screen" href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/libs/modernizr-2.5.3.min.js"></script>
  </head>
  <?php
    if (is_home())
      echo "<body class='home'>";
    elseif (is_single())
      echo "<body class='interior'>";
    elseif (is_page( $page = 'athletics'))
      echo "<body class='athletics'>";
    elseif (is_page())
      echo "<body class='interior'>";
  ?>
    <header>
      <div class='page'>
        <div class='logo'>
          <a href='/' title='Site name'></a>
        </div>
        <a class='home_link' href='/'></a>
        <div class='main_menu_btn'>Menu</div>
        <?php wp_nav_menu( array(
          'theme_location'  => 'nchs-main-menu',
          'container'       => 'nav',
          'container_class' => 'main_menu',
          'menu_class'      => 'main_menu',
          'items_wrap'      => '%3$s',
          'depth'           => 2))
        ?>
        <div class='right_side'>
          <div class='social_box'>
            <div class='facebook'></div>
            <div class='twitter'></div>
            <div class='google'></div>
            <div class='pinterest'></div>
            <div class='clear'></div>
          </div>
          <form action='#' class='search_form form-inline' method='post'>
            <input class='search-field input-medium' placeholder='Search our site' type='text' value='Search our site'>
            <button class='btn-search' type='submit'></button>
          </form>
          <div class='clear'></div>
        </div>
      </div>
    </header>