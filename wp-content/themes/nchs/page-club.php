<?php
/* Template Name: Club */
get_header();
  echo "<div class='page-content col-sm-7 col-md-8'>";
  while ( have_posts() ) : the_post();
    echo '<h1>'.get_the_title().'</h1>';
    the_content();
    echo '<hr>';
  endwhile;
  $connected = new WP_Query( array(
    'connected_type' => 'student_to_pages',
    'connected_items' => get_queried_object(),
    'nopaging' => true,
  ) );
if ( $connected->have_posts() ) :
?>
  <h2>Students</h2>
<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
  <div class="card">
    <h3><?php the_title() ?></h3>
    <div class='col-sm-4 nopad'>
      <?php the_post_thumbnail(); ?>
    </div>
    <div class='col-sm-8 nopad'>
      <p>Field 1: <?php echo p2p_get_meta( get_post()->p2p_id, 'number', true ) ?></p>
      <p>Field 2: <?php echo p2p_get_meta( get_post()->p2p_id, 'position', true ) ?></p>
      <p><strong><?php echo date('Y') - get_field('since'); ?> Class</strong></p>
    </div>
    <div class='clearfix'></div>
  </div>
<?php
    endwhile;
  wp_reset_postdata();
  endif;
?>
  </div>
<?php
get_sidebar("page");
get_footer();
?>