<?php
/*
Plugin Name: NCHS Mission Widget
Plugin URI: http://deepspacerobots.com/
Description: NCHS Mission Widget
Author: Rob Momary
Version: 1
Author URI: http://deepspacerobots.com/
*/  
class nchs_mission_Widget extends WP_Widget {

  function nchs_mission_Widget() {
    $widget_ops = array( 'classname' => 'NCHSMissionWidget', 'description' => '' );
    $this->WP_Widget( 'NCHSMissionWidget', 'NCHS Mission', $widget_ops );
  }

  function widget( $args, $instance ) {
  	extract( $args, EXTR_SKIP );
    
    $title = $instance['title'];
    $text  = $instance['text'];
    $link  = $instance['link'];

    echo $before_widget;

    echo "<div class='mission_section'>
      <div class='mission_head'>
        <div class='page'>
          <div class='mission_title'>
            <div class='mission_arrow'></div>
            <h3>".$title."</h3>
          </div>
        </div>
      </div>
      <div class='mission_body'>
        <div class='page'>
          <div class='mission_txt'>".wpautop($text, true)."
            <div><a class='blue_btn' href='".$link."'>Read More</a></div>
          </div>
        </div>
      </div>
    </div>";

  	echo $after_widget;
  }

  function update( $new_instance, $old_instance ) {

  	$updated_instance = $old_instance;
    $updated_instance['title'] 	= $new_instance['title'];
    $updated_instance['text'] 	= $new_instance['text'];
    $updated_instance['link']   = $new_instance['link'];

    return $updated_instance;
  }

  function form( $instance ) {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'link' => '' ) );
    $title 		= $instance['title'];
    $text     = $instance['text'];
    $link     = $instance['link'];

    $result_string = '
		<p><label for="'.$this->get_field_id("title").'">Title: <input class="widefat" id="'.$this->get_field_id("title").'" name="'.$this->get_field_name("title").'" type="text" value="'.attribute_escape($title).'" /></label></p>
    <p><label for="'.$this->get_field_id("text").'">Mission: <textarea class="widefat" id="'.$this->get_field_id("text").'" name="'.$this->get_field_name("text").'" rows="5" />'.attribute_escape($text).'</textarea></label></p>
    <p><label for="'.$this->get_field_id("link").'">Link: <input class="widefat" id="'.$this->get_field_id("link").'" name="'.$this->get_field_name("link").'" type="text" value="'.attribute_escape($link).'" /></label></p>';

		echo $result_string;
  }
}
add_action( 'widgets_init', create_function( '', "register_widget( 'nchs_mission_Widget' );" ) );
