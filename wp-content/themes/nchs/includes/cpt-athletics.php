<?php
$athletics = new CPT( [
  'post_type_name' => 'athletics',
  'singular' => 'Athletics',
  'plural' => 'Athletics',
  'slug' => 'athletics',
], [
  'supports' => [ 'title', 'editor', 'thumbnail' ],
  'has_archive' => 'athletics',
] );
$athletics->filters(['sport']);
$athletics->columns([
  'cb' => '<input type="checkbox" />',
  'image' => __('Image'),
  'title' => __('Name'),
  'sport' => __('Sport'),
  'date' => __('Date')
]);
$athletics->populate_column('image', 'post_image_column');
$athletics->menu_icon("dashicons-megaphone");
?>