<?php
// @todo transient cache for spreadsheet template
// $response = wp_remote_request('http://docs.google.com/spreadsheets/d/1_VHSGDt19QbriEOR55C1WwT1fIm1YPBHuekzsV1kJVs/pubhtml');
// print_r($response);

include_once('includes/CPT.php');

$faculty_columns = [
  'cb' => '<input type="checkbox" />',
  'image' => __('Image'),
  'title' => __('Name'),
  'since' => __('Since'),
  'date' => __('Date'),
];

function post_image_column($column, $post) {
  the_post_thumbnail( 'nchs-square' );
}
function person_image_column($column, $post) {
  the_post_thumbnail( 'nchs-admin' );
}

include_once('includes/cpt-faculty.php');
include_once('includes/cpt-coach.php');
include_once('includes/cpt-ministry.php');
include_once('includes/cpt-student.php');

include_once('includes/cpt-slide.php');
include_once('includes/cpt-news.php');
include_once('includes/cpt-athletics.php');

include_once('widgets/athletics-widget.php');
include_once('widgets/news-widget.php');
include_once('widgets/sport-events-widget.php');
include_once('widgets/sport-news-widget.php');
include_once('widgets/subpages-widget.php');

include_once('includes/NHCS_Posts2Posts.php');
NHCS_Posts2Posts::init();

/*
 * Dashboard Modifictions
 */

add_filter('admin_head', 'nchs_dashboard');
function nchs_dashboard() {
  // CPT Dashboard Image Column Width
  echo '<style type="text/css">';
  echo '.column-image { text-align: center; width: 100px !important; overflow: hidden }';
  echo '</style>';
  // Save the page on template change, so user sees correct interface for template.
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

/* 
 * Template Helpers
 */

function nhcs_video( $id ) {
  if ( is_numeric( $id ) )
    $url = '//player.vimeo.com/video/'.$id;
  else
    $url = '//www.youtube.com/embed/'.$id;
  return sprintf( '<div class="video-container"><iframe src="%s" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>', $url );
}

function nchs_display_cards( $post ) {
  $connected = new WP_Query( array(
    'connected_type' => $post . '_to_pages',
    'connected_items' => get_queried_object(),
    'nopaging' => true,
  ) );
  if ( $connected->have_posts() ) :
    $title = ucfirst($post);
    echo "<h2>$title</h2>";
    while ( $connected->have_posts() ) : $connected->the_post(); 
      echo '<div class="card">';
      if( get_field('title') == "Department Head" )
        echo '<h3>'.get_field('title').' - '.get_the_title().'</h3>';
      else
        echo '<h3>'.get_the_title().'</h3>';
      echo sprintf( "<div class='col-sm-4 nopad'>%s</div>", get_the_post_thumbnail() );
?>
      <div class='col-sm-8 nopad'>
        <p><strong>Teaches:</strong> <?php the_field('teaches'); ?></p>
        <p><strong>Education:</strong> <?php the_field('education'); ?></p>
        <p><strong><?php echo date('Y') - get_field('since'); ?> Years of service</strong></p>
      </div>
<?php
      echo "<div class='clearfix'></div>";
    echo "</div>";
    endwhile;
    wp_reset_postdata();
  endif;
}

include_once('includes/Bootstrap_Walker.php');

function nhcs_get_nav( $menu, $mobile_only = null ) {
  if($mobile_only == null) $mobile_only = false;
  $class = str_replace( '-menu', '', $menu );
  $args = array( 
    'menu_class' => 'nav navbar-nav '.$class,
    'theme_location'  => $menu,
    'container' => '',
    // 'fallback_cb' => 'wp_bootstrap_main_nav_fallback',
    // 'depth' => '2',  suppress lower levels
    'walker' => new Bootstrap_Walker()
  );
  if ( $mobile_only ) $args['menu_class'] = "nav navbar-nav visible-xs";
  wp_nav_menu( $args );
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
    add_action( 'pre_get_posts', [ __CLASS__, 'nchs_add_post_types_to_query' ] );
    add_action( 'restrict_manage_posts', [ __CLASS__, 'nchs_add_taxonomy_filters' ] );
    add_filter( 'post_thumbnail_html', [ __CLASS__, 'nchs_remove_width_attribute' ] );
    add_filter( 'image_send_to_editor', [ __CLASS__, 'nchs_remove_width_attribute' ] );
    add_filter( 'wp_pagenavi', [ __CLASS__, 'nchs_pagination' ] );
  }

  // add_filter( 'manage_taxonomies_for_athletics_columns', 'activity_type_columns' );
  // function activity_type_columns( $taxonomies ) {
  //   $taxonomies[] = 'sport';
  //   return $taxonomies;
  // }

  public function nchs_remove_width_attribute( $html ) {
    // Don't use width on <img tags
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
  }

  public function nchs_pagination($html) {
    //customize the PageNavi HTML before it is output
    $out = '';
    $out = str_replace("<a","<li><a",$html);  
    $out = str_replace("</a>","</a></li>",$out);
    $out = str_replace("<span","<li><span",$out); 
    $out = str_replace("</span>","</span></li>",$out);
    $out = str_replace("<div class='wp-pagenavi'>","",$out);
    $out = str_replace("</div>","",$out);
    return '<ul class="pagination">'.$out.'</ul>';
  }

  public function nchs_add_post_types_to_query( $query ) {
    // Modify the Homepage Query
    if ( $query->is_main_query() && is_home() ) {
      // show athletics and news on the homepage
      $query->set( 'post_type', array( 'news', 'athletics' ) );
      $query->set( 'posts_per_page', '3' );
    }
    // elseif ( $query->is_main_query() && is_tax('sport') ) {
    //   // show past events on the sport tag archives
    //   $query->set( 'post_type', array( 'event', 'athletics' ) );
    //   $query->set( 'posts_per_page', '10' );
    // }
    else {
      return $query;
    }
  }

  // WP Admin Taxonomy Filters
  public function nchs_add_taxonomy_filters() {
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

  public function nchs_init() {
    register_nav_menus( array(
      'nchs-main-menu'  => __('Main Menu'),
      'nchs-nav-menu'   => __('Nav Menu')
    ) );
    register_taxonomy( 'sport',
      [ 'athletics',
        'event',
      ],
      [ 'label' => __( 'Sport' ),
        'rewrite' => [ 'slug' => 'sport' ],
        'hierarchical' => false,
        'show_admin_column' => true,
      ]
    );
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
    register_widget( 'Subpages_Widget' );
    register_sidebar( array(
      'name' => __( 'Sport Page Sidebar', 'nchs' ),
      'id' => 'sport-sidebar',
      'description' => __( 'Sidebar for the page-sport.php template', 'nchs' )
    ) );
    register_sidebar( array(
      'name' => __( 'Archive Sidebar', 'nchs' ),
      'id' => 'archive-sidebar',
      'description' => __( 'The default/index sidebar', 'nchs' )
    ) );
    register_sidebar( array(
      'name' => __( 'Student Sidebar', 'nchs' ),
      'id' => 'student-sidebar',
      'description' => __( 'Sidebar for the single student pages', 'nchs' )
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
      'description' => __( 'Default page widget area.', 'nchs' )
    ) );
    register_sidebar( array(
      'name' => __( 'Homepage Ribbion', 'nchs' ),
      'id' => 'homepage-ribbion',
      'description' => __( 'The homepage ribbion widget area', 'nchs' ),
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
      'description' => __( 'The homepage bottom widget area', 'nchs' ),
      'before_widget' => '<div class="col-md-6">',
      'after_widget'  => '</div>'
    ) );
    register_sidebar( array(
      'name' => __( 'Homepage Right Widget Area', 'nchs' ),
      'id' => 'homepage-right-widget-area',
      'description' => __( 'The homepage right widget area', 'nchs' ),
      'before_widget' => '',
      'after_widget'  => ''
    ) );
  }

  public function nchs_after_setup_theme() { 
    /* CUSTOM IMAGE SIZE */
    if ( function_exists( 'add_theme_support' ) ) {
      add_theme_support( 'post-thumbnails' );
      set_post_thumbnail_size( 400, 500 );
    }
    $image_sizes = [
      [ 'nchs-square', 100, 100 ],
      [ 'nchs-admin', 125, 100 ],
      [ 'nchs-background', 1251, 328 ],
      [ 'nchs-foreground', 9999, 254 ],
      [ 'nchs-slide-background', 1242, 332 ],
      [ 'nchs-slide-foreground', 9999, 332 ],
      [ 'nchs-coach', 200, 250 ],
      [ 'nchs-player', 200, 250 ],
      [ 'nchs-player-large', 400, 500 ],
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

// function add_sport_column ($original_columns) {
//   $new_columns['cb']    = '<input type="checkbox" />';
//   $new_columns['title'] = 'Name';
//   $new_columns['sport'] = 'Sport';
//   $new_columns['date']  = 'Date';
//   return $new_columns;
// }
// add_filter('manage_edit-player_columns', 'add_sport_column');
// add_filter('manage_edit-coach_columns', 'add_sport_column');

// function manage_player_sport_columns($column_name, $id) {
//   global $wpdb;
//   switch ($column_name) {
//   case 'sport':
//     $taxonomies = wp_get_post_terms($id, 'sport');
//     foreach ($taxonomies as $taxonomy) {
//       echo $taxonomy->name;
//     }
//     break;
//   default:
//     break;
//   }
// }
// add_action('manage_player_posts_custom_column', 'manage_player_sport_columns', 10, 2);
// add_action('manage_coach_posts_custom_column', 'manage_player_sport_columns', 10, 2);

?>