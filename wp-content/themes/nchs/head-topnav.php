<div class="navbar navbar-top"><!-- navbar-fixed-top -->
  <a href="/" class='nchs_banner'></a>
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
  <div class="navbar-collapse collapse navbar-inverse">
    <?php
      nhcs_get_nav( 'nchs-main-menu' );
      nhcs_get_nav( 'nchs-nav-menu', true ); // mobile_only
      echo nchs_search_form( '', 'navbar-form navbar-right collapse' );
    ?>
    <ul class="social-nav nav navbar-nav navbar-right hidden-xs">
      <li>
        <a href="#facebook">
          <i class='fa fa-facebook-square'></i>
        </a>
      </li>
      <li>
        <a href="#twitter">
          <i class='fa fa-twitter-square'></i>
        </a>
      </li>
      <li>
        <a href="#gplus">
          <i class='fa fa-google-plus-square'></i>
        </a>
      </li>
      <li>
        <a href="#pinterest">
          <i class='fa fa-pinterest-square'></i>
        </a>
      </li>
      <li data-toggle="collapse" data-target=".navbar-form">
        <a href="#search">
          <i class="fa fa-search" style='font-size: 26px;'></i>
        </a>
      </li>
    </ul>
  </div>
</div>


<style>
svg {
  width: 26px;
  height: 26px;
}
</style>