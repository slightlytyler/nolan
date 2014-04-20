<?php
/* Template Name: Sport */
get_header();
$coach_query = new WP_Query( [
  'connected_type' => 'coach_to_pages',
  'connected_items' => get_queried_object(),
  'posts_per_page' => '15',
  'nopaging' => true
] );
$player_query = new WP_Query( [
  'connected_type' => 'player_to_pages',
  'connected_items' => get_queried_object(),
  'posts_per_page' => '15',
  'nopaging' => true
] );
?>
<div class='col-sm-8'>
  <div>
<?php
  while ( have_posts() ) : the_post();
    the_content();
  endwhile;
  wp_reset_postdata();
  echo '</div><div>';
  if ( $coach_query->have_posts() ) :
    echo '<h2>Coaches</h2>';
    while ( $coach_query->have_posts() ) : $coach_query->the_post(); 
      if( get_field('title') == "Department Head" )
        echo '<h3>'.get_field('title').' - '.get_the_title().'</h3>';
      else
        echo '<h3>'.get_the_title().'</h3>';
      the_post_thumbnail();
    endwhile;
    wp_reset_postdata();
  endif;
  echo '</div><div>';
if ( $player_query->have_posts() ) :
  echo '<h2>Players</h2>';
  while ( $player_query->have_posts() ) : $player_query->the_post(); 
    if( get_field('title') == "Department Head" )
      echo '<h3>'.get_field('title').' - '.get_the_title().'</h3>';
    else
      echo '<h3>'.get_the_title().'</h3>';
    the_post_thumbnail();
  endwhile;
  wp_reset_postdata();
  echo '</div>';
endif;
?>
</div>
<div class='col-sm-4'>
  <div class='right_sidebar'>
    <ul class="widgets">
      <?php if ( !dynamic_sidebar( 'sport-sidebar' ) ) {} ?>
    </ul>
  </div>
</div>
<?php 
get_footer();
?>