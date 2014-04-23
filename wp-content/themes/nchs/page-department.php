<?php
/* Template Name: Department */
get_header();
  echo "<div class='page-content col-sm-7 col-md-8'>";
    while ( have_posts() ) : the_post();
      echo '<h1>'.get_the_title().'</h1>';
      the_content();
      echo '<hr>';
    endwhile;
    nchs_display_cards( 'faculty' );
  echo "</div>";
get_sidebar("page");
get_footer();
?>