<?php get_header(); ?>
  <div class='page-content col-sm-7 col-md-8'>
    <?php
      while ( have_posts() ) : the_post();
        the_content();
      endwhile;
    ?>
  </div>
<?php
get_sidebar("page");
get_footer();
?>