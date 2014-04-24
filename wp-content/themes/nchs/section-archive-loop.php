<?php
echo "<div class='page-content col-sm-7 col-md-8'>";
  if ( function_exists( 'smart_archives' ) ) {
    smart_archives('', $GLOBALS['query_string']);
  }
  else {
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
    wp_pagenavi();
  }
echo '</div>';
?>