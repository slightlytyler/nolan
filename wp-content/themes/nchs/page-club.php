<?php
/* Template Name: Club */

get_header();
  echo "<div class='page-content col-sm-7 col-md-8'>";
  while ( have_posts() ) : the_post();
    echo '<h1>'.get_the_title().'</h1>';
    the_content();
    echo '<hr>';
  endwhile;
  get_template_part( 'section', 'students' );
  echo "</div>";
get_sidebar("page");
get_footer();
?>