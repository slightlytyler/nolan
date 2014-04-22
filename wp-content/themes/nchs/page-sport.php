<?php
/* Template Name: Sport */
get_header();
$term = get_term( get_field('news_category'), 'sport' );
$news_query = new WP_Query( [ 
  'post_type' => 'athletics',
  'posts_per_page' => '5',
  'sport' => $term->slug
] );
$coach_query = new WP_Query( [
  'connected_type' => 'coach_to_pages',
  'connected_items' => get_queried_object(),
  'posts_per_page' => '15',
  'nopaging' => true
] );
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
?>
<div class='page-content col-sm-8'>
<?php
if( $news_query->have_posts() ) :
  echo '<div>';
  echo $before_widget;
  if ( $title )
    echo $before_title . $title . $after_title;
  else
    echo $before_title . $term->slug . ' News' . $after_title;
  echo '<ul>';
  while ( $news_query->have_posts() ) : $news_query->the_post();
    echo sprintf( "<li><a href='%s'>%s</a></li>", get_permalink(), get_the_title() );
    // the_excerpt();
  endwhile;
  wp_reset_postdata();
  echo '</ul>';
  echo $after_widget;
  echo '</div>';
endif;

echo '<div>';
while ( have_posts() ) : the_post();
  the_content();
endwhile;
wp_reset_postdata();
echo '</div>';

echo '<div>';
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
echo '</div>';

if ( $student_query->have_posts() ) :
  echo '<div>';
  echo '<h2>Players</h2>';
  while ( $student_query->have_posts() ) : $student_query->the_post(); 
    if( get_field('title') == "Department Head" )
      echo '<h3>'.get_field('title').' - '.get_the_title().'</h3>';
    else
      echo '<h3>'.get_the_title().'</h3>';
      echo '<br>';
      echo 'Number: ' . p2p_get_meta( get_post()->p2p_id, 'number', true );
      echo '<br>';
      echo 'Position: ' . p2p_get_meta( get_post()->p2p_id, 'position', true );
      $pictures = get_field('sport_pictures');
      $output = false;
      if( $pictures ) :
        foreach( $pictures as $row ) :
          if( $term->term_id === $row['sport']->term_id ) :
            $image = $row['image'];
            echo "<img src='$image' alt='' />";
            $output = true;
          endif;
        endforeach;
      endif;
      if( !$output )
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
<?php get_footer(); ?>