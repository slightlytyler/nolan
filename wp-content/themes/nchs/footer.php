    <!-- <div class='clearfix'></div> -->
<?php if(!is_single() && !is_home()) : ?>
</div>
<?php endif;?>
<div class='clearfix'></div>
<div class='footer'>
    <div class='col-sm-4 contact_us_box'>
        <div class='footer_title'>Contact Us</div>
        <div class='contact_us_text'>
            Nolan Catholic High School
            <br>4501 Bridge Street, Fort Worth, Texas 76103-1198
        </div>
        <a class='contact_us_email' href='mailto:email@gmail.com'>Send an Email</a>
        <div class='contact_us_phone'>817.457.2920</div>
    </div>
    <div class='col-sm-4 subscribe_box'>
        <div class='footer_title'>Be on our mailing list</div>
        <div class='subscribe_text'>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
        </div>
        <form action='#' class='subscribe_form_footer form-inline' method='post'>
            <input class='subscribe_field input-medium' placeholder='' type='text' value=''>
            <button class='btn-search black_btn' type='submit'>Sign Up</button>
        </form>
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

<script src='http://code.jquery.com/jquery-1.9.1.js'></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<!-- <script src='http://code.jquery.com/ui/1.10.3/jquery-ui.js'></script> -->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/libs/jquery.flexslider.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>
<!-- end scripts -->
<?php wp_footer(); ?>
</body>

</html>