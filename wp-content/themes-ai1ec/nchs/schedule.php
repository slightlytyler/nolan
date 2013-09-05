<?php if( ! $dates ): ?>
	<p class="ai1ec-no-results">
		<?php _e( 'There are no upcoming games to display at this time.', AI1EC_PLUGIN_NAME ) ?>
	</p>
<?php else: ?>
	<table>
		<tr>
	    <th>DATE</th>
	    <th>TIME</th>
	    <th>OPPONENT</th>
	    <th>LOCATION</th>
	    <th>LEVEL</th>
	    <th>RESULTS</th>
	  </tr>
	<?php foreach( $dates as $timestamp => $date_info ): ?>
		<?php foreach( $date_info['events'] as $category ): ?>
			<?php foreach( $category as $event ): ?>
				<tr>
					<td><?php echo Ai1ec_Time_Utility::date_i18n( 'm.d.y', $timestamp, true ) ?></td>
					<td><?php echo Ai1ec_Time_Utility::date_i18n( 'g:iA', $event->start, true ) ?></td>
					<td><?php echo $event->nchs_opponent ?></td>
					<td><?php echo $event->venue ?></td>
					<td><?php echo $event->nchs_level ?></td>
					<td><?php echo $event->nchs_results != '' ? $event->nchs_results : 'Coming Soon' ?></td>
				</tr>
			<?php endforeach ?>
		<?php endforeach ?>
	<?php endforeach ?>
	</table>
<?php endif ?>