<?php get_header(); ?>
  <div class='page-content col-sm-7 col-md-8'>
    <?php
      while ( have_posts() ) : the_post();
        the_title( '<h1>', '</h1>' );
        the_content();
      endwhile;
    ?>
  </div>
<?php
nchs_sidebar("page");
get_footer();
?> 