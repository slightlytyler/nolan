<?php
/*
Plugin Name: NCHS Video Widget
Plugin URI: http://deepspacerobots.com/
Description: NCHS Video Widget
Author: Rob Momary
Version: 1
Author URI: http://deepspacerobots.com/
*/ 
class nchs_video_Widget extends WP_Widget {

  function nchs_video_Widget() {
    $widget_ops = array( 'classname' => 'NCHSVideoWidget', 'description' => 'Displays a video' );
    $this->WP_Widget( 'NCHSVideoWidget', 'NCHS Video', $widget_ops );
  }

  function widget( $args, $instance ) {
  	extract( $args, EXTR_SKIP );
    echo $before_widget;

	 	$embed_code = $instance['embed_code'];
		
	  echo '<div class="info_video"><div class="info_video_wrapprer">';
	  echo $embed_code;
	  echo '</div></div>';

  	echo $after_widget;
  }

  function update( $new_instance, $old_instance ) {

  	$updated_instance = $old_instance;
    $updated_instance['embed_code'] 		= $new_instance['embed_code'];

    return $updated_instance;
  }

  function form( $instance ) {
    $instance = wp_parse_args( (array) $instance, array( 'embed_code' => '') );
    $embed_code = $instance['embed_code'];

    $result_string = '
    <p><label for="'.$this->get_field_id("embed_code").'">Video embed code: <textarea class="widefat" id="'.$this->get_field_id("embed_code").'" name="'.$this->get_field_name("embed_code").'" rows="5">'.attribute_escape($embed_code).'</textarea></label></p>';

		echo $result_string;
  }
}

add_action( 'widgets_init', create_function( '', "register_widget( 'nchs_video_Widget' );" ) );
