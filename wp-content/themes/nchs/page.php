<?php

get_header(); ?>

<div class='slider_section'>
  <?php $image_url = types_render_field( "section-background-image", array('raw' => true)) ?>
  <?php if($image_url !== ''): ?>
  <div class='slides' style="background-image: url('<?php echo $image_url; ?>')">
  <?php else: ?>
  <div class='slides'>
  <?php endif; ?>
    <div class='slide_wrapper'>
      <div class='slide1_title'>
        <h3><?php the_title() ?></h3>
        <?php echo types_render_field("header-subtext") ?>
      </div>
      <div class='slide_img'>
        <?php $slide_img = types_render_field( "section-foreground-image", array( "alt" => "Lorem", "width" => "191", "height" => "254", "proportional" => "true" )); ?>
        <?php if ($slide_img !== ''): ?>
          <?php echo $slide_img; ?>
        <?php else: ?>
          <img src="<?php echo get_template_directory_uri(); ?>/img/slide_1_girl.png" />
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php get_template_part('nav'); ?>

    <div class='page'>
      <?php while ( have_posts() ) : the_post(); ?>
      <div class='blog_section'>
        <div class='blog_wrapper'>
          <h3><?php the_title() ?></h3>
          <?php the_content() ?>
        </div>
      </div>
      <?php endwhile; ?>

      <div class='right_sidebar'>
        <div class='calendar_box'>
          <div class='calendar_head'>
            <h4>CALENDAR</h4>
          </div>
          <div class='calendar_body'>
            <div class='calendar_content'>
              <div class='media'>
                <div class='pull-left'>
                  <div class='date_bg'>
                    <span class='month'>aug</span>
                    <span class='day'>25</span>
                  </div>
                </div>
                <div class='media-body'>
                  <h4 class='media-heading'>Lorem Ipsum Dolor Sit Amet</h4>
                  Doskocil Stadium
                </div>
              </div>
              <div class='media'>
                <div class='pull-left'>
                  <div class='date_bg'>
                    <span class='month'>aug</span>
                    <span class='day'>25</span>
                  </div>
                </div>
                <div class='media-body'>
                  <h4 class='media-heading'>Lorem Ipsum Dolor Sit Amet</h4>
                  Doskocil Stadium
                </div>
              </div>
              <div class='media'>
                <div class='pull-left'>
                  <div class='date_bg'>
                    <span class='month'>aug</span>
                    <span class='day'>25</span>
                  </div>
                </div>
                <div class='media-body'>
                  <h4 class='media-heading'>Lorem Ipsum Dolor Sit Amet</h4>
                  Doskocil Stadium
                </div>
              </div>
              <div class='media'>
                <div class='pull-left'>
                  <div class='date_bg'>
                    <span class='month'>aug</span>
                    <span class='day'>25</span>
                  </div>
                </div>
                <div class='media-body'>
                  <h4 class='media-heading'>Lorem Ipsum Dolor Sit Amet</h4>
                  Doskocil Stadium
                </div>
              </div>
              <div class='media'>
                <div class='pull-left'>
                  <div class='date_bg'>
                    <span class='month'>aug</span>
                    <span class='day'>25</span>
                  </div>
                </div>
                <div class='media-body'>
                  <h4 class='media-heading'>Lorem Ipsum Dolor Sit Amet</h4>
                  Doskocil Stadium
                </div>
              </div>
            </div>
          </div>
          <div class='calendar_footer'>
            <a href='#'>VIEW FULL CALENDAR</a>
          </div>
        </div>
        <div class='promo_card'>
          <div class='promo_img'>
            <img src="<?php echo get_template_directory_uri(); ?>/img/pic_2.jpg" />
          </div>
          <div class='promo_title'>Class of 2017  - Get your Blue On!</div>
          <div class='promo_msg'>
            Lorem ipsum dolor sit amet,sed do eiusmod tempor incididunt ut labore
            <a href='#'>Click Here »</a>
          </div>
        </div>
        <div class='promo_card'>
          <div class='promo_img'>
            <img src="<?php echo get_template_directory_uri(); ?>/img/pic_3.jpg" />
          </div>
          <div class='promo_title'>Become a Partner for Progress</div>
          <div class='promo_msg'>
            Lorem ipsum dolor sit amet,sed do eiusmod tempor incididunt ut labore   ea commodo
            <a class='blue_btn' href='#'>Donate Now »</a>
          </div>
        </div>
        <div class='clear'></div>
      </div>
      <div class='clear'></div>
    </div>

<?php get_footer(); ?>