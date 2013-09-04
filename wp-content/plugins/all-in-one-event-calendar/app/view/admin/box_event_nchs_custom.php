<div class="accordion-heading">
	<a class="accordion-toggle" data-toggle="ai1ec_collapse"
		data-parent="#ai1ec-add-new-event-accordion"
		href="#ai1ec-event-nchs-custom-box">
		<i class="icon-asterisk"></i> <?php _e( 'Game Specific fields', AI1EC_PLUGIN_NAME ); ?>
	</a>
</div>
<div id="ai1ec-event-nchs-custom-box" class="accordion-body collapse">
	<div class="accordion-inner">
		<table class="ai1ec-form">
			<tbody>
				<tr>
					<td class="ai1ec-first">
						<label for="ai1ec_nchs_opponent">
							<?php _e( 'Opponent', AI1EC_PLUGIN_NAME ); ?>:
						</label>
					</td>
					<td>
						<input type="text" name="ai1ec_nchs_opponent" id="ai1ec_nchs_opponent" value="<?php echo $nchs_opponent; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="ai1ec_nchs_level">
							<?php _e( 'Level', AI1EC_PLUGIN_NAME ); ?>:
						</label>
					</td>
					<td>
						<input type="text" name="ai1ec_nchs_level" id="ai1ec_nchs_level" value="<?php echo $nchs_level; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="ai1ec_nchs_results">
							<?php _e( 'Results', AI1EC_PLUGIN_NAME ); ?>:
						</label>
					</td>
					<td>
						<input type="text" name="ai1ec_nchs_results" id="ai1ec_nchs_results" value="<?php echo $nchs_results; ?>" />
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
