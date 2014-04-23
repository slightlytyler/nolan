<?php
/* Template Name: Video Full */
get_header();
  echo "<div class='page-content col-sm-12'>";
  while ( have_posts() ) : the_post();
    echo '<h1>'.get_the_title().'</h1>';
    echo nhcs_video( get_field('video_id') );
  echo '</div>';
  echo "<div class='page-content col-sm-8'>";
    the_date();
    echo ' by ';
    the_author();
    the_content();
  echo '</div>';
  endwhile;
nchs_sidebar('video');
get_footer();
?>