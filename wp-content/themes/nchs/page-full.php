<?php
/* Template Name: No Sidebar */
get_header();
?>
  <div class='page-content col-sm-12'>
    <?php
      while ( have_posts() ) : the_post();
        the_content();
      endwhile;
    ?>
  </div>
<?php get_footer(); ?>