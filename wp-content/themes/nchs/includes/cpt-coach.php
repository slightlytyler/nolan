<?php
$coach = new CPT( [
  'post_type_name' => 'coach',
  'singular' => 'Coach',
  'plural' => 'Coaches',
  'slug' => 'coach',
], $supports );
$coach->columns( $faculty_columns );
$coach->populate_column('since', function($column, $post) {
  the_field('since');
});
$coach->populate_column('image', function($column, $post) {
  the_post_thumbnail( 'nchs-admin' );
});
$coach->menu_icon("dashicons-clipboard");
?>