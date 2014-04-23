<?php
/* 
 * Posts 2 Posts Configuration
 */

class NHCS_Posts2Posts {
  public static function init() {
    add_action( 'p2p_init', array( __CLASS__, 'nhcs_p2p_connections' ) );
    add_filter( 'p2p_connectable_args', array( __CLASS__, 'nhcs_filter_pages_by_template' ), 10, 3 );
    add_filter( 'p2p_admin_box_show', array( __CLASS__, 'nhcs_restrict_p2p_box_display' ), 10, 3 );
  }

  public function nhcs_p2p_connections() {
    p2p_register_connection_type( array(
      'name' => 'faculty_to_pages',
      'from' => 'page',
      'to' => 'faculty',
      'sortable' => 'any',
      'admin_column' => 'any',
    ) );
    p2p_register_connection_type( array(
      'name' => 'ministry_to_pages',
      'from' => 'page',
      'to' => 'ministry',
      'sortable' => 'any',
      'admin_column' => 'any',
    ) );
    p2p_register_connection_type( array(
      'name' => 'coach_to_pages',
      'from' => 'page',
      'to' => 'coach',
      'sortable' => 'any',
      'admin_column' => 'any',
    ) );
    p2p_register_connection_type( array(
      'name' => 'student_to_pages',
      'from' => 'page',
      'to' => 'student',
      'sortable' => 'any',
      'admin_column' => 'any',
      'fields' => array(
        'field_1' => array(
          'title' => 'Field 1',
          'type' => 'text',
        ),
        'field_2' => array(
          'title' => 'Field 2',
          'type' => 'text',
        ),
        'field_3' => array(
          'title' => 'Field 3',
          'type' => 'text',
        ),
        'field_4' => array(
          'title' => 'Field 4',
          'type' => 'text',
        ),
        'hide' => array(
          'title' => 'Hide',
          'type' => 'checkbox'
        ),
      )
    ) );
  }

  public function nhcs_filter_pages_by_template( $args, $ctype, $post_id ) {
    // @todo Theme Option?
    $args['p2p:per_page'] = 15;
    if( 'to' == $ctype->get_direction() ) {
      $args['post_type'] = 'page';
      $args['meta_key'] = '_wp_page_template';
      $args['meta_compare'] = '=';
      // if ( 'student_to_pages' == $ctype->name )
      //   $args['meta_value'] = 'page-club.php';
      if ( 'faculty_to_pages' == $ctype->name )
        $args['meta_value'] = 'page-department.php';
      if ( 'ministry_to_pages' == $ctype->name )
        $args['meta_value'] = 'page-ministry.php';
      if ( 'student_to_pages' == $ctype->name || 'coach_to_pages' == $ctype->name || 'player_to_pages' == $ctype->name )
        $args['meta_value'] = 'page-sport.php';
    }
    return $args;
  }

  public function nhcs_restrict_p2p_box_display( $show, $ctype, $post ) {
    if ( 'faculty_to_pages' == $ctype->name )
      if( $post->post_type == 'page' )
        return ( 'page-department.php' == $post->page_template );
    if( $post->post_type == 'page' )
      if ( $post->page_template == 'page-ministry.php' )
        if ( 'ministry_to_pages' == $ctype->name )
          return ( 'page-ministry.php' == $post->page_template );
      if ( $post->page_template == 'page-sport.php' )
        if ( 'student_to_pages' == $ctype->name || 'coach_to_pages' == $ctype->name || 'player_to_pages' == $ctype->name )        
          return ( 'page-sport.php' == $post->page_template );
      if ( $post->page_template == 'page-club.php' )
        if ( 'student_to_pages' == $ctype->name )
          return ( 'page-club.php' == $post->page_template );
    if( $post->post_type == 'faculty' || $post->post_type == 'ministry' || $post->post_type == 'player' || $post->post_type == 'coach' || $post->post_type == 'student' )
    return $show;
  }
}
?>