<?php
/*
Plugin Name: NCHS Calendar Widget
Plugin URI: http://deepspacerobots.com/
Description: NCHS Calendar Widget
Author: Rob Momary
Version: 1
Author URI: http://deepspacerobots.com/
*/  
global $post;

class nchs_calendar_Widget extends WP_Widget {

  function nchs_calendar_Widget() {
    $widget_ops = array( 'classname' => 'NCHSCalendarWidget', 'description' => 'Displays the calendar' );
    $this->WP_Widget( 'NCHSCalendarWidget', 'NCHS Calendar', $widget_ops );
  }

  function widget( $args, $instance ) {
    $use_calendar = types_render_field("use-calendar", array('raw' => true));
    if (!$use_calendar && !is_home()) {
      return;
    }
  	
    extract( $args, EXTR_SKIP );
    
    $title 		 = $instance['title'];
    $show_link = $instance['show_link'];

    $slug = get_post( $post )->post_name;

    echo $before_widget;

    if (is_home()) echo '<div class="calendar_section">';

    echo '
    <div class="calendar_box calendar_box_width_auto">
    <div class="calendar_head">
      <h4>'.$title.'</h4>
    </div>
    <div class="calendar_body">
      <div class="calendar_content">'.
        do_shortcode('[ai1ec view="agenda" cat_name="'.$slug.'"]').
      '</div>
    </div>';
    if ($show_link) {
      echo '<div class="calendar_footer"><a href="#">VIEW FULL CALENDAR</a></div>';
    }
    echo '</div>';

    if (is_home()) echo '</div>';

  	echo $after_widget;
  }

  function update( $new_instance, $old_instance ) {

  	$updated_instance = $old_instance;
    $updated_instance['title'] 	= $new_instance['title'];
    $updated_instance['show_link'] 		= $new_instance['show_link'];

    return $updated_instance;
  }

  function form( $instance ) {
    $instance  = wp_parse_args( (array) $instance, array( 'title' => '', 'show_link' => '' ) );
    $title 		 = $instance['title'];
    $show_link = (bool) $instance['show_link'];

    $checked = checked(isset($show_link) ? $show_link : 0, true, false);

    $result_string = '
		<p><label for="'.$this->get_field_id("title").'">Title: <input class="widefat" id="'.$this->get_field_id("title").'" name="'.$this->get_field_name("title").'" type="text" value="'.attribute_escape($title).'" /></label></p>
    <p><label for="'.$this->get_field_id("title").'">Show "View full calendar link"?: <input class="widefat" id="'.$this->get_field_id("show_link").'" name="'.$this->get_field_name("show_link").'" type="checkbox" value="1"'.$checked.' /></label></p>';

		echo $result_string;
  }
}
add_action( 'widgets_init', create_function( '', "register_widget( 'nchs_calendar_Widget' );" ) );
