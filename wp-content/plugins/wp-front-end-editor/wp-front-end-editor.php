<?php

/*
Plugin Name: WordPress Front-end Editor
Plugin URI: http://wordpress.org/plugins/wp-front-end-editor/
Description: WordPress Front-end Editor
Author: avryl
Author URI: http://profiles.wordpress.org/avryl/
Version: 0.9.1
Text Domain: wp-front-end-editor
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


if ( ! class_exists( 'WP_Front_End_Editor' ) ) {
	require_once( 'class-wp-front-end-editor.php' );
	WP_Front_End_Editor::instance();

	// class Custom_WP_Front_End_Editor extends WP_Front_End_Editor {
	//   // custom else if disables plugin link in admin bar.
	//   public static function edit_link( $id ) {
	//     $post = get_post( $id );
	//     // echo get_edit_post_link(  $post->ID, '' );
	//     if ( ! $post )
	//       return;
	//     if ( $id == get_option( 'page_on_front' ) ) {
	//       $link = home_url( '?editing' );
	//     } elseif ( is_page_template( 'page-sport.php' ) 
	//       || is_page_template( 'page-ministry.php' )
	//       || is_page_template( 'page-club.php' )
	//       || is_page_template( 'page-department.php' ) ) {
	//       $link = admin_url( '/post.php?post=' . $post->ID . '&action=edit' );
	//     } else {
	//       $permalink = get_permalink( $post->ID );
	//       if ( strpos( $permalink, '?' ) !== false )
	//         $link = add_query_arg( 'edit', '', $permalink );
	//       if ( trailingslashit( $permalink ) === $permalink )
	//         $link = trailingslashit( $permalink . 'edit' );
	//       if ( ! isset( $link ) )
	//         $link = trailingslashit( $permalink ) . 'edit';
	//     }
	//     if ( force_ssl_admin() )
	//       $link = set_url_scheme( $link, 'https' );
	//     return $link;
	//   }
	// };
	// Custom_WP_Front_End_Editor::instance();
}
