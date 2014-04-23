<?php
$coach = new CPT( [
  'post_type_name' => 'coach',
  'singular' => 'Coach',
  'plural' => 'Coaches',
  'slug' => 'coach',
], [
  'supports' => [ 'title', 'editor', 'thumbnail' ],
  // 'has_archive' => 'true',
  'exclude_from_search' => 'true',
] );
$coach->columns( $faculty_columns );
$coach->populate_column('since', function($column, $post) {
  the_field('since');
});
$coach->populate_column('image', 'person_image_column');
$coach->menu_icon("dashicons-clipboard");
?>