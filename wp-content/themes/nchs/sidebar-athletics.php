<?php $parents = get_post_ancestors( $post->ID );?>
<?php $section_title = get_the_title($parents[count($parents)-1])?>
<?php $subsection_title = get_the_title($parents[count($parents)-2])?>
<?php if ($section_title=="Athletics" && count($parents)>1) $section_title = $subsection_title; ?>
<?php if($post->post_parent==0 || ($section_title=="Athletics")) $section_title = get_the_title() ?>
<div class='calendar_box'>
	
		<div class='calendar_head'>
			
			<h4><?php echo $section_title;?></h4></div>
	<div class='calendar_body'>
		<?php
	if ( !dynamic_sidebar( 'athletics-right-widget-area' ) ) {}
		?>
		<div class='hchs_watermark_icon'></div>
	</div>
	<div class='calendar_footer'></div>

</div>
<div class='clear'></div>