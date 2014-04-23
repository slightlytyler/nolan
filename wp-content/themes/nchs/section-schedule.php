<?php
$term = get_term( get_field('news_category'), 'sport' );
$events = eo_get_events(array(
  'numberposts' => 15,
  'showpastevents' => true,
  'sport' => $term->slug,
));
if($events):
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
    foreach ($events as $event):
      echo "<tr>";
        echo "<td>" . eo_get_the_start('F j', $event->ID,null,$event->occurrence_id) . "</td>";
        echo "<td>" . eo_get_the_start('g:i a', $event->ID,null,$event->occurrence_id) . "</td>";
        echo sprintf( "<td><a href='%s'>%s</a></td>", get_the_permalink($event->ID), get_the_title($event->ID) );
        echo sprintf( "<td><a href='%s'>%s</a></td>", eo_get_venue_link(eo_get_venue($event->ID)), eo_get_venue_name(eo_get_venue($event->ID)) );
        echo "<td>" . get_field('level', $event->ID) . "</td>";
        echo "<td>" . get_field('results', $event->ID) . "</td>";
      echo "</tr>";
    endforeach;
    echo '</tbody></table>';
  echo '<div class="clearfix"></div></div>';
endif;
?>