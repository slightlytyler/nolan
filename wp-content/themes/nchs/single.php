<?php get_header(); ?>

<?php
$__['title']     = get_the_title();
$__['excerpt']   = get_the_excerpt();
$__['image_url'] = types_render_field( "post-background-image", array('raw' => true));
$__['slide_img'] = types_render_field( "post-foreground-image", array( "alt" => "Lorem", "width" => "191", "height" => "254", "proportional" => "true", 'raw' => true ));

$cat = get_the_category();
$args = array( 'name' => $cat[0]->slug, 'post_type' => 'page', 'posts_per_page' => 1 );
$the_query = new WP_Query( $args );
?>

<?php if ( $the_query->have_posts() ) : ?>
  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

    <?php
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
  <?php endwhile; ?>

  <?php wp_reset_postdata(); ?>

<?php endif; ?>

<?php get_template_part('nav'); ?>
	<div class="page_container">
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
	<?php wp_reset_query()?>
        <?php get_sidebar("page") ?>
      <div class='clear'></div>
    </div>
</div>
<?php get_footer(); ?>