<?php get_header(); ?>
  <div class='info_title'>
    <h3>This is the athletics index page!</h3>
  </div>
<?php
echo "<div class='page-content col-sm-7 col-md-8'>";
  get_template_part('loop-archive');
echo "</div>";
nchs_sidebar();
get_footer();
?>