<?php
$coach = new CPT( array(
  'post_type_name' => 'coach',
  'singular' => 'Coach',
  'plural' => 'Coaches',
  'slug' => 'coach',
), array(
  'supports' => array('title', 'editor', 'thumbnail'),
) );
$coach->columns( [
  'cb' => '<input type="checkbox" />',
  'image' => __('Image'),
  'title' => __('Name'),
  'since' => __('Since'),
  'sport' => __('Sport'),
  'date' => __('Date')
] );
$coach->populate_column('since', function($column, $post) {
  the_field('since');
});
$coach->populate_column('image', function($column, $post) {
  the_post_thumbnail( 'nchs-admin' );
});
$coach->menu_icon("dashicons-clipboard");
?>