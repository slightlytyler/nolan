<div class='slider_section'>
	<?php $image_url = types_render_field( "section-background-image", array('raw' => true)) ?>
	<?php if($image_url !== ''): ?>
		<div class='slides' style="background-image: url('<?php echo $image_url; ?>')">
		<?php else: ?>
			<div class='slides'>
			<?php endif; ?>
			<div class='slide_wrapper'>
				<div class='slide1_title'>
					<?php $parents = get_post_ancestors( $post->ID );?>
					<?php $section_title = get_the_title($parents[count($parents)-1])?>
					<?php $subsection_title = get_the_title($parents[count($parents)-2])?>
					<?php if ($section_title=="Athletics" && count($parents)>1) $section_title = $subsection_title; ?>
				
					<?php if($post->post_parent==0 || ($section_title=="Athletics")) : ?>
						<h3><?php the_title() ?></h3>
						<?php echo types_render_field("header-subtext",array('raw'=>true)) ?>
					<?php else : ?>
						<h3 class="subpage_title"><?php echo $section_title?></h3>
						<span class="subpage_small_title"><?php the_title(); ?></span>
					<?php endif;?>
				
				</div>
				<div class='slide_img'>
					<?php $slide_img = types_render_field( "section-foreground-image", array( "alt" => "Lorem", "height" => "254", "proportional" => "true" )); ?>
					<?php if ($slide_img !== ''): ?>
						<?php echo $slide_img; ?>
					<?php else: ?>
						<img src="<?php echo get_template_directory_uri(); ?>/img/slide_1_girl.png" />
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>