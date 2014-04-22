<?php
// @todo transient cache for spreadsheet template
// $response = wp_remote_request('http://docs.google.com/spreadsheets/d/1_VHSGDt19QbriEOR55C1WwT1fIm1YPBHuekzsV1kJVs/pubhtml');
// print_r($response);

function nhcs_video( $id ) {
  if ( is_numeric( $id ) )
    $url = '//player.vimeo.com/video/'.$id;
  else
    $url = '//www.youtube.com/embed/'.$id;
  return sprintf( '<div class="video-container"><iframe src="%s" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>', $url );
}

//attach our function to the wp_pagenavi filter
add_filter( 'wp_pagenavi', 'nchs_pagination', 10, 2 );
 
//customize the PageNavi HTML before it is output
function nchs_pagination($html) {
  $out = '';
  $out = str_replace("<a","<li><a",$html);  
  $out = str_replace("</a>","</a></li>",$out);
  $out = str_replace("<span","<li><span",$out); 
  $out = str_replace("</span>","</span></li>",$out);
  $out = str_replace("<div class='wp-pagenavi'>","",$out);
  $out = str_replace("</div>","",$out);
  return '<ul class="pagination">'.$out.'</ul>';
}

function nchs_save_page_on_template_change() {
    global $parent_file;
    if ( is_admin() && $parent_file == 'edit.php?post_type=page') {
    ?>
    <script type="text/javascript">
    jQuery(function($){
      $('#page_template').on('change', function(){
        $('#save-post').click();
        $('#publish').click();
      });
    });
    </script>
    <?php
    }
}
add_filter('admin_head', 'nchs_save_page_on_template_change');


add_action( 'pre_get_posts', 'add_my_post_types_to_query' );
function add_my_post_types_to_query( $query ) {
  if ( $query->is_main_query() && is_home() ) {
    // show athletics and news on the homepage
    $query->set( 'post_type', array( 'news', 'athletics' ) );
    $query->set( 'posts_per_page', '3' );
  }
  elseif ( $query->is_main_query() && is_tax('sport') ) {
    // show past events on the sport tag archives
    $query->set( 'post_type', array( 'event', 'athletics' ) );
    $query->set( 'posts_per_page', '10' );
  }
  else {
    return $query;
  }
}

add_filter( 'manage_taxonomies_for_athletics_columns', 'activity_type_columns' );
function activity_type_columns( $taxonomies ) {
    $taxonomies[] = 'sport';
    return $taxonomies;
}

function nchs_add_taxonomy_filters() {
  global $typenow; 
  $taxonomies = array('sport');
  if( $typenow == 'athletics' ){
    foreach ($taxonomies as $tax_slug) {
      $tax_obj = get_taxonomy($tax_slug);
      $tax_name = $tax_obj->labels->name;
      $terms = get_terms($tax_slug);
      if(count($terms) > 0) {
        echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
        echo "<option value=''>Show All $tax_name</option>";
        foreach ($terms as $term) { 
          echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
        }
        echo "</select>";
      }
    }
  }
}
add_action( 'restrict_manage_posts', 'nchs_add_taxonomy_filters' );

/* 
 * Menu Helpers
 */

function nhcs_get_nav( $menu, $mobile_only = null ) {
  if($mobile_only == null) $mobile_only = false;
  $class = str_replace( '-menu', '', $menu );
  $args = array( 
    'menu_class' => 'nav navbar-nav '.$class,
    'theme_location'  => $menu,
    'container' => '',
    // 'fallback_cb' => 'wp_bootstrap_main_nav_fallback',
    // 'depth' => '2',  suppress lower levels
    'walker' => new Bootstrap_walker()
  );
  if ( $mobile_only ) $args['menu_class'] = "nav navbar-nav visible-xs";
  wp_nav_menu( $args );
}

class Bootstrap_walker extends Walker_Nav_Menu{
  function start_el(&$output, $object, $depth = 0, $args = Array(), $current_object_id = 0){
   global $wp_query;
   $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
   $class_names = $value = '';
    // If the item has children, add the dropdown class for bootstrap
    if ( $args->has_children )
      $class_names = "dropdown ";
    $classes = empty( $object->classes ) ? array() : (array) $object->classes;
    $class_names .= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
    $class_names = ' class="'. esc_attr( $class_names ) . '"';
    $output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_names .'>';
    $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
    $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
    $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
    $attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';
    // if the item has children add these two attributes to the anchor tag
    // if ( $args->has_children )
    //   $attributes .= ' class="dropdown-toggle" data-toggle="dropdown"';
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
    if ( is_object( $args[0] ) )
      $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
    return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }
}

/* 
 * Theme Setup
 */

class NHCS_ThemeSetup {
  public static function init() {
    add_action( 'init', [ __CLASS__, 'nchs_init' ] );
    add_action( 'widgets_init', [ __CLASS__, 'nchs_widgets_init' ] );
    add_action( 'after_setup_theme', [ __CLASS__, 'nchs_after_setup_theme' ] );
    add_action( 'wp_enqueue_scripts', [ __CLASS__, 'nchs_wp_enqueue_scripts' ] );
  }

  public function nchs_init() {
    register_nav_menus( array(
      'nchs-main-menu'  => __('Main Menu'),
      'nchs-nav-menu'   => __('Nav Menu')
    ) );
  }

  public function nchs_widgets_init() {
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    register_widget( 'Athletics_Widget' );
    register_widget( 'News_Widget' );
    register_widget( 'Sport_News_Widget' );
    register_widget( 'Sport_Events_Widget' );
    register_sidebar( array(
      'name' => __( 'Sport Page Sidebar', 'nchs' ),
      'id' => 'sport-sidebar',
      'description' => __( 'Sidebar for the page-sport.php template', 'nchs' )
    ) );
    register_sidebar( array(
      'name' => __( 'Archive Sidebar', 'nchs' ),
      'id' => 'archive-sidebar',
      'description' => __( 'The Default/Index Sidebar', 'nchs' )
    ) );
    register_sidebar( array(
      'name' => __( 'Athletics - Right Column Widget Area', 'nchs' ),
      'id' => 'athletics-right-widget-area',
      'description' => __( 'Athletics - The Right Column widget area', 'nchs' ),
      'before_widget' => '',
      'after_widget'  => ''
    ) );
    register_sidebar( array(
      'name' => __( 'Page Sidebar', 'nchs' ),
      'id' => 'page-sidebar',
      'description' => __( 'Default Page widget area.', 'nchs' )
    ) );
    register_sidebar( array(
      'name' => __( 'Homepage Ribbion', 'nchs' ),
      'id' => 'homepage-ribbion',
      'description' => __( 'The Homepage Ribbion widget area', 'nchs' ),
    ) );
    register_sidebar( array(
      'name' => __( 'Video Sidebar', 'nchs' ),
      'id' => 'video-sidebar',
      'description' => __( 'Accompanies all video templates', 'nchs' )
    ) );
    register_sidebar( array(
      'name' => __( 'Events Sidebar', 'nchs' ),
      'id' => 'events-sidebar',
      'description' => __( 'Shown on event templates', 'nchs' )
    ) );
    register_sidebar( array(
      'name' => __( 'Homepage Top Widget Area', 'nchs' ),
      'id' => 'homepage-top-widget-area',
      'description' => __( 'The Homepage top widget area', 'nchs' ),
      'before_widget' => '',
      'after_widget'  => ''
    ) );
    register_sidebar( array(
      'name' => __( 'Homepage Bottom', 'nchs' ),
      'id' => 'homepage-bottom-widget-area',
      'description' => __( 'The Homepage bottom widget area', 'nchs' ),
      'before_widget' => '<div class="col-md-6">',
      'after_widget'  => '</div>'
    ) );
    register_sidebar( array(
      'name' => __( 'Homepage Right Widget Area', 'nchs' ),
      'id' => 'homepage-right-widget-area',
      'description' => __( 'The Homepage right widget area', 'nchs' ),
      'before_widget' => '',
      'after_widget'  => ''
    ) );
  }

  public function nchs_after_setup_theme() { 
    /* CUSTOM IMAGE SIZE */
    if ( function_exists( 'add_theme_support' ) ) {
      add_theme_support( 'post-thumbnails' );
      set_post_thumbnail_size( 150, 150 );
    }
    $image_sizes = [
      [ 'nchs-background', 1251, 328 ],
      [ 'nchs-foreground', 9999, 254 ],
      [ 'nchs-slide-background', 1242, 332 ],
      [ 'nchs-slide-foreground', 9999, 332 ],
      [ 'nchs-coach', 182, 195 ],
      [ 'nchs-player', 76, 81 ],
      [ 'nchs-player-large', 183, 257 ],
      [ 'nchs-athletics-news-featured', 146, 132 ],
      [ 'nchs-athletics-news', 82, 73 ],
      [ 'nchs-index-latest-news-thumb', 50, 44 ]
    ];
    if ( function_exists( 'add_image_size' ) ) { 
      foreach( $image_sizes as $size ) {
        add_image_size( $size[0], $size[1], $size[2] );
      }
    }
  }

  public function nchs_wp_enqueue_scripts() {
    wp_enqueue_style( 'nhcs-style', get_stylesheet_uri() );
    // wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
  }
}
NHCS_ThemeSetup::init();

/* 
 * Posts 2 Posts Configuration
 */

// function terms_slug_list( $taxonomy ) {
//   $slugs = [];
//   $terms = get_terms( $taxonomy );
//   foreach( $terms as $term ):
//     array_push( $slugs, $term->slug );
//   endforeach;
//   return $slugs;
// }

class NHCS_Posts2Posts {
  public static function init() {
    add_action( 'p2p_init', array( __CLASS__, 'nhcs_p2p_connections' ) );
    add_filter( 'p2p_connectable_args', array( __CLASS__, 'nhcs_filter_pages_by_template' ), 10, 3 );
    add_filter( 'p2p_admin_box_show', array( __CLASS__, 'nhcs_restrict_p2p_box_display' ), 10, 3 );
  }

  public function nhcs_p2p_connections() {
    p2p_register_connection_type( array(
      'name' => 'faculty_to_pages',
      'from' => 'page',
      'to' => 'faculty',
      'sortable' => 'any'
    ) );
    p2p_register_connection_type( array(
      'name' => 'ministry_to_pages',
      'from' => 'page',
      'to' => 'ministry',
      'sortable' => 'any'
    ) );
    p2p_register_connection_type( array(
      'name' => 'coach_to_pages',
      'from' => 'page',
      'to' => 'coach',
      'sortable' => 'any'
    ) );
    // p2p_register_connection_type( array(
    //   'name' => 'player_to_pages',
    //   'from' => 'page',
    //   'to' => 'player',
    //   'sortable' => 'any'
    // ) );
    p2p_register_connection_type( array(
      'name' => 'student_to_pages',
      'from' => 'page',
      'to' => 'student',
      'sortable' => 'any',
      'fields' => array(
        'number' => array(
          'title' => 'Number',
          'type' => 'text',
        ),
        'position' => array(
          'title' => 'Position',
          'type' => 'text',
        ),
        'hide' => array(
          'title' => 'Hide',
          'type' => 'checkbox'
        ),
      )
    ) );
  }

  public function nhcs_filter_pages_by_template( $args, $ctype, $post_id ) {
    // @todo Theme Option?
    $args['p2p:per_page'] = 15;
    if( 'to' == $ctype->get_direction() ) {
      $args['post_type'] = 'page';
      $args['meta_key'] = '_wp_page_template';
      $args['meta_compare'] = '=';
      if ( 'faculty_to_pages' == $ctype->name )
        $args['meta_value'] = 'page-department.php';
      if ( 'ministry_to_pages' == $ctype->name )
        $args['meta_value'] = 'page-ministry.php';
      if ( 'student_to_pages' == $ctype->name || 'coach_to_pages' == $ctype->name || 'player_to_pages' == $ctype->name )
        $args['meta_value'] = 'page-sport.php';
    }
    return $args;
  }

  public function nhcs_restrict_p2p_box_display( $show, $ctype, $post ) {
    if ( 'faculty_to_pages' == $ctype->name )
      if( $post->post_type == 'page' )
        return ( 'page-department.php' == $post->page_template );
    if( $post->post_type == 'page' )
      if ( 'ministry_to_pages' == $ctype->name )
        return ( 'page-ministry.php' == $post->page_template );
    if( $post->post_type == 'page' )
      if ( 'student_to_pages' == $ctype->name || 'coach_to_pages' == $ctype->name || 'player_to_pages' == $ctype->name )
        return ( 'page-sport.php' == $post->page_template );
    if( $post->post_type == 'faculty' || $post->post_type == 'ministry' || $post->post_type == 'player' || $post->post_type == 'coach' || $post->post_type == 'student' )
    return $show;
  }
}
NHCS_Posts2Posts::init();

/* 
 * Original Stuff
 */

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

/*
 * Custom Widgets
 * @todo Move!
 */

// function register_athletics_widget() {
//   register_widget( 'Athletics_Widget' );
// }
// add_action( 'widgets_init', 'register_athletics_widget' );

class News_Widget extends WP_Widget {
  function __construct() {
    parent::__construct(
      'news_widget'
      , 'News'
      , array( 'description' => 'Displays 5 most recent News Stories' )
    );
  }
  function widget($args, $instance) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $news_query = new WP_Query( [ 
      'post_type' => 'news',
      'posts_per_page' => '5'
    ] );
    if( $news_query->have_posts() ) :
      echo $before_widget;
      if ( $title )
        echo $before_title . $title . $after_title;
      else
        echo $before_title . $term->slug . ' News' . $after_title;
      echo '<ul>';
      while ( $news_query->have_posts() ) : $news_query->the_post();
        echo sprintf( "<li><a href='%s'>%s</a></li>", get_permalink(), get_the_title() );
        // echo '<p>'.get_terms('sport', 'orderby=count&hide_empty=0').'</p>';
        // the_excerpt();
      endwhile;
      wp_reset_postdata();
      echo '</ul>';
      echo $after_widget;
    endif;
  }
  function update($new_instance, $old_instance) {   
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    return $instance;
  }
  function getarchives_where_filter($where) {
    $where = str_replace( "post_type = 'post'", "post_type = 'athletics'", $where );
    return $where;
  }
  function form($instance) {  
    $title    = esc_attr($instance['title']);
    if( !$title )
      $title = 'News';
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> 
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <?php 
  }
}

class Athletics_Widget extends WP_Widget {
  function __construct() {
    parent::__construct(
      'athletics_widget'
      , 'Athletics News'
      , array( 'description' => 'Displays 5 most recent Athletics Stories' )
    );
  }

  function widget($args, $instance) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $news_query = new WP_Query( [ 
      'post_type' => 'athletics',
      'posts_per_page' => '5'
    ] );
    if( $news_query->have_posts() ) :
      echo $before_widget;
      if ( $title )
        echo $before_title . $title . $after_title;
      else
        echo $before_title . $term->slug . ' News' . $after_title;
      echo '<ul>';
      while ( $news_query->have_posts() ) : $news_query->the_post();
        echo get_the_term_list( $post->ID, 'sport' );
        echo sprintf( "<li><a href='%s'>%s</a></li>", get_permalink(), get_the_title() );
      endwhile;
      wp_reset_postdata();
      echo '</ul>';
      echo $after_widget;
    endif;
  }

  function update($new_instance, $old_instance) {   
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    return $instance;
  }

  function getarchives_where_filter($where) {
    $where = str_replace( "post_type = 'post'", "post_type = 'athletics'", $where );
    return $where;
  }

  function form($instance) {  
    $title    = esc_attr($instance['title']);
    if( !$title )
      $title = 'Athletics News';
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> 
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <?php 
  }
}


class Sport_News_Widget extends WP_Widget {
  function __construct() {
    parent::__construct(
      'sports_news_widget'
      , 'Sport News'
      , array( 'description' => 'Displays 5 most recent Athletics Stories for the current sport page.' )
    );
  }

  function widget($args, $instance) {
    extract( $args );
    $title    = apply_filters('widget_title', $instance['title']);
    $sport_id = $instance['sport'];
    if( !$sport_id )
      $sport_id = get_field('news_category', $GLOBALS['post']->ID );
    $term = get_term( $sport_id, 'sport' );
    $news_query = new WP_Query( [ 
      'post_type' => 'event',
      'posts_per_page' => '5',
      'sport' => $term->slug
    ] );
    if( $news_query->have_posts() ) :
      echo $before_widget;
      if ( $title )
        echo $before_title . $title . $after_title;
      else
        echo $before_title . $term->slug . ' News' . $after_title;
      echo '<ul>';
      while ( $news_query->have_posts() ) : $news_query->the_post();
        echo sprintf( "<li><a href='%s'>%s</a></li>", get_permalink(), get_the_title() );
        the_excerpt();
      endwhile;
      wp_reset_postdata();
      echo '</ul>';
      echo $after_widget;
    endif;
  }

  function update($new_instance, $old_instance) {   
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['sport'] = strip_tags($new_instance['sport']);
    return $instance;
  }

  function getarchives_where_filter($where) {
    $where = str_replace( "post_type = 'post'", "post_type = 'athletics'", $where );
    return $where;
  }

  function form($instance) {  
    $title = esc_attr($instance['title']);
    $sport = esc_attr($instance['sport']);
    ?>
    <p>Leave the title blank to use '[Sport] News' default title</p>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> 
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <p>When used with the Sport Template 'Sport Page Context' mode automatically displays relevant content. (Category set on page template)</p>
    <p>
      <label for="<?php echo $this->get_field_id('sport'); ?>">Sport:</label> 
<?php
    $terms = get_terms('sport');
    if(count($terms) > 0) {
      echo '<select id="'.$this->get_field_id("sport").'" name="'.$this->get_field_name("sport").'" type="text" value="'.$sport.'">';
      echo "<option value=''>Sport Page Context</option>";
      foreach ($terms as $term) { 
        if( $term->term_id === $sport )
          echo "<option value='$term->term_id' selected='selected'>$term->name ($term->count)</option>";
        else
          echo "<option value='$term->term_id'>$term->name ($term->count)</option>";
      }
      echo "</select>";
    }
    echo "</p>";
  }
}

class Sport_Events_Widget extends WP_Widget {
  function __construct() {
    parent::__construct(
      'sports_events_widget'
      , 'Sport Events'
      , array( 'description' => 'Displays 5 most recent Events in the sport for the current sport page.' )
    );
  }

  function widget($args, $instance) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $sport_id = $instance['sport'];
    if( !$sport_id )
      $sport_id = get_field('news_category', $GLOBALS['post']->ID );
    $term = get_term( $sport_id, 'sport' );
    $event_query = new WP_Query( [ 
      'post_type' => 'event',
      'posts_per_page' => '5',
      'sport' => $term->slug
    ] );
    if( $event_query->have_posts() ) :
      echo $before_widget;
      if ( $title )
        echo $before_title . $title . $after_title;
      else
        echo $before_title . $term->slug . ' Events' . $after_title;
      echo '<ul>';
      while ( $event_query->have_posts() ) : $event_query->the_post();
          //Format date/time according to whether its an all day event.
          //Use microdata http://support.google.com/webmasters/bin/answer.py?hl=en&answer=176035
          if( eo_is_all_day() ){
            $format = 'd F Y';
            $microformat = 'Y-m-d';
          }else{
            $format = 'd F Y '.get_option('time_format');
            $microformat = 'c';
          }
?>
          <time itemprop="startDate" datetime="<?php eo_the_start($microformat); ?>"><?php eo_the_start($format); ?></time>
<?php
        echo sprintf( "<li><a href='%s'>%s</a></li>", get_permalink(), get_the_title() );
        the_excerpt();
      endwhile;
      wp_reset_postdata();
      echo '</ul>';
      echo $after_widget;
    endif;
  }

  function update($new_instance, $old_instance) {   
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['sport'] = strip_tags($new_instance['sport']);
    return $instance;
  }

  function getarchives_where_filter($where) {
    $where = str_replace( "post_type = 'post'", "post_type = 'athletics'", $where );
    return $where;
  }

  function form($instance) {  
    $title = esc_attr($instance['title']);
    $sport = esc_attr($instance['sport']);
?>
    <p>Leave the title blank to use '[Sport] Events' default title</p>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> 
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <p>When used with the Sport Template 'Sport Page Context' mode automatically displays relevant content. (Category set on page template)</p>
    <p>
      <label for="<?php echo $this->get_field_id('sport'); ?>">Sport:</label> 
<?php
    $terms = get_terms('sport');
    if(count($terms) > 0) {
      echo '<select id="'.$this->get_field_id("sport").'" name="'.$this->get_field_name("sport").'" type="text" value="'.$sport.'">';
      echo "<option value=''>Sport Page Context</option>";
      foreach ($terms as $term) { 
        if( $term->term_id === $sport )
          echo "<option value='$term->term_id' selected='selected'>$term->name ($term->count)</option>";
        else
          echo "<option value='$term->term_id'>$term->name ($term->count)</option>";
      }
      echo "</select>";
    }
    echo "</p>";
  }
}
?>