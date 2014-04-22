<?php
$slide = new CPT( [
  'post_type_name' => 'slide',
  'singular' => 'Slide',
  'plural' => 'Slides',
  'slug' => 'slide',
], $supports );
$slide->menu_icon("dashicons-align-none");
?>