<?php

get_header(); ?>



    <div class='page interior'>
      <?php while ( have_posts() ) : the_post(); ?>
      <div class='blog_section'>
        <div class='blog_wrapper'>
          <?php the_content() ?>
        </div>
      </div>
      <?php endwhile; ?>

      
	<?php get_sidebar("page")?>
 <div class='clear'></div>
     </div>

<?php get_footer(); ?>