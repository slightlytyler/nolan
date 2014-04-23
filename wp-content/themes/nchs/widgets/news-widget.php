<?php
class News_Widget extends WP_Widget {
  function __construct() {
    parent::__construct(
      'news_widget'
      , 'News'
      , array( 'description' => 'Displays 5 most recent News Stories' )
    );
  }
  function widget($args, $instance) {
    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $news_query = new WP_Query( [ 
      'post_type' => 'news',
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
        echo sprintf( "<li><a href='%s'>%s</a></li>", get_permalink(), get_the_title() );
        // echo '<p>'.get_terms('sport', 'orderby=count&hide_empty=0').'</p>';
        // the_excerpt();
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
      $title = 'News';
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> 
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <?php 
  }
}
?>