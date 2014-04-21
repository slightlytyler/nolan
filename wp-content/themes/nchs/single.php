<?php
get_header();
/*
$__['title']     = get_the_title();
$__['excerpt']   = get_the_excerpt();
$__['image_url'] = types_render_field( "post-background-image", array('raw' => true));
$__['slide_img'] = types_render_field( "post-foreground-image", array( "alt" => "Lorem", "width" => "191", "height" => "254", "proportional" => "true", 'raw' => true ));

$cat = get_the_category();
$args = array( 'name' => $cat[0]->slug, 'post_type' => 'page', 'posts_per_page' => 1 );
$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) :
  while ( $the_query->have_posts() ) : $the_query->the_post();
    $parent_image_url = types_render_field( "athletics-background-image", array('raw' => true));
    $parent_slide_img = types_render_field( "athletics-foreground-image", array( "alt" => "Lorem", "width" => "191", "height" => "254", "proportional" => "true" ));

    if($__['image_url'] !== '') {
      $image_url = $__['image_url'];
    } elseif ($parent_image_url !== '') {
      $image_url = $parent_image_url;
    } else {
      $image_url = '';
    }

    if($__['slide_img'] !== '') {
      $slide_img = $__['slide_img'];
    } elseif ($parent_slide_img !== '') {
      $slide_img = $parent_slide_img;
    } else {
      $slide_img = '';
    }
?>

    <div class='slider_section'>
      <?php if($image_url !== ''): ?>
      <div class='slides' style="background-image: url('<?php echo $image_url; ?>')">
      <?php else: ?>
      <div class='slides'>
      <?php endif; ?>
        <div class='slide_wrapper'>
          <div class='slide1_title'>
            <h3><?php echo $_title ?></h3>
            <?php echo $_excerpt ?>
          </div>
          <div class='slide_img'>
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
<?php
  endwhile;
  wp_reset_postdata();
endif;
*/
?>
  <div class='page-content col-sm-7 col-md-8'>
<?php
    while ( have_posts() ) : the_post();
      the_title( '<h1>', '</h1>' );
      the_date();
      the_author();
      the_content();
      //comments_template();
    endwhile;
    wp_reset_query();
?>
  </div>
<?php
get_sidebar("page");
get_footer();
?>