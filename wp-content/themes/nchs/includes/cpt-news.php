<?php
$news = new CPT( [
  'post_type_name' => 'news',
  'singular' => 'News',
  'plural' => 'News',
  'slug' => 'news',
], $supports );
$news->menu_icon("dashicons-admin-post");
?>