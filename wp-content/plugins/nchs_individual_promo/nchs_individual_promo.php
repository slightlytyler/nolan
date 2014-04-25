<?php
/*
Plugin Name: NCHS Individual Promo Widget
Plugin URI: http://deepspacerobots.com/
Description: NCHS Individual Promo Widget
Author: Rob Momary
Version: 1
Author URI: http://deepspacerobots.com/
*/ 
if( class_exists( 'WidgetImageField' ) )
    add_action( 'widgets_init', create_function( '', "register_widget( 'nchs_individual_promo_Widget' );" ) );
 
class nchs_individual_promo_Widget extends WP_Widget {

  var $image_field = 'img';

  function nchs_individual_promo_Widget() {
    $widget_ops = array( 'classname' => 'NCHSIndividualPromoWidget', 'description' => 'Displays a individual promo image' );
    $this->WP_Widget( 'NCHSIndividualPromoWidget', 'NCHS Individual Promo', $widget_ops );
  }

  function widget( $args, $instance ) {
    extract( $args, EXTR_SKIP );
    
    $img_id   = esc_attr( isset( $instance[$this->image_field] ) ? $instance[$this->image_field] : 0 );
    $title    = $instance['title'];
    $msg      = $instance['msg'];

    $img      = new WidgetImageField( $this, $img_id );

    echo $before_widget;
    echo '<div class="promo-card">';
      if( !empty( $img_id ) ) { echo '<img src="'.$img->get_image_src('full').'" />'; }
      echo '<div class="promo-info">';
        if( !empty( $title ) ) { echo '<h3>'.$title.'</h3>'; }
        if( !empty( $msg ) ) { echo '<p>'.$msg.'</p>'; }
      echo '</div>';
    echo '</div>';
    echo $after_widget;
  }

  function update( $new_instance, $old_instance ) {

    $updated_instance = $old_instance;
    $updated_instance['title']  = $new_instance['title'];
    $updated_instance['msg']    = $new_instance['msg'];

    $updated_instance[$this->image_field] = intval( strip_tags( $new_instance[$this->image_field] ) );

    return $updated_instance;
  }

  function form( $instance ) {
    $instance = wp_parse_args( (array) $instance, array( 'img' => '', 'title' => '', 'msg' => '' ) );
    $img_id   = esc_attr( isset( $instance[$this->image_field] ) ? $instance[$this->image_field] : 0 );
    $title    = $instance['title'];
    $msg      = $instance['msg'];

    $img      = new WidgetImageField( $this, $img_id );

    $result_string = '
    <p><label for="'.$this->get_field_id("img").'">Image: '.$img->get_widget_field().'</label></p>
    <p><label for="'.$this->get_field_id("title").'">Title: <input class="widefat" id="'.$this->get_field_id("title").'" name="'.$this->get_field_name("title").'" type="text" value="'.attribute_escape($title).'" /></label></p>
    <p><label for="'.$this->get_field_id("msg").'">Message (supports html): <textarea class="widefat" id="'.$this->get_field_id("msg").'" name="'.$this->get_field_name("msg").'" rows="5" />'.attribute_escape($msg).'</textarea></label></p>';

    echo $result_string;
  }
}
add_action( 'widgets_init', create_function( '', "register_widget( 'nchs_individual_promo_Widget' );" ) );
