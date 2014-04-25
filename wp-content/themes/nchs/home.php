<?php get_header(); ?>
<div class='info_title'>
  <h3><img src='<?php echo get_stylesheet_directory_uri(); ?>/img/marianist-logo.gif' alt='Marianist Logo'><?php the_field('tagline','options') ?></h3>
</div>
<div class="col-sm-12 home-top-wrap">
  <div class="col-sm-7 col-md-8 col-sm-push-5 col-md-push-4 video nopad">
    <?php echo nhcs_video( get_field('homepage_video', 'option') ); ?>
  </div>
  <div class="col-sm-5 col-md-4 col-sm-pull-7 col-md-pull-8 latest nopad">
    <h2>Latest</h2>
  <?php 
  while ( have_posts() ) : the_post();
    the_title('<a href="'.get_permalink().'"><h3>','</h3></a>');
    the_date();
    echo ' | ';
    the_author();
    // the_excerpt();
  endwhile;
  // next_posts_link();
  // echo '<a href="/news">More News &raquo;</a>'
  ?>
  </div>
</div>
<div class="clearfix"></div>
<div class="col-sm-12 nopad home-stripe">
  <div class="col-sm-6 col-md-8 mission">
    <h2>The Nolan Catholic Mission</h2>
    <p><?php the_field('mission','options') ?></p>
    <?php the_field('mission_link_icon','options') ?>
    <p><a href="<?php the_field('mission_link','options') ?>" class="btn btn-info"><?php the_field('mission_link_text','options') ?></a></p>
  </div>
  <div class="col-sm-6 col-md-4 banner">
    <h3>Calendar</h3>
    <div class="banner-inner">
      <ul class="widgets">
        <?php if ( !dynamic_sidebar( 'homepage-ribbion' ) ) {} ?>
      </ul>
      <div class="clearfix"></div>
    </div>
    <a href="#calenderLink" class="calendar-link">View Full Calendar</a>
    <div class="crest"></div>
    <div class="banner-left"></div><div class="banner-right"></div>
  </div>
</div>
<div class="clearfix"></div>
<div class="col-sm-6 col-md-8 nopad">
  <?php if ( !dynamic_sidebar( 'homepage-bottom' ) ) {} ?>
</div>
<?php get_footer(); ?>