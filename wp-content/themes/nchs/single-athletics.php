<?php
/* Template Name: Single Athletics */
get_header(); ?>

<div class='page'>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class='blog_section'>
			<div class='blog_wrapper'>
				<h3><?php echo the_title() . " - " . types_render_field("coach-position",array('raw'=>true)); ?></h3>
				<?php echo types_render_field("coach-bio",array('raw'=>true)); ?>
			</div>
		</div>
	<?php endwhile; ?>

	<div class='right_sidebar single_athletics'>
		<?php get_sidebar("athletics")?>
	</div>
	<div class="clear"></div>
</div>

<?php get_footer(); ?>