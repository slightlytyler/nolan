<?php get_header(); ?>
<div class='info_title'>
  <h3 class="outer-container"><img src='<?php echo get_stylesheet_directory_uri(); ?>/img/marianist-logo.gif' alt='Marianist Logo'><?php the_field('tagline','options') ?></h3>
</div>
<div class="col-sm-12 home-top-wrap clearfix">
  <div class="col-sm-7 col-md-5 col-sm-push-5 col-md-push-7 video nopad video-border">
    <?php echo nhcs_video( get_field('homepage_video', 'option') ); ?>
  </div>
  <div class="col-sm-5 col-md-7 col-sm-pull-7 col-md-pull-5 latest nopad">
    <h2>Latest</h2>
    <ul>
      <?php 
      while ( have_posts() ) : the_post();
        echo '<li>';
        $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 720,405 ), false, '' );
        echo '<div class="thumb" style="background-image: url('.$src[0].');"></div>';
        echo '<div class="info">';
        the_title('<a href="'.get_permalink().'"><h3>','</h3></a>');
        echo '<h4>'.get_the_date().'</h4>';
        echo '</div>';
        //echo ' | ';
        //the_author();
        // the_excerpt();
        echo '</li>';
      endwhile;
      // next_posts_link();
      // echo '<a href="/news">More News &raquo;</a>'
      ?>
    </ul>
  </div>
</div>
<div class="clearfix"></div>
<div class="col-sm-12 nopad home-stripe clearfix">
  <div class="outer-container">
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
</div>
<div class="clearfix"></div>
<div class="outer-container">
  <div class="promos col-sm-6 col-md-12 nopad">
    <div class="promo-card">
      <img src="http://slightly.dev:8888/wp-content/uploads/2014/06/promo.png" />
      <div class="promo-info">
        <h3 class="title">Class of 2017 - Get Your Blue On!</h3>
        <p>Lorum ipsum sit amet, sed do eiusmod tempur incididunt ut labore<a href="#">Click Here</a></p>
      </div>
    </div>
    <div class="promo-card">
      <img src="http://slightly.dev:8888/wp-content/uploads/2014/06/promo.png" />
      <div class="promo-info">
        <h3 class="title">Become a partner for progress</h3>
        <p>Lorum ipsum sit amet, sed do eiusmod tempur incididunt ut labore</p>
        <span class="btn-container">
          <a class="btn btn-info" href="#">Donate Now</a>
        </span>
      </div>
    </div>
    <?#php if ( !dynamic_sidebar( 'homepage-bottom' ) ) {} ?>
  </div>
</div>
<?php get_footer(); ?>