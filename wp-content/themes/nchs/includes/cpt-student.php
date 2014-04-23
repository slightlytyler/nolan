<?php
$student = new CPT( [
  'post_type_name' => 'student',
  'singular' => 'Student',
  'plural' => 'Students',
  'slug' => 'student',
], [
  'supports' => [ 'title', 'editor', 'thumbnail' ],
  // 'has_archive' => 'false',
  'exclude_from_search' => 'true',
] );
$student->columns(array(
  'cb' => '<input type="checkbox" />',
  'image' => __('Image'),
  'title' => __('Name'),
  'graduation_year' => __('Graduates'),
  'date' => __('Date')
));
$student->populate_column('graduation_year', function($column, $post) {
  the_field('graduation_year');
});
$student->populate_column('image', 'person_image_column');
$student->menu_icon("dashicons-welcome-learn-more");
?>