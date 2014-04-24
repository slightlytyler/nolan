<?php
/* Template Name: Department */
get_header();
echo "<div class='page-content col-sm-7 col-md-8'>";
  get_template_part('loop');
  nchs_display_cards( 'faculty' );
echo "</div>";
nchs_sidebar("page");
get_footer();
?>