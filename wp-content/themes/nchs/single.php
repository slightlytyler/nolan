<?php

get_header(); ?>

<div class='slider_section'>
  <?php $image_url = types_render_field( "post-background-image", array('raw' => true)) ?>
  <?php if($image_url !== ''): ?>
  <div class='slides' style="background-image: url('<?php echo $image_url; ?>')">
  <?php else: ?>
  <div class='slides'>
  <?php endif; ?>
    <div class='slide_wrapper'>
      <div class='slide1_title'>
        <h3><?php the_title() ?></h3>
        <?php the_excerpt() ?>
      </div>
      <div class='slide_img'>
        <?php $slide_img = types_render_field( "post-foreground-image", array( "alt" => "Lorem", "width" => "191", "height" => "254", "proportional" => "true" )); ?>
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

<?php get_template_part('nav'); ?>

		<div class='page'>
			<?php while ( have_posts() ) : the_post(); ?>
			<div class='blog_section'>
        <div class='blog_wrapper'>
        	<h3><?php the_title() ?></h3>
        	<?php the_content() ?>
        	<?php //comments_template(); ?>
        </div>
      </div>
      <?php endwhile; ?>

      <div class='right_sidebar'>
        <div class='calendar_box'>
          <div class='calendar_head'>
            <h4>CALENDAR</h4>
          </div>
          <div class='calendar_body'>
            <div class='calendar_content'>
              <?php echo do_shortcode('[ai1ec view="agenda"]'); ?>
            </div>
          </div>
          <div class='calendar_footer'>
            <a href='#'>VIEW FULL CALENDAR</a>
          </div>
        </div>
        <?php get_sidebar() ?>
        <div class='clear'></div>
      </div>
      <div class='clear'></div>
    </div>
<?php get_footer(); ?>