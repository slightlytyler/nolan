  <!-- <div class='clearfix'></div> -->
<div class='clearfix'></div>
<div class='footer'>
  <div class='col-sm-4 contact_us_box'>
    <h4>Contact Us</h4>
    <div class='contact_us_text'>
      Nolan Catholic High School
      <br>4501 Bridge Street, Fort Worth, Texas 76103-1198
    </div>
    <a class='contact_us_email' href='mailto:email@gmail.com'><i class='fa fa-envelope'></i> Send an Email</a>
    <div class='contact_us_phone'><i class='fa fa-phone'></i> 817.457.2920</div>
  </div>
  <div class='col-sm-4 subscribe_box'>
    <h4>Join our mailing list</h4>
    <div class='subscribe_text'>
      <?php the_field( 'subscribe_text', 'options' )?>
    </div>
    <div class="input-group">
      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
      <span class="input-group-btn">
        <button class="btn btn-success" type="button">Sign Up</button>
      </span>
    </div>
  </div>
  <div class='col-sm-4 copyrights_box'>
    2013 Nolan Catholic High School
    <br>All Rights Reserved.
    <br>
    <a href='#'>Privacy Policy</a>
    <span class='copyrights_box_divider'></span>
    <a href='#'>Terms of Use</a>
    <div class='clear'></div>
  </div>
  <div class='clearfix'></div>
</div>

<!-- JavaScript at the bottom for fast page loading -->
<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
<!-- <script src='http://code.jquery.com/jquery-1.9.1.js'></script> -->

<script src='/wp-includes/js/jquery/jquery.js'></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<!-- <script src='http://code.jquery.com/ui/1.10.3/jquery-ui.js'></script> -->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/libs/jquery.flexslider.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
<!-- end scripts -->
<?php
wp_footer();
if( is_page_template('page-table.php') ) {
  nhcs_the_transient_json( get_field("spreadsheet_id") );
}
?>
</body>
</html>