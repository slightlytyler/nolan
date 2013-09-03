<?php

get_header(); ?>

<div class='slider_section'>
  <div class='slides'>
    <div class='slide_wrapper'>
      <div class='slide1_title'>
        <h3>Choir</h3>
        Nolan offers a variety of choirs including a Women's choir, Varsity Choir, Nolan 12 Vocal Ensemble, and Viking Singers Vocal Ensemble.
      </div>
      <div class='slide_img'>
        <img src="<?php echo get_template_directory_uri(); ?>/img/slide_1_girl.png" />
      </div>
    </div>
  </div>
</div>

<?php get_template_part('nav'); ?>

    <div class='page'>
      <?php while ( have_posts() ) : the_post(); ?>
      <div class='blog_section'>
        <div class='blog_wrapper'>
          <h3><?php echo the_title() . " - " . types_render_field("coach-position",array('raw'=>true)); ?></h3>
          <?php echo types_render_field("coach-bio",array('raw'=>true)); ?>
        </div>
      </div>
      <?php endwhile; ?>

      <div class='right_sidebar'>
        <div class='calendar_box'>
          <div class='calendar_head'>
            <h4>Football links</h4>
          </div>
          <div class='calendar_body'>
            <div class='calendar_content latest_news_box'>
              <div class='media'>
                <div class='media-body'>
                  <a href='#'>LATEST NEWS</a>
                </div>
              </div>
              <div class='media'>
                <div class='media-body'>
                  <a href='#'>LATEST NEWS</a>
                </div>
              </div>
              <div class='media'>
                <div class='media-body'>
                  <a href='#'>LATEST NEWS</a>
                </div>
              </div>
              <div class='media'>
                <div class='media-body'>
                  <a href='#'>LATEST NEWS</a>
                </div>
              </div>
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
      </div>
      <div class='clear'></div>
    </div>

<?php get_footer(); ?>