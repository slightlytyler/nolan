<?php
/* Template Name: Club */
get_header();
echo "<div class='page-content col-sm-7 col-md-8'>";
  get_template_part('loop');
  echo "<div class='clearfix'></div>";
  nchs_people_thumbs_list( 'Students', 'student_to_pages', 'nchs_student_loop', 'player-picture col-xs-4 col-sm-3 col-lg-2' );
echo "</div>";
nchs_sidebar("page");
get_footer();
?>