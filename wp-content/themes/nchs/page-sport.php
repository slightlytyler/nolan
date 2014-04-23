<?php
/* Template Name: Sport */
$meta_title_1 = get_field('meta_title_1');
$meta_title_2 = get_field('meta_title_2');
$meta_title_3 = get_field('meta_title_3');
$meta_title_4 = get_field('meta_title_4');
get_header();
$term = get_term( get_field('news_category'), 'sport' );
$news_query = new WP_Query( [ 
  'post_type' => 'athletics',
  'posts_per_page' => '3',
  'sport' => $term->slug
] );
$event_query = new WP_Query( [ 
  'post_type' => 'event',
  'posts_per_page' => '10',
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

echo "<div class='page-content col-sm-8 nopad'>"; 

  if( $news_query->have_posts() ) :
    echo "<div class='col-sm-12 nopad'>";
        echo "<div class='col-sm-12'>";
          echo "<h2>$term->name News</h2>";
        echo "</div>";
        echo "<div class='sport-news'>";
      while ( $news_query->have_posts() ) : $news_query->the_post();
        if( $news_query->current_post === 0 ) :
          echo "<div class='col-md-12'>";
            echo get_the_post_thumbnail( $post->ID, 'nchs-admin' );
            echo sprintf( "<h4><a href='%s'>%s</a></h4><p>%s</p>", get_permalink(), get_the_title(), get_the_date() );
          echo "</div>";
        else :
          echo "<div class='col-md-6'>";
            echo get_the_post_thumbnail( $post->ID, 'nchs-admin' );
            echo sprintf( "<h4><a href='%s'>%s</a></h4><p>%s</p>", get_permalink(), get_the_title(), get_the_date() );
          echo "</div>";
        endif;
      endwhile;
        echo "<div class='clearfix'></div>";
      echo "</div>";
      wp_reset_postdata();
    echo "</div>";
  endif;

  if ( $event_query->have_posts() ) :
    echo "<div class='col-sm-12'>";
      echo '<h1>Schedule</h1>';
      echo '<table class="table table-striped"><tbody>
      <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Event</th>
        <th>Location</th>
        <th>Level</th>
        <th>Results</th>
      </tr>';
      while ( $event_query->have_posts() ) : $event_query->the_post();
      echo "<tr>";
        // echo "<td>" . eo_get_schedule_start('j F Y') . "</td>";
        echo "<td>" . eo_get_the_start('F j') . "</td>";
        echo "<td>" . eo_get_the_start('g:i a') . "</td>";
        echo sprintf( "<td><a href='%s'>%s</a></td>", get_the_permalink(), get_the_title() );
        echo sprintf( "<td><a href='%s'>%s</a></td>", eo_get_venue_link(), eo_get_venue_name() );
        echo "<td>" . get_field('level') . "</td>";
        echo "<td>" . get_field('results') . "</td>";
      echo "</tr>";
      endwhile;
      echo '</tbody></table>';
      wp_reset_postdata();
    echo '<div class="clearfix"></div></div>';
  endif;

  echo "<div class='col-sm-12'>";
    while ( have_posts() ) : the_post();
      the_title( '<h1>', '</h1>' );
      the_content();
    endwhile;
    wp_reset_postdata();
  echo '</div>';

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
</div>
<div class="right col-sm-4 banner nopad">
  <h3>NCHS Athletics</h3>
  <div class="banner-inner">
    <ul class="widgets">
      <?php if ( !dynamic_sidebar( 'sport-sidebar' ) ) {} ?>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="banner-left"></div><div class="banner-right"></div>
</div>
<?php get_footer(); ?>