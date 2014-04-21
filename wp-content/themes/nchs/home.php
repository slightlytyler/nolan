<?php
get_header();
?>
<div class='info_title'>
  <h3>In the Marianist tradition since 1961</h3>
</div>

<div class="col-sm-12 home-top-wrap">
<div class="col-sm-5 col-md-4 latest">
  <h2>Latest</h2>
<?php 
while ( have_posts() ) : the_post();
  the_title('<a href="'.get_permalink().'"><h3>','</h3></a>');
  the_date();
  echo ' | ';
  the_author();
  // the_excerpt();
endwhile;
next_posts_link();
// echo '<a href="/news">More News &raquo;</a>'
?>
</div>
<div class="col-sm-7 col-md-8 video">
  <h2>Video Here</h2>
</div>
</div>
<div class="clearfix"></div>
<div class="col-sm-12 nopad home-stripe">
  <div class="col-sm-6 col-md-8 mission">
    <h2>NHCS Mission</h2>
    <p>Yeah, yeah what are you wearing, Dave. I can't play. Pretty Mediocre photographic fakery, they cut off your brother's hair. I know what you're gonna say, son, and you're right, you're right, But Biff just happens to be my supervisor, and I'm afraid I'm not very good at confrontations. Hey man, the dance is over. Unless you know someone else who could play the guitar.</p>
    <p><button class="btn btn-info">Read More</button></p>
  </div>
  <div class="col-sm-6 col-md-4 banner">
    <h3>Events</h3>
    <div class="banner-inner">
      <ul class="widgets">
        <?php if ( !dynamic_sidebar( 'homepage-ribbion' ) ) {} ?>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="banner-left"></div><div class="banner-right"></div>
  </div>
</div>
<div class="clearfix"></div>
<div class="col-sm-6 col-md-8">
<?php
// get_sidebar("homepage-top");
// get_sidebar('homepage-right');
// get_sidebar('homepage-middle');
get_sidebar('homepage-bottom');
?>
</div>
<?php get_footer(); ?>
