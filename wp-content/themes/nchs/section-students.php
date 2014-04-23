<?php 
$meta_title_1 = get_field('meta_title_1');
$meta_title_2 = get_field('meta_title_2');
$meta_title_3 = get_field('meta_title_3');
$meta_title_4 = get_field('meta_title_4');
$connected = new WP_Query( array(
  'connected_type' => 'student_to_pages',
  'connected_items' => get_queried_object(),
  'nopaging' => true,
) );
if ( $connected->have_posts() ) :
  echo "<h2>Students</h2>";
  while ( $connected->have_posts() ) : $connected->the_post();
?>
  <div class="card">
    <h3><?php the_title() ?></h3>
    <div class='col-sm-4 nopad'>
      <?php the_post_thumbnail(); ?>
    </div>
    <div class='col-sm-8 nopad'>
<?php 
    if( $meta_title_1 != '' )
      echo '<p>' . $meta_title_1 . ': ' . p2p_get_meta( get_post()->p2p_id, 'field_1', true ) . '</p>';
    if( $meta_title_2 != '' )
      echo '<p>' . $meta_title_2 . ': ' . p2p_get_meta( get_post()->p2p_id, 'field_2', true ) . '</p>';
    if( $meta_title_3 != '' )
      echo '<p>' . $meta_title_3 . ': ' . p2p_get_meta( get_post()->p2p_id, 'field_3', true ) . '</p>';
    if( $meta_title_4 != '' )
      echo '<p>' . $meta_title_4 . ': ' . p2p_get_meta( get_post()->p2p_id, 'field_4', true ) . '</p>';
?>
      <p><strong>Class of <?php echo date('Y') - get_field('since'); ?></strong></p>
    </div>
    <div class='clearfix'></div>
  </div>
<?php
  endwhile;
wp_reset_postdata();
endif;
?>