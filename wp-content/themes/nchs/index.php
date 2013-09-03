<?php

get_header(); ?>

<?php get_template_part('slider', 'index'); ?>
<?php get_template_part('nav'); ?>

<div class='page'>
      <div class='info_title'>
        <h3>in the marIanist tradition since 1961</h3>
      </div>
      <div class='info_section'>
        <div class='info_video'>
          <div class='info_video_wrapprer'>
            <iframe allowfullscreen='' frameborder='0' mozallowfullscreen='' src='http://player.vimeo.com/video/59438095?title=0&amp;byline=0&amp;portrait=0' webkitallowfullscreen=''></iframe>
          </div>
        </div>

        <?php
        $args = array( 'post_type' => 'post', 'posts_per_page' => 3, 'tag' => 'homepage' );
        $loop = new WP_Query( $args );
        ?>

        <?php if ($loop->have_posts()): ?>
        <div class='info_news'>
            <div class='info_news_title'>Latest News</div>
          <?php
          while ( $loop->have_posts() ) :
            $loop->the_post();
          ?>
          <div class='media'>
            <a class='pull-left' href='#'>
              <?php the_post_thumbnail('nchs-index-latest-news-thumb'); ?>
            </a>
            <div class='media-body'>
              <h4 class='media-heading'>
                <a href='<?php the_permalink(); ?>'><?php the_title(); ?></a>
              </h4>
              <div class='news_date'><?php the_time('D M j'); ?></div>
            </div>
          </div>
          <?php endwhile; ?>
        </div>
        <?php endif; ?>
        <div class='clear'></div>
      </div>
    </div>
    <div class='calendar_section'>
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
    </div><div class='mission_section'>
      <div class='mission_head'>
        <div class='page'>
          <div class='mission_title'>
            <div class='mission_arrow'></div>
            <h3>THE nolan catholic Mission</h3>
          </div>
        </div>
      </div>
      <div class='mission_body'>
        <div class='page'>
          <div class='mission_txt'>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            </p>
            <p>
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <div class='blue_btn'>Read More</div>
          </div>
        </div>
      </div>
    </div>
    <div class='page'>
      <div class='promo_section'>
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
    </div>

<?php get_footer(); ?>

</body>