<?php
/* Template Name: Video */
get_header();
  echo "<div class='page-content col-md-8'>";
  while ( have_posts() ) : the_post();
    echo '<h1>'.get_the_title().'</h1>';
    echo nhcs_video( get_field('video_id') );
    the_date();
    echo ' by ';
    the_author();
    the_content();
    echo '<hr>';
  endwhile;
  echo '</div>';
nchs_sidebar('video');
get_footer();
?>