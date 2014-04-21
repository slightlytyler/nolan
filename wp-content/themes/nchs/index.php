<?php get_header(); ?>
  <div class='info_title'>
    <h3>This is the index page!</h3>
  </div>
<?php
echo "<div class='col-sm-8'>";
  while ( have_posts() ) : the_post();
    the_title('<a href="'.get_permalink().'"><h3>','</h3></a>');
    the_date();
    the_author();
    the_excerpt();
  endwhile;
  previous_posts_link();
  echo ' | ';
  next_posts_link();
  echo paginate_links();
echo '</div>';
get_sidebar();
get_footer();
?>