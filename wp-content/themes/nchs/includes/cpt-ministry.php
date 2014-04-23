<?php
$ministry = new CPT( [
  'post_type_name' => 'ministry',
  'singular' => 'Minister',
  'plural' => 'Ministry',
  'slug' => 'ministry',
], [
  'supports' => [ 'title', 'editor', 'thumbnail' ],
  // 'has_archive' => 'true',
  'exclude_from_search' => 'true',
] );
$ministry->columns($faculty_columns);
$ministry->populate_column('since', function($column, $post) {
  the_field('since');
});
$ministry->populate_column('image', 'person_image_column');
$ministry->menu_icon("dashicons-shield");
?>