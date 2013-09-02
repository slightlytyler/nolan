<?php

function nchs_register_menus() {
  register_nav_menus( array(
  	'nchs-main-menu' 	=> __('Main Menu'),
  	'nchs-nav-menu' 	=> __('Nav Menu')
  ) );
}
add_action( 'init', 'nchs_register_menus' );

function add_sport_column ($original_columns) {
  $new_columns['cb'] 		= '<input type="checkbox" />';
  $new_columns['title'] = 'Name';
  $new_columns['sport'] = 'Sport';
  $new_columns['date'] 	= 'Date';

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
  $new_columns['cb'] 		= '<input type="checkbox" />';
  $new_columns['title'] = 'Name';
  $new_columns['news_categories'] = 'Categories';
  $new_columns['comments'] = '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>';
  $new_columns['date'] 	= 'Date';

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

?>