<?php
// Template Name: Table
get_header(); ?>
  <div class='page-content col-sm-7 col-md-8 spreadsheet'>
    <?php
      while ( have_posts() ) : the_post();
        if( get_field('table_title') )
          echo '<h1>'.get_field('table_title').'</h1>';
        the_content();
      endwhile;
    ?>
  </div>
  <?php nchs_sidebar("page"); ?>
  <script type='text/javascript'> var spreadsheet_id = '<?php echo get_field("spreadsheet_id"); ?>';</script>
<?php get_footer(); ?>