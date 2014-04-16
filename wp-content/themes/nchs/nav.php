<div class="menu1_section">
  <div class="page_section">
    <?php
      wp_nav_menu( 
        array(
          'theme_location'  => 'nchs-nav-menu',
          'container'       => 'nav',
          'container_class' => 'menu1',
          'items_wrap'      => '%3$s',
          'depth'           => 2
        )
      );
    ?>
  </div>
</div>