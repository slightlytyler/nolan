<?php
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

include_once('includes/NHCS_Posts2Posts.php');
NHCS_Posts2Posts::init();

/*
 * Dashboard Modifictions
 */

add_post_type_support( 'news', 'front-end-editor' );
add_post_type_support( 'athletics', 'front-end-editor' );

add_filter('admin_head', 'nchs_dashboard');
function nchs_dashboard() {
  // CPT Dashboard Image Column Width
  echo '<style type="text/css">';
  echo '.column-image {
    text-align: center;
    width: 100px !important;
    overflow: hidden;
  }';
  echo '#adminmenu div.wp-menu-image:before,
  #wpadminbar #adminbarsearch:before,
  #wpadminbar .ab-icon:before,
  #wpadminbar .ab-item:before {
    // color: #0054a3; /* @brand-logo */
    color: #2b7bc9; /* @brand-success */
    // color: #c3e1ff; /* @brand-powder-blue */
  }';
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

// Add Custom Post Type to WP-ADMIN Right Now Widget
// Ref Link: http://wpsnipp.com/index.php/functions-php/include-custom-post-types-in-right-now-admin-dashboard-widget/
// http://wordpress.org/support/topic/dashboard-at-a-glance-custom-post-types
// http://halfelf.org/2012/my-custom-posttypes-live-in-mu/
function vm_right_now_content_table_end() {
    $args = array(
        'public' => true ,
        '_builtin' => false
    );
    $output = 'object';
    $operator = 'and';
    $post_types = get_post_types( $args , $output , $operator );
    foreach( $post_types as $post_type ) {
        $num_posts = wp_count_posts( $post_type->name );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( $post_type->labels->name, $post_type->labels->name , intval( $num_posts->publish ) );
        if ( current_user_can( 'edit_posts' ) ) {
            $cpt_name = $post_type->name;
        }
        echo '<li class="post-count"><tr><a href="edit.php?post_type='.$cpt_name.'"><td class="first b b-' . $post_type->name . '"></td>' . $num . '&nbsp;<td class="t ' . $post_type->name . '">' . $text . '</td></a></tr></li>';
    }
    $taxonomies = get_taxonomies( $args , $output , $operator );
    foreach( $taxonomies as $taxonomy ) {
        $num_terms  = wp_count_terms( $taxonomy->name );
        $num = number_format_i18n( $num_terms );
        $text = _n( $taxonomy->labels->name, $taxonomy->labels->name , intval( $num_terms ));
        if ( current_user_can( 'manage_categories' ) ) {
            $cpt_tax = $taxonomy->name;
        }
        echo '<li class="post-count"><tr><a href="edit-tags.php?taxonomy='.$cpt_tax.'"><td class="first b b-' . $taxonomy->name . '"></td>' . $num . '&nbsp;<td class="t ' . $taxonomy->name . '">' . $text . '</td></a></tr></li>';
    }
}
add_action( 'dashboard_glance_items' , 'vm_right_now_content_table_end' );


/* 
 * Template Helpers
 */
function nchs_get_meta_section() {
  echo "<p class='meta'>";
    the_date();
    echo " | ";
    the_author();
  echo "</p>";
}

function nchs_people_thumbs_list( $title = null, $connection = null, $loop = null, $classes = null ) {
  // get_template_part('section', 'players');
  if( $title === null )
    $title = 'Players';
  if( $classes === null )
    $classes = 'col-xs-4 col-sm-3 col-lg-2';
  if( $connection === null )
    $connection = 'student_to_pages';
  if( $loop === null )
    $loop = 'nchs_player_loop';

  $meta_titles = [];
  array_push( $meta_titles, 'zero' );
  array_push( $meta_titles, get_field('meta_title_1') );
  array_push( $meta_titles, get_field('meta_title_2') );
  array_push( $meta_titles, get_field('meta_title_3') );
  array_push( $meta_titles, get_field('meta_title_4') );

  $student_query = new WP_Query( [
    'connected_type' => $connection,
    'connected_items' => get_queried_object(),
    'posts_per_page' => '15',
    'nopaging' => true,
    'connected_meta' => [ [
      'key' => 'hide',
      'compare' => 'NOT EXISTS'
    ] ],
  ] );
  if ( $student_query->have_posts() ) :
    echo '<h2>' . $title . '</h2>';
    while ( $student_query->have_posts() ) : $student_query->the_post(); 
      echo '<div class="' . $classes . ' nopad">';
      $loop( $meta_titles );
      nchs_the_person_image( get_field('sport_pictures') );
      echo '</div>';
    endwhile;
    wp_reset_postdata();
    echo '<div class="clearfix"></div>';
  endif;
}

function nchs_the_person_image( $pictures = null ) {
  if( $pictures === null )
    get_field('sport_pictures');
  $output = false;
  if( $pictures ) :
    foreach( $pictures as $row ) :
      if( $term->term_id === $row['sport']->term_id ) :
        $image = $row['image']['sizes']['thumbnail'];
        echo "<img src='$image' alt='' />";
        $output = true;
      endif;
    endforeach;
  endif;
  if( !$output )
    the_post_thumbnail();
}

function nchs_coach_loop( $meta_titles ) {
  echo '<div class="info">';
    echo '<h3>'.get_the_title().'</h3>';
    the_field('wpcf-coach-position');
    echo sprintf('<a href="%s">Read Bio &raquo;</a>', get_permalink() );
  echo '</div>';
}

function nchs_player_loop( $meta_titles ) {
  echo sprintf('<a href="%s">', get_permalink() );
  echo '<div class="info">';
    if( $meta_titles['1'] != '' )
      echo '<div class="number">'.p2p_get_meta( get_post()->p2p_id, 'field_1', true ).'</div>';
    echo '<h3>'.get_the_title().'</h3>';
    if( $meta_titles['2'] != '' )
      echo '<p style="clear:both; margin-bottom:0">'.p2p_get_meta( get_post()->p2p_id, 'field_2', true ).'</p>';
  echo '</div>';
  echo '</a>';
}

function nchs_student_loop( $meta_titles ) {
  // @todo
  echo '<div class="info">';
    if( $meta_titles['1'] != '' )
      echo '<div class="number">'.p2p_get_meta( get_post()->p2p_id, 'field_1', true ).'</div>';
    echo '<h3>'.get_the_title().'</h3>';
    if( $meta_titles['2'] != '' )
      echo '<p style="clear:both; margin-bottom:0">'.p2p_get_meta( get_post()->p2p_id, 'field_2', true ).'</p>';
  echo '</div>';
  echo '</a>';
}

// Searchform
function nchs_search_form( $form = null, $classes = null ) {
  if ( $form == null ) $form = '';
  if ( $classes == null ) $classes = '';
  $form = '<form class="' . $classes . '" role="search" method="get" id="searchform" action="'. home_url( '/' ) . '">
    <div class="form-group input-group">
      <input type="text" value="' . get_search_query() . '" name="s" id="s" class="form-control" placeholder="Search">
      <span class="input-group-btn">
        <button type="submit" id="searchsubmit" class="btn btn-success">
          <i class="fa fa-search"></i>
        </button>
      </span>
    </div>
  </form>';
  return $form;
}
add_filter( 'get_search_form', 'nchs_search_form' );

// Sidebar Helper
function nchs_sidebar( $sidebar = null ) {
  if ( $sidebar == 'video' ) {
    echo "<div class='right col-md-4'>";
  }
  elseif ( $sidebar == 'home' ) {
    echo "<div class='right col-md-4'>";
  }
  else {
    echo "<div class='right col-sm-5 col-md-4'>";
  }
  if ( $sidebar == null ) {
    $sidebar = 'archive';
  }
    echo "<div class='right_sidebar'>";
      echo "<ul class='widgets'>";
        if ( !dynamic_sidebar( $sidebar . '-sidebar' ) ) {}
      echo "</ul>";
    echo "</div>";
  echo "</div>";
}

// Responsive Video Container
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
      if ( $post == 'ministry' )
        nchs_minister_card();
      else
        nchs_teacher_card();
    endwhile;
    wp_reset_postdata();
  endif;
}

function nchs_minister_card() {
  echo '<div class="card">';
    echo sprintf( "<div class='col-sm-4 nopad'>%s</div>", get_the_post_thumbnail() );
    echo "<div class='card-info col-sm-8 nopad'>";
      echo '<h3>' . get_field( 'title' ) . '</h3>';
      the_title( '<h5>', '</h5>' );
    echo "</div>";
    echo "<div class='clearfix'></div>";
  echo "</div>";
}

function nchs_teacher_card() {
  echo '<div class="card">';
  if( get_field('title') == "Department Head" )
    echo '<h3>'.get_field('title').' - '.get_the_title().'</h3>';
  else
    echo '<h3>'.get_the_title().'</h3>';
    echo sprintf( "<div class='col-sm-4 nopad'>%s</div>", get_the_post_thumbnail() );
?>
    <div class='card-info col-sm-8 nopad'>
      <p><strong>Teaches:</strong> <?php the_field('teaches'); ?></p>
      <p><strong>Education:</strong><br><?php the_field('education'); ?></p>
      <?php if ( get_field('recognitions') ) : ?>
        <p><strong>Recognitions:</strong><br><?php the_field('recognitions'); ?></p>
      <?php endif; ?>
      <p><strong><?php echo date('Y') - get_field('since'); ?> Years of service</strong></p>
    </div>
<?php
    echo "<div class='clearfix'></div>";
  echo "</div>";
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

function nhcs_the_transient_json( $spreadsheet_id ) {
  $key = 'gdoc_' + $spreadsheet_id;
  $transient = get_transient( $key );
  if( $transient ) {
    $gdoc_spreadsheet_data = $transient;
  }
  else {
    $response = wp_remote_request("http://spreadsheets.google.com/feeds/list/".$spreadsheet_id."/od6/public/basic?alt=json-in-script");
    set_transient( $key, $response['body'], 600 );
    $gdoc_spreadsheet_data = $response['body'];
    // https://spreadsheets.google.com/feeds/list/1_VHSGDt19QbriEOR55C1WwT1fIm1YPBHuekzsV1kJVs/od6/public/basic
  }
  echo "<script type='text/javascript'>" . $gdoc_spreadsheet_data . "</script>";
}

/* 
 * Theme Setup
 */

NHCS_ThemeSetup::init();
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
      // $query->set( 'posts_per_page', '3' );
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
    // unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
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
      'name' => __( 'Athletics Sidebar', 'nchs' ),
      'id' => 'athletics-sidebar',
      'description' => __( 'Shown on Athletics Archive and Single Posts', 'nchs' ),
      // 'before_widget' => '',
      // 'after_widget'  => ''
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
      'name' => __( 'Homepage Bottom', 'nchs' ),
      'id' => 'homepage-bottom',
      'description' => __( 'The homepage bottom widget area', 'nchs' ),
      'before_widget' => '<div class="col-md-6 promo">',
      'after_widget'  => '</div>'
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


// Options General - Add Field
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

/**
* Add custom icons using Dashicons for Gravity Forms.
*
* This outputs some extra stlying to force Gravity Forms to use a modern
* dashicon in the wp-admin sidebar.
*
* @author  Robert Neu
* @link    http://melchoyce.github.io/dashicons/
*/
function prefix_gforms_admin_css() {
  $css = '<style type="text/css">';
    $css .= '#adminmenu #toplevel_page_gf_edit_forms div.wp-menu-image img { display: none }';
    $css .= '#adminmenu #toplevel_page_gf_edit_forms div.wp-menu-image:before { content: "\f175"; }';
  $css .= '</style>';
  echo $css;
}
add_action('admin_head', 'prefix_gforms_admin_css');


/**
 * Custom post type date archives
 * 
 * A good solution to a problem solved another way. 
 * Generates date archives for news and athletics,
 * but nothing links to the pages created.
 * 
 * @todo Fix or Remove?
 */

/**
 * Custom post type specific rewrite rules
 * @return wp_rewrite             Rewrite rules handled by Wordpress
 */
function cpt_rewrite_rules($wp_rewrite) {
    $news_rules = cpt_generate_date_archives('news', $wp_rewrite);
    $wp_rewrite->rules = $news_rules + $wp_rewrite->rules;
    $athletics_rules = cpt_generate_date_archives('athletics', $wp_rewrite);
    $wp_rewrite->rules = $athletics_rules + $wp_rewrite->rules;
    return $wp_rewrite;
}
add_action('generate_rewrite_rules', 'cpt_rewrite_rules');

/**
 * Generate date archive rewrite rules for a given custom post type
 * @param  string $cpt        slug of the custom post type
 * @return rules              returns a set of rewrite rules for Wordpress to handle
 */
function cpt_generate_date_archives($cpt, $wp_rewrite) {
    $rules = array();

    $post_type = get_post_type_object($cpt);
    $slug_archive = $post_type->has_archive;
    if ($slug_archive === false) return $rules;
    if ($slug_archive === true) {
        $slug_archive = $post_type->name;
    }

    $dates = array(
        array(
            'rule' => "([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})",
            'vars' => array('year', 'monthnum', 'day')),
        array(
            'rule' => "([0-9]{4})/([0-9]{1,2})",
            'vars' => array('year', 'monthnum')),
        array(
            'rule' => "([0-9]{4})",
            'vars' => array('year'))
        );

    foreach ($dates as $data) {
        $query = 'index.php?post_type='.$cpt;
        $rule = $slug_archive.'/'.$data['rule'];

        $i = 1;
        foreach ($data['vars'] as $var) {
            $query.= '&'.$var.'='.$wp_rewrite->preg_index($i);
            $i++;
        }

        $rules[$rule."/?$"] = $query;
        $rules[$rule."/feed/(feed|rdf|rss|rss2|atom)/?$"] = $query."&feed=".$wp_rewrite->preg_index($i);
        $rules[$rule."/(feed|rdf|rss|rss2|atom)/?$"] = $query."&feed=".$wp_rewrite->preg_index($i);
        $rules[$rule."/page/([0-9]{1,})/?$"] = $query."&paged=".$wp_rewrite->preg_index($i);
    }
    return $rules;
}
?>