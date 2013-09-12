<?php
/*
Plugin Name: NCHS Latest News Widgets
Plugin URI: http://deepspacerobots.com/
Description: NCHS Latest News Widgets
Author: Rob Momary
Version: 1
Author URI: http://deepspacerobots.com/
*/
global $post;

class nchs_latest_news_Widget extends WP_Widget {

  function nchs_latest_news_Widget() {
    $widget_ops = array( 'classname' => 'NCHSLatestNewsWidget', 'description' => '' );
    $this->WP_Widget( 'NCHSLatestNewsWidget', 'NCHS LatestNews', $widget_ops );
  }

  function widget( $args, $instance ) {
  	extract( $args, EXTR_SKIP );
    
    $title = $instance['title'];
    $filter_by_context = $instance['filter_by_context'];

    $slug = get_post( $post )->post_name;

    if ($filter_by_context && !is_home()) {
      $args = array( 'post_type' => 'post', 'posts_per_page' => 3, 'category_name' => $slug );
    } else {
      $args = array( 'post_type' => 'post', 'posts_per_page' => 3, 'tag' => 'homepage' );
    }

    $loop = new WP_Query( $args );

    echo $before_widget;

    if ($loop->have_posts()) {
      echo "<div class='info_news'>";
      echo "<div class='info_news_title'>".$title."</div>";
      while ( $loop->have_posts() ) {
        $loop->the_post();
        echo "<div class='media'>";
        echo "<a class='pull-left' href='#'>";
        echo the_post_thumbnail('nchs-index-latest-news-thumb');
        echo "</a>";
        echo "<div class='media-body'>";
        echo "<h4 class='media-heading'>";
        echo "<a href='<?php the_permalink(); ?>'>".the_title()."</a>";
        echo "</h4>";
        echo "<div class='news_date'>".the_time('D M j')."</div>";
        echo "</div>";
        echo "</div>";
      }
      echo "</div>";
    }

  	echo $after_widget;
  }

  function update( $new_instance, $old_instance ) {

  	$updated_instance = $old_instance;
    $updated_instance['title'] = $new_instance['title'];
    $updated_instance['filter_by_context'] = $new_instance['filter_by_context'];

    return $updated_instance;
  }

  function form( $instance ) {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'filter_by_context' => '' ) );
    $title 		= $instance['title'];
    $filter_by_context = (bool) $instance['filter_by_context'];

    $checked = checked(isset($filter_by_context) ? $filter_by_context : 0, true, false);

    $result_string = '
		<p><label for="'.$this->get_field_id("title").'">Title: <input class="widefat" id="'.$this->get_field_id("title").'" name="'.$this->get_field_name("title").'" type="text" value="'.attribute_escape($title).'" /></label></p>
    <p><label for="'.$this->get_field_id("filter_by_context").'">Filter news by context?: <input class="widefat" id="'.$this->get_field_id("filter_by_context").'" name="'.$this->get_field_name("filter_by_context").'" type="checkbox" value="1"'.$checked.' /></label></p>';

		echo $result_string;
  }
}
add_action( 'widgets_init', create_function( '', "register_widget( 'nchs_latest_news_Widget' );" ) );
