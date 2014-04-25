<?php
/*
Plugin Name: NCHS Athletics News Widget
Plugin URI: http://deepspacerobots.com/
Description: Displays 5 most recent Athletics Stories
Author: Taylor Young
Version: 1
Author URI: http://deepspacerobots.com/
*/

add_action( 'widgets_init', function(){ register_widget( 'Athletics_Widget' ); });

class Athletics_Widget extends WP_Widget {
  function __construct() {
    parent::__construct(
      'athletics_widget'
      , 'Athletics News'
      , array( 'description' => 'Displays 5 most recent Athletics Stories' )
    );
  }

  function widget($args, $instance) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $news_query = new WP_Query( [ 
      'post_type' => 'athletics',
      'posts_per_page' => '5'
    ] );
    if( $news_query->have_posts() ) :
      echo $before_widget;
      if ( $title )
        echo $before_title . $title . $after_title;
      else
        echo $before_title . $term->slug . ' News' . $after_title;
      echo '<ul>';
      while ( $news_query->have_posts() ) : $news_query->the_post();
        // echo get_the_term_list( $post->ID, 'sport' );
        echo sprintf( "<li><a href='%s'>%s</a></li>", get_permalink(), get_the_title() );
      endwhile;
      wp_reset_postdata();
      echo '</ul>';
      echo $after_widget;
    endif;
  }

  function update($new_instance, $old_instance) {   
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    return $instance;
  }

  function form($instance) {  
    $title    = esc_attr($instance['title']);
    if( !$title )
      $title = 'Athletics News';
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> 
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <?php 
  }
}
?>