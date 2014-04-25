<?php
get_header();
echo "<div class='page-content col-sm-7 col-md-8'>";
  get_template_part( 'loop' );
echo '</div>';
nchs_sidebar( 'athletics' );
get_footer();
?>