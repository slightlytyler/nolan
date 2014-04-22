<?php
$faculty = new CPT( [
  'post_type_name' => 'faculty',
  'singular' => 'Teacher',
  'plural' => 'Faculty',
  'slug' => 'faculty',
], $supports );
$faculty->columns($faculty_columns);
$faculty->populate_column('since', function($column, $post) {
  the_field('since');
});
$faculty->populate_column('image', function($column, $post) {
  the_post_thumbnail( 'nchs-admin' );
});
$faculty->menu_icon("dashicons-nametag");
?>