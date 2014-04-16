<?php

get_header(); ?>

<?php get_template_part('slider', 'index'); ?>
<?php get_template_part('nav'); ?>

    <div class='page_section'>
      <div class='info_title'>
        <h3>in the marianist tradition since 1961</h3>
      </div>
      <div class='info_section'>
        <?php get_sidebar("homepage-top")?>
        <div class='clear'></div>
      </div>
    </div>

    <?php get_sidebar('homepage-right'); ?>
    <?php get_sidebar('homepage-middle'); ?>

    <div class='container'>
      <?php get_sidebar('homepage-bottom'); ?>
    </div>

<!--     <div class='page_section'>
      <div class='promo_section'>
        
        <div class='clear'></div>
      </div>
    </div> -->


<?php get_footer(); ?>

</body>