<?php
/* Template Name: Sport */
get_header(); ?>
  <div class='col-md-8'>
<?php
while ( have_posts() ) : the_post();
  the_title('<h2>','<h2>');
  the_content();
endwhile;
?>
  </div>
  <div class='col-sm-4 right_sidebar'>
    <?php get_sidebar("sport") ?>
  </div>
<?php get_footer() ?>