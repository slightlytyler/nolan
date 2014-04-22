<?php
$slides_number = get_option( 'nchs_slides_number_setting', 5 );
$args = array( 'post_type' => 'slide', 'posts_per_page' => $slides_number, 'orderby' => 'menu_order', 'order' => 'ASC');
$loop = new WP_Query( $args );
?>
<?php if ($loop->have_posts()): ?>
<div class='slider_section'>
    <div class='flexslider'>
        <ul class='slides'>
            <?php
            while ( $loop->have_posts() ) :
              $loop->the_post();
            ?>
            <?php //$image_url = types_render_field( "slide-background-image", array('raw' => true)); ?>
            <?php if($image_url !== ''): ?>
                <li style="background-image: url('<?php echo $image_url; ?>')">
            <?php endif; ?>
                <div class='slide_wrapper'>
                    <div class='slide1_title'>
                        <?php //echo types_render_field( "slide-text", array()); ?>
                    </div>
                    <div class='slide_img'>
                        <?php // echo types_render_field( "slide-foreground-image", array( "height" => "332", "proportional" => "true" )); ?>
                    </div>
                </div>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>
<?php endif; ?>
