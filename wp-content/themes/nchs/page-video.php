<?php
/* Template Name: Video */
get_header();
  echo "<div class='page-content col-md-8'>";
  while ( have_posts() ) : the_post();
    echo '<h1>'.get_the_title().'</h1>';
    echo '<div class="video-container">';
      echo '<iframe width="420" height="315" src="//www.youtube.com/embed/'.get_field('youtube_video_id').'" frameborder="0" allowfullscreen></iframe>';
    echo '</div>';
    the_date();
    echo ' by ';
    the_author();
    the_content();
    echo '<hr>';
  endwhile;
  echo '</div>';
  echo "<div class='col-md-4 right_sidebar'>";
    get_sidebar("page");
  echo '</div>';
get_footer();
?>