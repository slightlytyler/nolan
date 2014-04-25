<?php 
if ( have_posts() ) :
  wp_pagenavi();
  while ( have_posts() ) : the_post();
    echo "<div class='post'>";
    the_title('<a href="'.get_permalink().'"><h3>','</h3></a>');
    nchs_get_meta_section();
    the_post_thumbnail();
    the_excerpt();
    echo "<div class='clearfix'></div>";
    echo "</div>";
  endwhile;
  wp_pagenavi();
  wp_reset_postdata();
  // echo "<div class='clearfix'></div>";
endif;
?>