<?php
/*
Plugin Name: NCHS Sport Events Widget
Plugin URI: http://deepspacerobots.com/
Description: Displays 5 most recent Events in the sport for the current sport page.
Author: Taylor Young
Version: 1
Author URI: http://deepspacerobots.com/
*/

add_action( 'widgets_init', function(){ register_widget( 'Sport_Events_Widget' ); });

class Sport_Events_Widget extends WP_Widget {
  function __construct() {
    parent::__construct(
      'sports_events_widget'
      , 'Sport Events'
      , array( 'description' => 'Displays 5 most recent Events in the sport for the current sport page.' )
    );
  }

  function widget($args, $instance) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $sport_id = $instance['sport'];
    if( !$sport_id )
      $sport_id = get_field('news_category', $GLOBALS['post']->ID );
    $term = get_term( $sport_id, 'sport' );
    $event_query = new WP_Query( [ 
      'post_type' => 'event',
      'posts_per_page' => '5',
      'sport' => $term->slug
    ] );
    if( $event_query->have_posts() ) :
      echo $before_widget;
      if ( $title )
        echo $before_title . $title . $after_title;
      else
        echo $before_title . $term->slug . ' Events' . $after_title;
      echo '<ul>';
      while ( $event_query->have_posts() ) : $event_query->the_post();
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
        echo sprintf( "<li><a href='%s'>%s</a></li>", get_permalink(), get_the_title() );
        the_excerpt();
      endwhile;
      wp_reset_postdata();
      echo '</ul>';
      echo $after_widget;
    endif;
  }

  function update($new_instance, $old_instance) {   
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['sport'] = strip_tags($new_instance['sport']);
    return $instance;
  }

  function form($instance) {  
    $title = esc_attr($instance['title']);
    $sport = esc_attr($instance['sport']);
?>
    <p>Leave the title blank to use '[Sport] Events' default title</p>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> 
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <p>When used with the Sport Template 'Sport Page Context' mode automatically displays relevant content. (Category set on page template)</p>
    <p>
      <label for="<?php echo $this->get_field_id('sport'); ?>">Sport:</label> 
<?php
    $terms = get_terms('sport');
    if(count($terms) > 0) {
      echo '<select id="'.$this->get_field_id("sport").'" name="'.$this->get_field_name("sport").'" type="text" value="'.$sport.'">';
      echo "<option value=''>Sport Page Context</option>";
      foreach ($terms as $term) { 
        if( $term->term_id === $sport )
          echo "<option value='$term->term_id' selected='selected'>$term->name ($term->count)</option>";
        else
          echo "<option value='$term->term_id'>$term->name ($term->count)</option>";
      }
      echo "</select>";
    }
    echo "</p>";
  }
}
?>