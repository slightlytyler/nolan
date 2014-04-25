<?php
$slide = new CPT( [
  'post_type_name' => 'slide',
  'singular' => 'Slide',
  'plural' => 'Slides',
  'slug' => 'slide',
], [
  'hierarchical' => 'true',
  'supports' => [ 'title', 'page-attributes' ],
  'exclude_from_search' => 'true',
] );
$slide->columns(array(
  'cb' => '<input type="checkbox" />',
  'foreground' => __('Foreground'),
  'title' => __('Title'),
  'slide_text' => __('Text'),
  'background' => __('Background'),
  'date' => __('Date')
));
$slide->populate_column('slide_text', function($column, $post) {
  the_field('text');
});
$slide->populate_column('foreground', function($column, $post) {
  echo '<img src="'. get_field('foreground')['sizes']['nchs-square'] . '" />';
});
$slide->populate_column('background', function($column, $post) {
  echo '<img src="'. get_field('background')['sizes']['nchs-square'] . '" />';
});
$slide->menu_icon("dashicons-format-image");
?>