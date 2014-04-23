<?php
$term = get_term( get_field('news_category'), 'sport' );
$news_query = new WP_Query( [ 
  'post_type' => 'athletics',
  'posts_per_page' => '3',
  'sport' => $term->slug
] );
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
?>