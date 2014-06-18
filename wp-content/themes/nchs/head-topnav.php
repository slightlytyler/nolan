<div class="navbar navbar-top"><!-- navbar-fixed-top -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
  <div class="navbar-collapse collapse navbar-inverse">
  <a href="/" class='nchs_banner'></a>
    <?php
      nhcs_get_nav( 'nchs-main-menu' );
      nhcs_get_nav( 'nchs-nav-menu', true ); // mobile_only
      echo nchs_search_form( '', 'navbar-form navbar-right' );
    ?>
    <ul class="social-nav nav navbar-nav navbar-right hidden-xs">
      <li class="social-icon">
        <a href="#facebook">
          <span class="fa-stack fa">
            <i class="fa fa-square fa-stack-2x"></i>
            <i class="fa fa-facebook-square fa-stack-2x"></i>
          </span>
        </a>
      </li>
      <li class="social-icon">
        <a href="#twitter">
          <span class="fa-stack fa">
            <i class="fa fa-square fa-stack-2x"></i>
            <i class="fa fa-twitter-square fa-stack-2x"></i>
          </span>
        </a>
      </li>
      <li class="social-icon">
        <a href="#gplus">
           <span class="fa-stack fa">
            <i class="fa fa-square fa-stack-2x"></i>
            <i class="fa fa-google-plus-square fa-stack-2x"></i>
          </span>
        </a>
      </li>
      <li class="social-icon">
        <a href="#pinterest">
           <span class="fa-stack fa">
            <i class="fa fa-square fa-stack-2x"></i>
            <i class="fa fa-pinterest-square fa-stack-2x"></i>
          </span>
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