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
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
    wp_enqueue_script('nchs_calendar_functions', plugins_url( 'js/nchs_calendar_functions.js', __FILE__ ), array('jquery', 'jquery-ui-datepicker'));
  }

  function widget( $args, $instance ) {
    $use_calendar = types_render_field("use-calendar", array('raw' => true));
    if (!$use_calendar && !is_home()) {
      return;
    }
  	
    extract( $args, EXTR_SKIP );
    
    $title 		 = $instance['title'];
    $show_link = $instance['show_link'];
    $from_date = $instance['from_date'];
    $to_date = $instance['to_date'];

    $date_filter = '';
    if ($from_date != "") {
      $date_filter .= 'from_date="'.$from_date.'" ';
    }
    if ($to_date != "") {
      $date_filter .= 'to_date="'.$to_date.'" ';
    }

    wp_reset_postdata();
    $slug = get_post( $post )->post_name;
    echo $before_widget;

    if (is_home()) echo '<div class="calendar_section">';

    echo '
    <div class="calendar_box">
    <div class="calendar_head">
      <h4>'.$title.'</h4>
    </div>
    <div class="calendar_body">
      <div class="calendar_content">';
if(is_home()) : 
	 echo   do_shortcode('[ai1ec view="agenda" '.$date_filter.']');
	else : 
     echo   do_shortcode('[ai1ec view="agenda" cat_name="'.$slug.'" '.$date_filter.']');
endif;
      echo '</div>
    </div>';
    if ($show_link) {
      echo '<div class="calendar_footer"><a href="#">VIEW FULL CALENDAR</a></div>';
    }
    echo '</div>';

    if (is_home()) echo '</div>';

  	echo $after_widget;
	wp_reset_query();
  }

  function update( $new_instance, $old_instance ) {

  	$updated_instance = $old_instance;
    $updated_instance['title'] = $new_instance['title'];
    $updated_instance['show_link'] = $new_instance['show_link'];
    $updated_instance['from_date'] = $new_instance['from_date'];
    $updated_instance['to_date'] = $new_instance['to_date'];

    return $updated_instance;
  }

  function form( $instance ) {
    $instance  = wp_parse_args( (array) $instance, array( 'title' => '', 'show_link' => '', 'from_date' => '', 'to_date' => '' ) );
    $title 		 = $instance['title'];
    $show_link = (bool) $instance['show_link'];
    $from_date = $instance['from_date'];
    $to_date = $instance['to_date'];

    $checked = checked(isset($show_link) ? $show_link : 0, true, false);

    $result_string = '
		<p><label for="'.$this->get_field_id("title").'">Title: <input class="widefat" id="'.$this->get_field_id("title").'" name="'.$this->get_field_name("title").'" type="text" value="'.attribute_escape($title).'" /></label></p>
    <p><label for="'.$this->get_field_id("from_date").'">Start date: <input class="widefat" id="'.$this->get_field_id("from_date").'" name="'.$this->get_field_name("from_date").'" type="text" data-date="true" value="'.attribute_escape($from_date).'" /></label></p>
    <p><label for="'.$this->get_field_id("to_date").'">End date: <input class="widefat" id="'.$this->get_field_id("to_date").'" name="'.$this->get_field_name("to_date").'" type="text" data-date="true" value="'.attribute_escape($to_date).'" /></label></p>
    <p><label for="'.$this->get_field_id("show_link").'">Show "View full calendar link"?: <input class="widefat" id="'.$this->get_field_id("show_link").'" name="'.$this->get_field_name("show_link").'" type="checkbox" value="1"'.$checked.' /></label></p>';

    $result_string .= '<script type="text/javascript">if (jQuery.isReady) { updateDatepickers(); }</script>';

		echo $result_string;
  }
}
add_action( 'widgets_init', create_function( '', "register_widget( 'nchs_calendar_Widget' );" ) );
