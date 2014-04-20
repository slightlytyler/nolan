<?php
/* Template Name: Department */
get_header();
  echo "<div class='page-content col-sm-8'>";
  while ( have_posts() ) : the_post();
    echo '<h1>'.get_the_title().'</h1>';
    the_content();
    echo '<hr>';
  endwhile;
  $connected = new WP_Query( array(
    'connected_type' => 'faculty_to_pages',
    'connected_items' => get_queried_object(),
    'nopaging' => true,
  ) );
  if ( $connected->have_posts() ) :
    
    echo '<h2>Faculty</h2>';
    while ( $connected->have_posts() ) : $connected->the_post(); 
      echo '<div class="card">';
      if( get_field('title') == "Department Head" ) {
        echo '<h3>'.get_field('title').' - '.get_the_title().'</h3>';
      }
      else {
        echo '<h3>'.get_the_title().'</h3>';
      }
?>
    <div class='col-sm-4 nopad'>
      <?php the_post_thumbnail(); ?>
    </div>
    <div class='col-sm-8 nopad'>
      <p><strong>Teaches:</strong> <?php the_field('teaches'); ?></p>
      <p><strong>Education:</strong> <?php the_field('education'); ?></p>
      <p><strong><?php echo date('Y') - get_field('since'); ?> Years of service</strong></p>
    </div>
    <div class='clearfix'></div>
  </div>
<?php
    endwhile;
  wp_reset_postdata();
  endif;
?>
  </div>
  <div class='col-sm-4 right_sidebar'>
    <?php get_sidebar("page"); ?>
  </div>
<?php get_footer(); ?>