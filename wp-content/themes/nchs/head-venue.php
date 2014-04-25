<div class='venue-map'>
  <?php $venue_id = get_queried_object_id(); ?>
  <div class="slide1_title">
<?php
    if( get_query_var('event-venue') )
      printf( __( '<h1>%s Events</h1>', 'eventorganiser' ), '<span>' .eo_get_venue_name($venue_id). '</span>' );
    else
      echo '<h1>' . get_field( 'events_title', 'options' ) . '</h1>';
?>
  </div>
<?php
  if( $venue_description = eo_get_venue_description( $venue_id ) )
    // echo '<div class="venue-archive-meta">'.$venue_description.'</div>';
  echo eo_get_venue_map( $venue_id, array('width'=>"100%") );
?>
  </div>
</div>