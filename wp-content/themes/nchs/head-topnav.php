<div class="navbar navbar-top"><!-- navbar-fixed-top -->
  <a href="/" class='nchs_banner hidden-xs'></a>
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
        <a href="#shieldLink">
          <!-- <i class="fa fa-search" style='font-size: 26px;'></i> -->
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             viewBox="0 0 400 400" enable-background="new 0 0 400 400" xml:space="preserve">
          <path fill="#fff" d="M26.049,182.74L26.003,26.471h0.09c4.531,2.445,7.014,7.09,9.461,11.613
            c4.496,9.509,13.506,16.506,24.87,16.506c14.907,0,26.988-12.084,26.988-27c0-9.696-5.153-18.197-12.832-22.952h250.971
            c-7.679,4.755-12.767,13.256-12.767,22.952c0,14.915,12.086,27,26.993,27c11.358,0,19.296-8.06,25.412-16.836
            c1.992-2.855,4.689-5.48,8.039-6.819l-0.086,151.804c0,0-4.045,71.052-60.912,130.004c-56.851,58.956-112.646,83.882-112.646,83.882
            S143.804,371.7,86.939,312.744C30.079,253.792,26.049,182.74,26.049,182.74z M276.466,85.686c-3.47,0.558-7.363,0.135-10.995,0.292
            c-1.427,0.729-2.023,1.44-3.019,2.153c-0.159,0.445,0.14,1.02-0.159,1.311c-1.732,1.306,0.731,2.483,0.443,4.061
            c0.877,2.021,4.322,0.423,5.933,1.289c4.328-0.731,6.793,1.155,9.683,2.444c4.193,2.328,7.091,5.504,9.543,10.565v130.122
            l-0.289,0.577l-0.578-0.577L122.791,85.978c-14.03,0.574-28.34-0.157-42.518,0c-2.741,1.152-2.741,3.904-2.595,6.504
            c2.895,4.638,10.986,0.866,14.596,3.751c1.157,0.712,2.037,1.737,2.903,2.754c2.158,1.155,4.908,4.33,6.065,6.197
            c4.338,3.483,5.927,6.97,8.539,10.145l0.132,136.917l-0.275,0.423c-0.162,2.441-1.611,3.618-2.469,5.218
            c-0.429,3.464-4.187,3.31-5.199,5.922c-4.484,3.315-9.842,2.007-13.738,4.756c-2.895-0.132-1.015,3.772-1.581,5.658
            c0.704,0.869-0.151,2.738,1.581,3.178h48.435c2.598,1.138,3.327-1.886,3.896-3.178c0.871-2.882-1.298-3.635-2.021-5.367
            c-6.071-1.869-15.022-3.332-16.331-10.552c-1.875-0.863-0.445-3.613-2.599-4.503V124.125l0.867-0.998l169.582,157.301
            c3.038,0.594,6.356,0.154,8.102-2.155V108.379l1.589-4.193c2.291-3.755,4.776-6.216,8.674-8.107c3.756-3.019,10.404,0,13.153-4.772
            c0-1.711,0.286-3.888-1.171-5.213C305.243,85.552,291.362,86.093,276.466,85.686z"/>
          </svg>
        </a>
      </li>
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