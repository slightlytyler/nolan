<?php
$athletics = new CPT( [
  'post_type_name' => 'athletics',
  'singular' => 'Athletics',
  'plural' => 'Athletics',
  'slug' => 'athletics',
], $supports );
$athletics->menu_icon("dashicons-megaphone");
?>