<?php
/* Template Name: Sport */
get_header();
echo "<div class='page-content col-sm-8 nopad'>"; 
  get_template_part( 'section', 'news' );
  get_template_part( 'section', 'schedule' );
  echo "<div class='col-sm-12'>";
    while ( have_posts() ) : the_post();
      the_title( '<h1>', '</h1>' );
      the_content();
    endwhile;
    wp_reset_postdata();
  echo '</div>';
  nchs_people_with_sport_thumbs_list( 'Coaches', 'coach_to_pages', 'nchs_coach_loop', 'coach-picture col-xs-6 col-sm-4 col-md-3 col-lg-4' );
  // get_template_part( 'section', 'coaches' );
  nchs_people_with_sport_thumbs_list( 'Players', 'student_to_pages', 'nchs_player_loop' );
  // get_template_part( 'section', 'players' );
echo '</div>';
?>
<div class="right col-sm-4 banner nopad">
  <h3>NCHS Athletics</h3>
  <div class="banner-inner">
    <ul class="widgets">
      <?php if ( !dynamic_sidebar( 'sport-sidebar' ) ) {} ?>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="banner-footer">
    NHCS Crest Here
  </div>
  <div class="banner-left"></div><div class="banner-right"></div>
</div>
<?php get_footer(); ?>