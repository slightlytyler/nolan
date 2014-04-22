<?php get_header(); ?>
  <div class='page-content col-sm-7 col-md-8'>
<?php
    while ( have_posts() ) : the_post();
      the_title( '<h1>', '</h1>' );
      the_meta();
      the_date();
      the_author();
      the_content();
      $pictures = get_field('sport_pictures',$post->ID);
      print_r($pictures);
      foreach( get_field('sport_pictures') as $row ) :
        // echo print_r($row);
        echo $row['sport']->term_id;
        echo $row['sport']->name;
        $image = $row['image'];
        echo "<img src='$image' alt='' />";
      endforeach;
    endwhile;
    wp_reset_query();
?>
  </div>
<?php
get_sidebar("page");
get_footer();
?>