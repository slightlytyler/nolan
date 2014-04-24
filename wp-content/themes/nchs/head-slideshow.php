<?php
// $slides_number = get_option( 'nchs_slides_number_setting', 5 );
$loop = new WP_Query( [
  'post_type' => 'slide',
  // 'posts_per_page' => $slides_number
] );
if ($loop->have_posts()): 
?>
<div class='slider_section'>
  <div class='flexslider'>
    <ul class='slides'>
<?php
  while ( $loop->have_posts() ) : $loop->the_post();
    the_title();
?>
  <li style="background-image: url('<?php the_field( $image_url ); ?>')">
    <div class='slide_wrapper'>
      <div class='slide1_title'>
          <?php //echo types_render_field( "slide-text", array()); ?>
      </div>
      <div class='slide_img'>
          <?php // echo types_render_field( "slide-foreground-image", array( "height" => "332", "proportional" => "true" )); ?>
      </div>
    </div>
  </li>
<?php
  endwhile;
?>
    </ul>
  </div>
</div>
<?php endif; ?>
