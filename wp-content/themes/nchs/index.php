<?php get_header(); ?>
  <div class='info_title'>
    <h3>This is the index page!</h3>
  </div>
<?php
get_template_part('section', 'archive-loop');
nchs_sidebar();
get_footer();
?>