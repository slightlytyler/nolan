<?php

function nchs_register_menus() {
  register_nav_menus( array(
  	'nchs-main-menu' => __('Main Menu'),
  	'nchs-nav-menu' => __('Nav Menu')
  ) );
}
add_action( 'init', 'nchs_register_menus' );

?>