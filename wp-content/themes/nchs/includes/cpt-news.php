<?php
$news = new CPT( [
  'post_type_name' => 'news',
  'singular' => 'News',
  'plural' => 'News',
  'slug' => 'news',
], [
  'supports' => [ 'title', 'editor', 'thumbnail' ],
  'has_archive' => 'news',
  'taxonomies' => [ 'category', 'post_tag' ]
] );
$news->columns(array(
  'cb' => '<input type="checkbox" />',
  'image' => __('Image'),
  'title' => __('Name'),
  'category' => __('Categories'),
  'post_tag' => __('Tags'),
  'date' => __('Date')
));
$news->populate_column('image', 'post_image_column');
$news->menu_icon("dashicons-admin-post");
?>