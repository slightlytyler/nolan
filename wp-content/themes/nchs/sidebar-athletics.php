<div class='calendar_box'>
  <div class='calendar_head'>
    <h4><?php echo $_title ?> links</h4>
  </div>
  <div class='calendar_body'>
    <div class='calendar_content latest_news_box'>
      <?php
        wp_list_bookmarks(array(
          'category_name' => $slug,
          'categorize'    => false,
          'title_li'      => '',
          'before'        => '<div class="media"><div class="media-body">',
          'after'         => '</div></div>'
        ));
      ?>
      <div class='facebook_link'></div>
    </div>
    <div class='hchs_watermark_icon'></div>
    <div class='calendar_content state_champ_box'>
      <h4>State champions</h4>
      <div class='dates_box'>
        <a href='#'>1985</a>
        -
        <a href='#'>1992</a>
        -
        <a href='#'>1997</a>
        -
        <a href='#'>1999</a>
        <a href='#'>2000</a>
        -
        <a href='#'>2005</a>
        -
        <a href='#'>2006</a>
        -
        <a href='#'>2008</a>
        <a href='#'>2010</a>
        -
        <a href='#'>2012</a>
      </div>
    </div>
    <div class='calendar_content'>
      <div class='promo_card'>
        <div class='promo_img'>
          <img src="<?php echo get_template_directory_uri(); ?>/img/pic_2.jpg" />
        </div>
        <div class='promo_title'>Class of 2017  - Get your Blue On!</div>
        <div class='promo_msg'>
          Lorem ipsum dolor sit amet,sed do eiusmod tempor incididunt ut labore
          <a href='#'>Click Here »</a>
        </div>
        <div class='clear'></div>
      </div>
    </div>
  </div>
  <div class='calendar_footer'></div>
</div>
<div class='clear'></div>