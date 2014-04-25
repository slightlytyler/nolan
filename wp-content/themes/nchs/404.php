<?php get_header(); ?>
  <div class='col-sm-12' style='min-height: 400px'>
    <h1>404!</h1>
    <p>That's an error... D:</p>
    <p><?php the_field('404_message','options'); ?></p>
  </div>
<?php get_footer(); ?>