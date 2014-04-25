<?php get_header(); ?>
  <div class='info_title'>
    <h3>This is the search engine results page!</h3>
  </div>
<?php
echo "<div class='page-content col-sm-7 col-md-8'>";
  echo '<h1>Search Results</h1>';
  echo nchs_search_form();
  get_template_part('loop-archive');
echo "</div>";
nchs_sidebar();
get_footer();
?>