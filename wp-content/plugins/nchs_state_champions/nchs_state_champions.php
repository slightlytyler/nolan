<?php
/*
Plugin Name: NCHS State Champions Widget
Plugin URI: http://deepspacerobots.com/
Description: NCHS State Champions Widget
Author: Rob Momary
Version: 1
Author URI: http://deepspacerobots.com/
*/ 
class nchs_state_champions_Widget extends WP_Widget {

  function nchs_state_champions_Widget() {
    $widget_ops = array( 'classname' => 'NCHSStateChampionsWidget', 'description' => 'Displays State Champions text' );
    $this->WP_Widget( 'NCHSStateChampionsWidget', 'NCHS State Champions', $widget_ops );
  }

  function widget( $args, $instance ) {
  	extract( $args, EXTR_SKIP );
    echo $before_widget;

    $title = empty($instance['title']) ? '' : $instance['title'];
    $text  = empty($instance['text']) 	? '' : $instance['text'];

	 	$content = '
	 	<div class="calendar_content state_champ_box">
      <h4>'.$title.'</h4>
      <div class="dates_box">'.$text.'</div>
    </div>';
    echo '<div class="crest"></div>';
	  echo $content;

  	echo $after_widget;
  }

  function update( $new_instance, $old_instance ) {

  	$updated_instance = $old_instance;
    $updated_instance['title'] = $new_instance['title'];
    $updated_instance['text']  = $new_instance['text'];

    return $updated_instance;
  }

  function form( $instance ) {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
    $title    = $instance['title'];
    $msg      = $instance['text'];

    $result_string = '
		<p><label for="'.$this->get_field_id("title").'">Title: <input class="widefat" id="'.$this->get_field_id("title").'" name="'.$this->get_field_name("title").'" type="text" value="'.attribute_escape($title).'" /></label></p>

		<p><label for="'.$this->get_field_id("text").'">Text (supports HTML): <textarea class="widefat" id="'.$this->get_field_id("text").'" name="'.$this->get_field_name("text").'" rows="5" />'.attribute_escape($msg).'</textarea></label></p>';

		echo $result_string;
  }
}

add_action( 'widgets_init', create_function( '', "register_widget( 'nchs_state_champions_Widget' );" ) );
