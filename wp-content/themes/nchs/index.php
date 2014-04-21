<?php get_header(); ?>
  <div class='info_title'>
    <h3>This is the index page!</h3>
  </div>
<?php
echo "<div class='page-content col-sm-7 col-md-8'>";
  while ( have_posts() ) : the_post();
    echo "<div class='post'>";
    the_title('<a href="'.get_permalink().'"><h3>','</h3></a>');
    echo "<p class='meta'>";
    the_date();
    echo " | ";
    the_author();
    echo "</p>";
    the_post_thumbnail();
    the_excerpt();
    echo "<div class='clearfix'></div>";
    echo "</div>";
  endwhile;
  previous_posts_link();
  echo ' | ';
  next_posts_link();
  echo paginate_links();
echo '</div>';
get_sidebar();
get_footer();
?>