<?php
  global $post;
  $slug = get_post( $post )->post_name;
  ?> 
<div class='right_sidebar'>
<ul class="widgets">
<li>   
 <div class='calendar_box'>
      <div class='calendar_head'>
        <h4>CALENDAR</h4>
      </div>
      <div class='calendar_body'>
        <div class='calendar_content'>
          <?php echo do_shortcode('[ai1ec view="agenda" cat_name="'.$slug.'"]'); ?>
        </div>
      </div>
      <div class='calendar_footer'>
        <a href='#'>VIEW FULL CALENDAR</a>
      </div>
    </div>

</li>	
<?php
if ( !dynamic_sidebar( 'page-right-widget-area' ) ) {}
?>
</ul>
</div>

