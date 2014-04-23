<?php
$class = "";
// can this be detected with the just added body classes instead?

if (is_home())
  $class .= "home ";
elseif (is_page( $page = 'athletics') || (is_archive() && in_array(get_query_var('post_type'), array('coach', 'player'))))
  $class .= "athletics ";
elseif (is_page() || is_single())
  $class .= "interior ";
global $post;

$parents = get_post_ancestors( $post->ID );
$id = ($parents) ? $parents[count($parents)-1]: $post->ID;
$parent = get_page($id);
if (strcmp($parent->post_name, "athletics") == 0) {
  $class .= $parent->post_name;
}
?>
<body <?php body_class($class); ?>>