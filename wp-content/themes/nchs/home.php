<?php
get_header();
?>
<div class='info_title'>
  <h3>In the Marianist tradition since 1961</h3>
</div>
<div class="col-sm-6">
  <h2>Latest News</h2>
<?php 
while ( have_posts() ) : the_post();
  the_title('<a href="'.get_permalink().'"><h3>','</h3></a>');
  the_date();
  the_author();
  the_excerpt();
endwhile;
?>
</div>
<div class="col-sm-6">
  <h2>Video Here</h2>
</div>
<div class="clearfix"></div>
<div class="col-sm-12 nopad home-stripe">
  <div class="col-sm-8 mission">
    <h2>NHCS Mission</h2>
    <p>Yeah, yeah what are you wearing, Dave. I can't play. Pretty Mediocre photographic fakery, they cut off your brother's hair. I know what you're gonna say, son, and you're right, you're right, But Biff just happens to be my supervisor, and I'm afraid I'm not very good at confrontations. Hey man, the dance is over. Unless you know someone else who could play the guitar.</p>
    <p><button class="btn btn-info">Read More</button></p>
  </div>
  <div class="col-sm-4 banner">
    <div class="banner-inner">
      <h3>Banner</h3>
      <p>Some Content</p>
      <p>Some Content</p>
      <p>Some Content</p>
      <p>Some Content</p>
      <h3>Banner</h3>
      <p>Some Content</p>
      <p>Some Content</p>
      <p>Some Content</p>
      <p>Some Content</p>
      <h3>Banner</h3>
      <p>Some Content</p>
      <p>Some Content</p>
      <p>Some Content</p>
      <p>Some Content</p>
      <div class="clearfix"></div>
    </div>
    <div class="banner-left"></div><div class="banner-right"></div>
  </div>
</div>
<div class="clearfix"></div>
<?php
// get_sidebar("homepage-top");
// get_sidebar('homepage-right');
// get_sidebar('homepage-middle');
get_sidebar('homepage-bottom');
get_footer();
?>