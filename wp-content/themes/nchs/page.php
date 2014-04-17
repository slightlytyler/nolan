<?php get_header(); ?>
  <div class='container'>
    <div class='col-sm-8'>
      <?php
        while ( have_posts() ) : the_post();
          the_content();
        endwhile;
      ?>
    </div>
    <div class='col-sm-4 right_sidebar'>
      <?php get_sidebar("page"); ?>
    </div>
  </div>
<?php get_footer(); ?>