<?php echo $navigation; ?>
<div class="ai1ec-agenda-view">
	<?php if( ! $dates ): ?>
		<p class="ai1ec-no-results">
			<?php _e( 'There are no upcoming events to display at this time.', AI1EC_PLUGIN_NAME ) ?>
		</p>
	<?php else: ?>
		<?php foreach( $dates as $timestamp => $date_info ): ?>
			<div class="media">
				<a class="pull-left" href="<?php //echo $date_info['href']; ?>" <?php echo $data_type; ?>>
					<div class="date_bg">
						<div class="month"><?php echo Ai1ec_Time_Utility::date_i18n( 'M', $timestamp, true ) ?></div>
						<div class="day"><?php echo Ai1ec_Time_Utility::date_i18n( 'j', $timestamp, true ) ?></div>
						<!--<div class="ai1ec-weekday"><?php echo Ai1ec_Time_Utility::date_i18n( 'D', $timestamp, true ) ?></div>-->
						<?php if ( $show_year_in_agenda_dates ) : ?>
							<div class="ai1ec-year"><?php echo Ai1ec_Time_Utility::date_i18n( 'Y', $timestamp, true ) ?></div>
						<?php endif; ?>
					</div>
				</a>
				<div class="media-body">
					<?php foreach( $date_info['events'] as $category ): ?>
						<?php foreach( $category as $event ): ?>
							<h4 class="media-heading">
								<?php echo esc_html( apply_filters( 'the_title', $event->post->post_title, $event->post_id ) ) ?>
							</h4><!--/.ai1ec-event-title-->
							<span class="ai1ec-event-location"><?php echo sprintf( __( '%s', AI1EC_PLUGIN_NAME ), $event->venue ); ?></span>
						<?php endforeach ?>
					<?php endforeach ?>
				</div><!--/.ai1ec-date-events-->
			</div><!--/.ai1ec-date-->
		<?php endforeach ?>
	<?php endif ?>
</div><!--/.ai1ec-agenda-view-->
<div class="pull-right"><?php echo $pagination_links; ?></div>
