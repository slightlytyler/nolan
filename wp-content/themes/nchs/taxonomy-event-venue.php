<?php get_header('venue'); ?>
<div class="col-sm-7 col-md-8" role="main">
<?php
  if ( have_posts() ) :
    // Pagination
    if ( $wp_query->max_num_pages > 1 ) : ?>
      <nav id="nav-above">
        <div class="nav-next events-nav-newer"><?php next_posts_link( __( 'Later events <span class="meta-nav">&rarr;</span>' , 'eventorganiser' ) ); ?></div>
        <div class="nav-previous events-nav-newer"><?php previous_posts_link( __( ' <span class="meta-nav">&larr;</span> Newer events', 'eventorganiser' ) ); ?></div>
      </nav><!-- #nav-above -->
  <?php endif; ?>

    <!-- This is the usual loop, familiar in WordPress templates-->
    <?php while ( have_posts()) : the_post(); ?>
  
      <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <div class="entry-header">

        <h1 class="entry-title" style="display: inline;">
        <a href="<?php the_permalink(); ?>">
          <?php 
            //If it has one, display the thumbnail
            if( has_post_thumbnail() )
              the_post_thumbnail('thumbnail', array('style'=>'float:left;margin-right:20px;'));
            //Display the title
            the_title()
          ;?>
        </a>
        </h1>
    
        <div class="event-entry-meta">

          <!-- Output the date of the occurrence-->
          <?php
          //Format date/time according to whether its an all day event.
          //Use microdata http://support.google.com/webmasters/bin/answer.py?hl=en&answer=176035
          if( eo_is_all_day() ){
            $format = 'd F Y';
            $microformat = 'Y-m-d';
          }else{
            $format = 'd F Y '.get_option('time_format');
            $microformat = 'c';
          }?>
          <time itemprop="startDate" datetime="<?php eo_the_start($microformat); ?>"><?php eo_the_start($format); ?></time>

          <!-- Display event meta list -->
          <?php echo eo_get_event_meta_list(); ?>

          <!-- Show Event text as 'the_excerpt' or 'the_content' -->
          <?php the_excerpt(); ?>
      
        </div><!-- .event-entry-meta -->
    
        <!-- <div style="clear:both;"></div> -->
      </div><!-- .entry-header -->
      </div><!-- #post-<?php the_ID(); ?> -->

        <?php endwhile; ?><!--The Loop ends-->

      <!-- Navigate between pages-->
      <?php 
      if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav id="nav-below">
          <div class="nav-next events-nav-newer"><?php next_posts_link( __( 'Later events <span class="meta-nav">&rarr;</span>' , 'eventorganiser' ) ); ?></div>
          <div class="nav-previous events-nav-newer"><?php previous_posts_link( __( ' <span class="meta-nav">&larr;</span> Newer events', 'eventorganiser' ) ); ?></div>
        </nav><!-- #nav-below -->
      <?php endif; ?>


  <?php else : ?>
      <!-- If there are no events -->
      <div id="post-0" class="post no-results not-found">
        <header class="entry-header">
          <h1 class="entry-title"><?php _e( 'Nothing Found', 'eventorganiser' ); ?></h1>
        </header><!-- .entry-header -->
        <div class="entry-content">
          <p><?php _e( 'Apologies, but no events were found for the requested venue. ', 'eventorganiser' ); ?></p>
        </div><!-- .entry-content -->
      </div><!-- #post-0 -->

  <?php
  endif;
  echo "</div>";
get_sidebar('events');
get_footer();
?>
