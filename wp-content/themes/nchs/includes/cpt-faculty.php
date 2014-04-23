<?php
$faculty = new CPT( [
  'post_type_name' => 'faculty',
  'singular' => 'Teacher',
  'plural' => 'Faculty',
  'slug' => 'faculty',
], [
  'supports' => [ 'title', 'editor', 'thumbnail' ],
  // 'has_archive' => 'true',
  'exclude_from_search' => 'true',
] );
$faculty->columns($faculty_columns);
$faculty->populate_column('since', function($column, $post) {
  the_field('since');
});
$faculty->populate_column('image', 'person_image_column');
$faculty->menu_icon("dashicons-nametag");
?>