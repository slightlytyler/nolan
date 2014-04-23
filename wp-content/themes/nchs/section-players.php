<?php
$meta_title_1 = get_field('meta_title_1');
$meta_title_2 = get_field('meta_title_2');
$meta_title_3 = get_field('meta_title_3');
$meta_title_4 = get_field('meta_title_4');
$student_query = new WP_Query( [
'connected_type' => 'student_to_pages',
'connected_items' => get_queried_object(),
'posts_per_page' => '15',
'nopaging' => true,
'connected_meta' => [ [
  'key' => 'hide',
  'compare' => 'NOT EXISTS'
] ],
] );
if ( $student_query->have_posts() ) :
echo "<div class='col-sm-12'>";
  echo '<h2>Players</h2>';
while ( $student_query->have_posts() ) : $student_query->the_post(); 
  echo '<div class="player-picture col-xs-4 col-sm-3 col-lg-2 nopad">';
  echo sprintf('<a href="%s">', get_permalink() );
  echo '<div class="info">';
    if( $meta_title_1 != '' )
      echo '<div class="number">'.p2p_get_meta( get_post()->p2p_id, 'field_1', true ).'</div>';
    if( get_field('title') == "Department Head" )
      echo '<h3>'.get_field('title').' - '.get_the_title().'</h3>';
    else
      echo '<h3>'.get_the_title().'</h3>';
    if( $meta_title_2 != '' )
      echo '<p style="clear:both; margin-bottom:0">'.p2p_get_meta( get_post()->p2p_id, 'field_2', true ).'</p>';
  echo '</div>';
  echo '</a>';
  $pictures = get_field('sport_pictures');
  $output = false;
  if( $pictures ) :
    foreach( $pictures as $row ) :
      if( $term->term_id === $row['sport']->term_id ) :
        $image = $row['image']['sizes']['thumbnail'];
        echo "<img src='$image' alt='' />";
        $output = true;
      endif;
    endforeach;
  endif;
  if( !$output )
    the_post_thumbnail();
echo '</div>';
endwhile;
wp_reset_postdata();
echo '<div class="clearfix"></div></div>';
endif;
?>