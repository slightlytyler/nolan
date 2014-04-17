<?php
  get_header();
  get_template_part('slider', 'index');
  get_template_part('nav');
?>
  <div class='container'>
    <div class='info_title'>
      <h3>in the marianist tradition since 1961</h3>
    </div>
    <div class='info_section'>
      <?php get_sidebar("homepage-top")?>
      <div class='clear'></div>
    </div>
    <?php 
      get_sidebar('homepage-right');
      get_sidebar('homepage-middle');
    ?>
  </div>
  <div class='container'>
    <?php get_sidebar('homepage-bottom'); ?>
  </div>
  <?php get_footer(); ?>
</body>