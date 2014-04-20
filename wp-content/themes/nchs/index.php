<?php get_header(); ?>
  <div class='info_title'>
    <h3>This is the index page!</h3>
  </div>
  <div class='col-md-12'>
<?php
while ( have_posts() ) : the_post();
  the_title('<a href="'.get_permalink().'"><h3>','</h3></a>');
  the_date();
  the_author();
  the_excerpt();
endwhile;
?>
  </div>
<?php get_footer(); ?>