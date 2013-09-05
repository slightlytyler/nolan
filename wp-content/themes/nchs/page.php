<?php

get_header(); ?>

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
        <?php if($post->post_parent==0) : ?>
		<h3><?php the_title() ?></h3>
        <?php echo types_render_field("header-subtext",array('raw'=>true)) ?>
		<?php else : ?>
			<h3 class="subpage_title"><?php echo get_the_title($parents[count($parents)-1])?></h3>
			<span class="subpage_small_title"><?php the_title(); ?></span>
		<?php endif;?>
      </div>
      <div class='slide_img'>
        <?php $slide_img = types_render_field( "section-foreground-image", array( "alt" => "Lorem", "width" => "191", "height" => "254", "proportional" => "true" )); ?>
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

    <div class='page interior'>
      <?php while ( have_posts() ) : the_post(); ?>
      <div class='blog_section'>
        <div class='blog_wrapper'>
          <?php the_content() ?>
        </div>
      </div>
      <?php endwhile; ?>

      
	<?php get_sidebar("page")?>
 <div class='clear'></div>
     </div>

<?php get_footer(); ?>