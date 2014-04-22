<?php
$ministry = new CPT( [
  'post_type_name' => 'ministry',
  'singular' => 'Minister',
  'plural' => 'Ministry',
  'slug' => 'ministry',
] );
$ministry->columns($faculty_columns);
$ministry->populate_column('since', function($column, $post) {
  the_field('since');
});
$ministry->populate_column('image', function($column, $post) {
  the_post_thumbnail( 'nchs-admin' );
});
$ministry->menu_icon("dashicons-shield");
?>