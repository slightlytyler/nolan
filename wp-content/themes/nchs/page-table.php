<?php
// Template Name: Table
get_header(); ?>
  <div class='col-sm-8'>
    <?php
      while ( have_posts() ) : the_post();
        if( get_field('table_title') )
          echo '<h3>'.get_field('table_title').'</h3>';
        the_content();
      endwhile;
    ?>
  </div>
  <div class='col-sm-4 right_sidebar'>
    <?php get_sidebar("page"); ?>
  </div>
  <script type='text/javascript'> var spreadsheet_id = '<?php echo get_field('spreadsheet_id'); ?>';</script>
<?php get_footer(); ?>