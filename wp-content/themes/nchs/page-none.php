<?php
/* Template Name: No Frame */
get_header();
while ( have_posts() ) : the_post();
the_title( '<h1 style="margin-left: 15px">', '</h1>' );
the_content();
endwhile;
get_footer();
?>