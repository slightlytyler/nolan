<?php
if ( have_posts() ) :
  while ( have_posts() ) : the_post();
    the_title( '<h1>', '</h1>' );
    the_content();
    echo '<hr>';
  endwhile;
  wp_reset_postdata();
  echo "<div class='clearfix'></div>";
endif;
?>