<?php

function nhcs_get_nav( $menu, $mobile_only = null ) {
  if($mobile_only == null) $mobile_only = false;
  $args = array( 
    'menu_class' => 'nav navbar-nav',
    'theme_location'  => $menu,
    // 'fallback_cb' => 'wp_bootstrap_main_nav_fallback',
    // 'depth' => '2',  suppress lower levels
    'walker' => new Bootstrap_walker()
  );
  if ( $mobile_only ) $args['menu_class'] = "nav navbar-nav visible-xs";
  wp_nav_menu( $args );
}

// Menu output mods
class Bootstrap_walker extends Walker_Nav_Menu{

  function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0){

   global $wp_query;
   $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
  
   $class_names = $value = '';

    // If the item has children, add the dropdown class for bootstrap
    if ( $args->has_children ) {
      $class_names = "dropdown ";
    }

    $classes = empty( $object->classes ) ? array() : (array) $object->classes;

    $class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
    $class_names = ' class="'. esc_attr( $class_names ) . '"';

    $output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';

    $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
    $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
    $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
    $attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

    // if the item has children add these two attributes to the anchor tag
    // if ( $args->has_children ) {
      // $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
    // }

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before .apply_filters( 'the_title', $object->title, $object->ID );
    $item_output .= $args->link_after;

    // if the item has children add the caret just before closing the anchor tag
    if ( $args->has_children ) {
      $item_output .= '<b class="caret"></b></a>';
    }
    else {
      $item_output .= '</a>';
    }

    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $object, $depth, $args );
  } // end start_el function

  function start_lvl(&$output, $depth = 0, $args = Array()) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
  }

  function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
    $id_field = $this->db_fields['id'];
    if ( is_object( $args[0] ) ) {
        $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
    }
    return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }
}



function has_event_category($slug){
  $arr = array();
  foreach(get_terms( 'events_categories', array( 'hide_empty' => false )) as $term) :
    $arr[]=$term->name;
  endforeach;
  return in_array($slug,$arr);
}

function has_children($child_of = null) {
  if(is_null($child_of)) {
    global $post;
    $child_of = ($post->post_parent != '0') ? $post->post_parent : $post->ID;
  }
  return (wp_list_pages("child_of=$child_of&echo=0")) ? true : false;
}

function nchs_register_menus() {
  register_nav_menus( array(
    'nchs-main-menu'  => __('Main Menu'),
    'nchs-nav-menu'   => __('Nav Menu')
  ) );
}
add_action( 'init', 'nchs_register_menus' );

function add_sport_column ($original_columns) {
  $new_columns['cb']    = '<input type="checkbox" />';
  $new_columns['title'] = 'Name';
  $new_columns['sport'] = 'Sport';
  $new_columns['date']  = 'Date';
  return $new_columns;
}
add_filter('manage_edit-player_columns', 'add_sport_column');
add_filter('manage_edit-coach_columns', 'add_sport_column');

function manage_player_sport_columns($column_name, $id) {
  global $wpdb;
  switch ($column_name) {
  case 'sport':
    $taxonomies = wp_get_post_terms($id, 'sport');
    foreach ($taxonomies as $taxonomy) {
      echo $taxonomy->name;
    }
    break;
  default:
    break;
  }
}
add_action('manage_player_posts_custom_column', 'manage_player_sport_columns', 10, 2);
add_action('manage_coach_posts_custom_column', 'manage_player_sport_columns', 10, 2);

function add_news_categories_column ($original_columns) {
  $new_columns['cb']    = '<input type="checkbox" />';
  $new_columns['title'] = 'Name';
  $new_columns['news_categories'] = 'Categories';
  $new_columns['comments'] = '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>';
  $new_columns['date']  = 'Date';

  return $new_columns;
}
add_filter('manage_edit-news-story_columns', 'add_news_categories_column');

function manage_news_story_columns($column_name, $id) {
  global $wpdb;
  switch ($column_name) {
  case 'news_categories':
    $taxonomies = wp_get_post_terms($id, 'news-category');
    foreach ($taxonomies as $taxonomy) {
      echo $taxonomy->name;
    }
    break;
  default:
    break;
  }
}
add_action('manage_news-story_posts_custom_column', 'manage_news_story_columns', 10, 2);

function nchs_register_fields() {
  register_setting( 'general', 'nchs_slides_number_setting' );
  add_settings_field( 'nchs_slides_number_setting', 'Number of slides to be displayed', 'nchs_slides_number_fields_html', 'general');
}
function nchs_slides_number_fields_html() {
  $value = get_option( 'nchs_slides_number_setting', 0 );
  echo '<input type="textfield" id="nchs_slides_number_setting" name="nchs_slides_number_setting" value="'.$value.'" />';
}
add_filter( 'admin_init', 'nchs_register_fields');

/* CUSTOM IMAGE SIZE */
if ( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 150, 150 );
}

if ( function_exists( 'add_image_size' ) ) { 
  add_image_size( 'nchs-background', 1251, 328 );
  add_image_size( 'nchs-foreground', 9999, 254 );

  add_image_size( 'nchs-slide-background', 1242, 332 );
  add_image_size( 'nchs-slide-foreground', 9999, 332 );

  add_image_size( 'nchs-coach', 182, 195 );
  add_image_size( 'nchs-player', 76, 81 );
  add_image_size( 'nchs-player-large', 183, 257 );

  add_image_size( 'nchs-athletics-news-featured', 146, 132 );
  add_image_size( 'nchs-athletics-news', 82, 73 );

  add_image_size( 'nchs-index-latest-news-thumb', 50, 44 );
}

/* SIDEBARS */
function nchs_widgets_init() {
  register_sidebar( array(
    'name' => __( 'Athletics - Right Column Widget Area', 'nchs' ),
    'id' => 'athletics-right-widget-area',
    'description' => __( 'Athletics - The Right Column widget area', 'nchs' ),
    'before_widget' => '',
    'after_widget'  => '',
  ) );
  register_sidebar( array(
    'name' => __( 'Page - Right Column Widget Area', 'nchs' ),
    'id' => 'page-right-widget-area',
    'description' => __( 'Page - The Right Column widget area', 'nchs' )
  ) );
  register_sidebar( array(
    'name' => __( 'Homepage Top Widget Area', 'nchs' ),
    'id' => 'homepage-top-widget-area',
    'description' => __( 'The Homepage top widget area', 'nchs' ),
    'before_widget' => '',
    'after_widget'  => '',
  ) );
  register_sidebar( array(
    'name' => __( 'Homepage Middle Widget Area', 'nchs' ),
    'id' => 'homepage-middle-widget-area',
    'description' => __( 'The Homepage middle widget area', 'nchs' ),
    'before_widget' => '',
    'after_widget'  => '',
  ) );
  register_sidebar( array(
    'name' => __( 'Homepage Bottom Widget Area', 'nchs' ),
    'id' => 'homepage-bottom-widget-area',
    'description' => __( 'The Homepage bottom widget area', 'nchs' ),
    'before_widget' => '',
    'after_widget'  => '',
  ) );
  register_sidebar( array(
    'name' => __( 'Homepage Right Widget Area', 'nchs' ),
    'id' => 'homepage-right-widget-area',
    'description' => __( 'The Homepage right widget area', 'nchs' ),
    'before_widget' => '',
    'after_widget'  => '',
  ) );
}
add_action( 'widgets_init', 'nchs_widgets_init' );

?>