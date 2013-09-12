<?php
/*
Plugin Name: DKA Child pages widget
Plugin URI: http://wordpress.org/extend/plugins/dka-child-pages-widget/
Description: Widget which shows child pages
Version: 0.5
Author: Dainius Kaupaitis
Author URI: http://sum.lt
License: GPL2
*/

load_plugin_textdomain( 'dka-child-pages', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

class dka_child_pages extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'dka_child_pages', // Base ID
			'DKA_Child_Pages', // Name
			array( 'description' => __( 'Widget which shows child pages', 'dka-child-pages' ), ) // Args
		);
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		$child_of = 0 ;
		
		if ( is_page() ){
			$child_of = get_the_ID() ;
			$post = get_post();
		}	
		$childs = array(
			'title_li' => '',
			'child_of' => $child_of,
			'depth' => 1,
			'echo' => 0,
			'post_type'=>'page',
			'exclude' => $instance['exclude']
		) ;
		$brothers = array_merge( $childs, array( 'child_of' => $GLOBALS['post']->post_parent ) ) ;
		
		if ( strlen( $wp_list_pages = wp_list_pages($childs) ) ) {
		
			// page has childs
		
		} elseif ( strlen( $wp_list_pages = wp_list_pages($brothers) ) ) {
		
			// page has no childs, but has brothers
		
		} else {
			
			// nothing to show
			return false ;
			
		}
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		
		echo $before_widget;
		
		if($instance['is_athletics']=="true"){
			$before_title="";
			$after_title= "";
			$before_content="<div class='calendar_content latest_news_box'>";
			$after_content = "<div class='facebook_link'></div></div>";
		}else{
			$before_content="";
			$after_content="";
		}
		echo $before_title;
		if ( ! empty( $title ) && $instance['is_athletics']!="true") :
			echo get_the_title();
		endif;
		echo $after_title;
		echo $before_content;
		if($post->post_parent!=0): 
			if($instance['is_athletics']!="true") :
			echo "<a class='parent_page' href='".get_permalink($post->post_parent)."'>&#171; Back to ".get_the_title($post->post_parent)."</a>";
			else : 
			echo "<ul><li><a class='parent_page' href='".get_permalink($post->post_parent)."'>&#171; Back to ".get_the_title($post->post_parent)."</a></li></ul>";
			endif;
		endif;
	
		if(has_children($post->ID)) :
			echo "<ul>".$wp_list_pages."</ul>";
		endif;
		echo $after_content;
		echo $after_widget;
		
			
		
		
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['is_athletics'] = strip_tags( $new_instance['is_athletics'] );
		$instance['exclude'] = implode( ',', array_unique( array_filter( array_map( 'trim', preg_split( '/(\s)*,(\s)*/', $new_instance['exclude'] ) ), 'is_numeric' ) ) ) ;

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		
		$title = '' ;
		if ( isset( $instance[ 'title' ] ) )
			$title = $instance[ 'title' ];
		
		$is_athletics = '';
		if (isset($instance["is_athletics"]))
			$is_athletics = $instance[ 'is_athletics' ];
		
		$exclude = '' ;
		if ( isset( $instance[ 'exclude' ] ) )
			$exclude = $instance[ 'exclude' ];
		
		$exclude_id = $this->get_field_id( 'exclude' ) ;
		$select_name = $this->get_field_id( 'page_id' ) ;
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( '<strong>Title</strong>:', 'dka-child-pages' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'is_athletics' ); ?>"><?php _e( '<strong>Athletics Page</strong>:', 'dka-child-pages' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'is_athletics' ); ?>" name="<?php echo $this->get_field_name( 'is_athletics' ); ?>" type="checkbox" value="true" <?php if(esc_attr( $is_athletics )=="true") echo 'checked'; ?>/>
		</p>
		<p>
		<label for="<?= $exclude_id ?>"><?php _e( '<strong>Exclude pages</strong>. Comma separated page ID values. Write:', 'dka-child-pages' ); ?></label> 
		<input class="widefat" id="<?= $exclude_id ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>" type="text" value="<?php echo esc_attr( $exclude ); ?>" />
		<br><?= __( ' or select: ', 'dka-child-pages' ) ?>
		<?php wp_dropdown_pages( array( 'show_option_none' => __('-- select --', 'dka-child-pages'), 'name' => $select_name ) ) ; ?>
		<br><a href="#<?= $exclude_id ?>" rel="#<?= $select_name ?>" onclick="return false" class="exclude"><?= __( 'Exclude selected', 'dka-child-pages' ) ?></a>
		
		<?php 
	}
	
	/**
	* Enqueue scripts
	*/
	public function enqueue_scripts () {
	
		wp_enqueue_script( 'dka-child-pages', plugins_url('/dka-child-pages.js', __FILE__), array('jquery') );

	
	}

}

// register widget
add_action( 'widgets_init', create_function( '', 'register_widget( "dka_child_pages" );' ) );

?>