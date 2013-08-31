<?php

function nchs_register_menus() {
  register_nav_menus( array(
  	'nchs-main-menu' 	=> __('Main Menu'),
  	'nchs-nav-menu' 	=> __('Nav Menu')
  ) );
}
add_action( 'init', 'nchs_register_menus' );

function add_sport_column ($gallery_columns) {
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

?>