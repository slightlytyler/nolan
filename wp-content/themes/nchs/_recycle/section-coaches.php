<?php
// $meta_title_1 = get_field('meta_title_1');
// $meta_title_2 = get_field('meta_title_2');
// $meta_title_3 = get_field('meta_title_3');
// $meta_title_4 = get_field('meta_title_4');
$coach_query = new WP_Query( [
'connected_type' => 'coach_to_pages',
'connected_items' => get_queried_object(),
'posts_per_page' => '15',
'nopaging' => true
] );
if ( $coach_query->have_posts() ) :
echo "<div class='col-sm-12'>";
  echo '<h2>Coaches</h2>';
  while ( $coach_query->have_posts() ) : $coach_query->the_post();
    echo '<div class="coach-picture col-xs-6 col-sm-4 col-md-3 col-lg-4 nopad">';
      echo '<div class="info">';
        echo '<h3>'.get_the_title().'</h3>';
        the_field('wpcf-coach-position');
        echo sprintf(' | <a href="%s">Read Bio &raquo;</a>', get_permalink() );
      echo '</div>';
    the_post_thumbnail();
    echo '</div>';
  endwhile;
  wp_reset_postdata();
echo '<div class="clearfix"></div></div>';
endif;
?>