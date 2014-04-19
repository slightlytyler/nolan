<div class='slider_section'>
  <?php $image_url = types_render_field( "athletics-background-image", array('raw' => true)) ?>
  <?php if($image_url !== ''): ?>
  <div class='slider_athletic' style="background-image: url('<?php echo $image_url; ?>')">
  <?php else: ?>
  <div class='slider_athletic'>
  <?php endif; ?>
    <div class='slide_wrapper'>
      <div class='slide1_title'>        
        <?php if (is_archive() && in_array(get_query_var('post_type'), array('coach', 'player'))): ?>
          <h3><?php echo ucfirst(get_query_var('sport')) ." ". get_post_type_object(get_query_var('post_type'))->label; ?></h3>
        <?php else: ?>
          <h3><?php the_title() ?></h3>
        <?php endif; ?>
        <?php echo types_render_field("athletics-header-subtext", array("raw" => true)) ?>
      </div>
      <div class='slide_img'>
        <?php $slide_img = types_render_field( "athletics-foreground-image", array( "alt" => "Lorem", "width" => "191", "height" => "254", "proportional" => "true" )); ?>
        <?php if ($slide_img !== ''): ?>
          <?php echo $slide_img; ?>
        <?php else: ?>
          <img src="<?php echo get_template_directory_uri(); ?>/img/slide_viking.png" />
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
</div>

<div class="page_container">
  