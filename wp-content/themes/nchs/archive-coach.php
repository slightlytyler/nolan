<?php
get_header(); ?>

<?php global $_title; $_title = get_the_title(); ?>

<?php
global $post;
$slug = get_post( $post )->post_name;
?>
    <div class='main_section'>
      <div class='page'>
        <div class='blog_wrapper'>
          <?php
          $args = array( 'post_type' => 'coach', 'posts_per_page' => -1, 'sport' => get_query_var( 'sport' ), 'orderby' => 'menu_order', 'order' => 'ASC' );
          $loop = new WP_Query( $args );
          ?>

          <?php if ($loop->have_posts()): ?>
            <?php
            while ( $loop->have_posts() ) :
              $loop->the_post();
            ?>
            <div class="archive-info" id="<?php the_ID(); ?>">
              <h2 class="archive-name"><?php the_title() ?></h2>
              <h3 class="archive-position"><?php echo types_render_field( "coach-position", array('raw'=>true)) ?></h3>
              <div class="archive-bio">
                <?php $img = types_render_field( "coach-picture", array("raw" => true)) ?>
                <p><img class="archive-img" src="<?php echo $img; ?>"><?php echo types_render_field( "coach-bio", array('raw'=>true)) ?></p>
              </div>
            </div>
            <br class="clear">
            <?php endwhile; ?>
          <?php endif; ?>
          <?php wp_reset_query(); ?>

        </div>
        <div class='clear'></div>
      </div>

      <div class='right_sidebar'>
        <?php get_sidebar("athletics")?>
      </div>
      <div class='clear'></div>
    </div>
<?php get_footer() ?>