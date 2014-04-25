<?php
/* Template Name: Smart Archive */
get_header();
echo "<div class='page-content col-sm-7 col-md-8'>";
  the_title( '<h1>','</h1>' );
  if ( function_exists( 'smart_archives' ) )
    smart_archives( [ 'format' => 'fancy', 'anchors' => 'false' ], [ 'post_type' => get_field('post_type') ] );
  else
    echo '<h1>Plugin Needed</h1>'; '<p>This Page template only works when the <strong>Smart Archives Reloaded</strong> Plugin is Installed and Activated</p>';
echo '</div>';
nchs_sidebar();
get_footer();
?>