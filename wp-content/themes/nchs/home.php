<?php
get_header();
?>
<div class='info_title'>
  <h3>In the Marianist tradition since 1961</h3>
</div>
<div class="col-md-6">
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
<div class="col-md-6">
  <h2>Video Here</h2>
</div>
<div class="col-md-6 banner">
  <div class="banner-inner">
    <h3>Banner</h3>
    <p>Some Content</p>
    <div class="clearfix"></div>
  </div>
  <div class="banner-left"></div><div class="banner-right"></div>
</div>
<div class="clearfix"></div>
<?php
// get_sidebar("homepage-top");
get_sidebar('homepage-right');
get_sidebar('homepage-middle');
get_sidebar('homepage-bottom');
get_footer();
?>