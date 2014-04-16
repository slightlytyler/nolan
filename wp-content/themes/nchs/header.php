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
<!DOCTYPE HTML>
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
    <header>
      <div class='page_section'>
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
            <i class='icon-facebook'></i>
            <i class='icon-twitter'></i>
            <i class='icon-google'></i>
            <i class='icon-pinterest'></i>
            <!-- <div class='facebook'></div>
            <div class='twitter'></div>
            <div class='google'></div>
            <div class='pinterest'></div> -->
            <div class='clear'></div>
          </div>
          <form action='#' class='search_form form-inline' method='post'>
            <input class='search-field input-medium' style="font-size: 12px;color: gray;" placeholder='Search' type='text' value='Search'>
            <button class='btn-search' type='submit'></button>
          </form>
          <div class='clear'></div>
        </div>
      </div>
    </header>

<?php if(!is_single() && !is_home()) : ?>
  <?php if (is_page( $page = 'athletics') || (is_archive() && in_array(get_query_var('post_type'), array('coach', 'player')))): ?>
   <?php get_template_part('titles-athletics'); ?>
  <?php else: ?>
    <?php get_template_part('titles'); ?>
  <?php endif; ?>
  <?php get_template_part('nav'); ?>
  <div class="page_container">
<?php endif;?>
