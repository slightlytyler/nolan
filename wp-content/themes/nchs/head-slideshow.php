<?php
// $slides_number = get_option( 'nchs_slides_number_setting', 5 );
$loop = new WP_Query( [
  'post_type' => 'slide',
  'orderby' => 'menu_order',
  // 'posts_per_page' => $slides_number
] );
if ($loop->have_posts()): 
?>
<div class='slider_section'>
  <div class='flexslider'>
    <ul class='slides'>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
  <li style="background-image: url('<?php echo get_field('background')['sizes']['nchs-slide-background'] ?>')">
    <div class='slide_wrapper'>
      <div class='slide1_title'>
          <?php the_title('<h3>','</h3>'); the_field('text'); ?>
      </div>
      <div class='slide_img'>
          <img src="<?php echo get_field('foreground')['sizes']['nchs-slide-foreground'] ?>" />
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
