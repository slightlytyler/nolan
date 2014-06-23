<?php
/* Template Name: Sport */
get_header();
echo '<div class="outer-container">';
  echo "<div class='page-content col-sm-8 nopad'>"; 
    get_template_part( 'section', 'news' );
    get_template_part( 'section', 'schedule' );
    echo "<div class='col-sm-12'>";
      #get_template_part('loop');
      nchs_people_thumbs_list( 'Coaches', 'coach_to_pages', 'nchs_coach_loop', 'coach-picture col-xs-6 col-sm-4 col-md-3 col-lg-4' );
      #nchs_people_thumbs_list( 'Players', 'student_to_pages', 'nchs_player_loop', 'player-picture col-xs-4 col-sm-3 col-lg-2' );
    echo '</div>';
  echo '</div>';
?>
<div class="right col-sm-4 banner athletics-banner nopad">
  <h3>NCHS Athletics</h3>
  <div class="banner-inner">
    <ul class="widgets">
      <?php if ( !dynamic_sidebar( 'sport-sidebar' ) ) {} ?>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="banner-left"></div><div class="banner-right"></div>
</div>
</div>
<?php get_footer(); ?>