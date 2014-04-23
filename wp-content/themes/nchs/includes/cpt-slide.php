<?php
$slide = new CPT( [
  'post_type_name' => 'slide',
  'singular' => 'Slide',
  'plural' => 'Slides',
  'slug' => 'slide',
], [
  'supports' => [ 'title' ],
  'exclude_from_search' => 'true',
] );
$slide->menu_icon("dashicons-format-image");
?>