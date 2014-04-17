<?php
  get_header();
  get_template_part('slider', 'index');
  get_template_part('nav');
?>
  <div class='info_title'>
    <h3>In the Marianist tradition since 1961</h3>
  </div>
  <div class='info_section'>
    <?php get_sidebar("homepage-top")?>
    <div class='clear'></div>
  </div>
  <?php 
    get_sidebar('homepage-right');
    get_sidebar('homepage-middle');
    get_sidebar('homepage-bottom');
    get_footer();
  ?>
</body>