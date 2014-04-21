<?php get_header(); ?>
<div class="page-content col-sm-7 col-md-8" role="main">
	<h1 class="page-title">
	<?php
		if( eo_is_event_archive('day') )
			//Viewing date archive
			echo __('Events: ','eventorganiser').' '.eo_get_event_archive_date('jS F Y');
		elseif( eo_is_event_archive('month') )
			//Viewing month archive
			echo __('Events: ','eventorganiser').' '.eo_get_event_archive_date('F Y');
		elseif( eo_is_event_archive('year') )
			//Viewing year archive
			echo __('Events: ','eventorganiser').' '.eo_get_event_archive_date('Y');
		else
			_e('Events','eventorganiser');
	?>
	</h1>
<?php
if ( have_posts() ) :
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="nav-above">
			<div class="nav-next events-nav-newer"><?php next_posts_link( __( 'Later events <span class="meta-nav">&rarr;</span>' , 'eventorganiser' ) ); ?></div>
			<div class="nav-previous events-nav-newer"><?php previous_posts_link( __( ' <span class="meta-nav">&larr;</span> Newer events', 'eventorganiser' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php

	endif;

	while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h1 class="entry-title" style="display: inline;">
			<?php the_post_thumbnail('thumbnail', array('style'=>'float:left;margin-right:20px;')); ?>
			<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
		</h1>
		<div class="event-entry-meta">
			<?php
				//Format date/time according to whether its an all day event.
				//Use microdata http://support.google.com/webmasters/bin/answer.py?hl=en&answer=176035
					if( eo_is_all_day() ){
					$format = 'd F Y';
					$microformat = 'Y-m-d';
				}else{
					$format = 'd F Y '.get_option('time_format');
					$microformat = 'c';
				}
			?>
			<time itemprop="startDate" datetime="<?php eo_the_start($microformat); ?>"><?php eo_the_start($format); ?></time>
			<?php
				echo eo_get_event_meta_list();
				the_excerpt();
			?>
		</div><!-- .event-entry-meta -->
		<div style="clear:both;"></div>
	</div><!-- #post-<?php the_ID(); ?> -->
	<?php endwhile; ?><!--The Loop ends-->
<!-- Navigate between pages-->
<?php 
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="nav-below">
			<div class="nav-next events-nav-newer"><?php next_posts_link( __( 'Later events <span class="meta-nav">&rarr;</span>' , 'eventorganiser' ) ); ?></div>
			<div class="nav-previous events-nav-newer"><?php previous_posts_link( __( ' <span class="meta-nav">&larr;</span> Newer events', 'eventorganiser' ) ); ?></div>
		</nav><!-- #nav-below -->
<?php
	endif;
else :
?>
	<div id="post-0" class="post no-results not-found">
		<h1 class="entry-title"><?php _e( 'Nothing Found', 'eventorganiser' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. ', 'eventorganiser' ); ?></p>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php
endif;
echo '</div>';
get_sidebar('events');
get_footer();
?>