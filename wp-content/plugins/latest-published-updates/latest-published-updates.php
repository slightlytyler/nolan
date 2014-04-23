<?php
/**
 Plugin Name: Latest Published Updates
 Plugin URI: http://get10up.com/plugins/wordpress-latest-changes-dashboard-widget/
 Description: Provides a dashboard widget that allows editors and above to get a synopsis of the latest updates / additions to the public site, including who did it and what changed. 
 Version: 0.9
 Author: Jake Goldman (10up)
 Author URI: http://get10up.com

    Plugin: Copyright 2011 10up (email : jake@get10up.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action( 'wp_dashboard_setup', 'add_latest_published_updates_widget' );

function add_latest_published_updates_widget() {
    if ( current_user_can( 'edit_published_posts' ) )
        wp_add_dashboard_widget( 'latest_published_updates', 'Latest Published Site Updates', 'latest_published_updates_widget' );
}

function latest_published_updates_widget() {
    //global $post;
    
    $post_types = get_post_types(array( 'show_ui' => true ));   
	query_posts(array( 'posts_per_page' => '10', 'orderby' => 'modified', 'post_type' => $post_types, 'post_status' => 'publish' ));
	
	while(have_posts()) : the_post();
	
		echo '<p>';
			
		$post_type = get_post_type_object( get_post_type() );
		
		if ( get_the_title() == '' || get_the_title() == 'Auto Draft' ) {
			edit_post_link( '<strong>' . $post_type->labels->singular_name . '</strong>' );
		} else { 
        	echo $post_type->labels->singular_name . ' ';
	 		edit_post_link( '<strong>&#8220;' . get_the_title() . '&#8221;</strong>' );
    	}
		
		$revisions = wp_get_post_revisions();
	 		
	 	if ( empty($revisions) ) {
	 		
			 echo ' added <abbr title="' . get_post_modified_time('F jS @ g:i a') . '" style="text-decoration: underline; cursor: pointer;">' . human_time_diff( get_post_modified_time(), current_time('timestamp') ) . '</abbr> ago by ' . get_the_author_meta('display_name') . '.';
	 		
 		} else {
	 			
 			foreach ( $revisions as $rev ) {
 				if ( strstr( $rev->post_name, '-autosave' ) ) 
				 	continue;
 				
 				$revision = $rev;
 				break;
 			}
 			
 			echo ' updated <abbr title="' . get_post_modified_time('F jS @ g:i a') . '" style="text-decoration: underline; cursor: pointer;">' . human_time_diff( get_post_modified_time(), current_time('timestamp') ) . '</abbr> ago by ' . get_the_author_meta( 'display_name', $revision->post_author ) . '.';
 			echo ' <a href="revision.php?action=diff&post_type=' . urlencode( get_post_type() ) . '&right=' . get_the_ID() . '&left=' . $revision->ID . '">Compare to last revision.</a>';
 			
 		}
		
		echo '</p>';
	
	endwhile;
	
	wp_reset_query();
}