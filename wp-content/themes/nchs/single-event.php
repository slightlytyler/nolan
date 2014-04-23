<?php get_header(); ?>
<div class="page-content col-sm-7 col-md-8" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Display event title -->
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">
				<!-- Get event information, see template: event-meta-event-single.php -->
				<?php eo_get_template_part('event-meta','event-single'); ?>
				<!-- The content or the description of the event-->
				<?php the_content(); ?>
			</div><!-- .entry-content -->
			<div class="entry-meta">
			<?php
				//Events have their own 'event-category' taxonomy. Get list of categories this event is in.
				$categories_list = get_the_term_list( get_the_ID(), 'event-category', '', ', ',''); 
				if ( '' != $categories_list ) {
					$utility_text = __( 'This event was posted in %1$s by <a href="%5$s">%4$s</a>. Bookmark the <a href="%2$s" title="Permalink to %3$s" rel="bookmark">permalink</a>.', 'eventorganiser' );
				} else {
					$utility_text = __( 'This event was posted by <a href="%5$s">%4$s</a>. Bookmark the <a href="%2$s" title="Permalink to %3$s" rel="bookmark">permalink</a>.', 'eventorganiser' );
				}
				printf($utility_text,
					$categories_list,
					esc_url( get_permalink() ),
					the_title_attribute( 'echo=0' ),
					get_the_author(),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
				);
			?>
			<?php edit_post_link( __( 'Edit'), '<span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-meta -->
		</div><!-- #post-<?php the_ID(); ?> -->
		<!-- If comments are enabled, show them -->
		<div class="comments-template">
			<?php comments_template(); ?>
		</div>
	<?php endwhile; // end of the loop. ?>
</div><!-- #primary -->
<?php 
nchs_sidebar('events');
get_footer();
?>
