<?php

get_header(); ?>

<?php get_template_part('slider', 'index'); ?>
<?php get_template_part('nav'); ?>

<div class='page'>
      <div class='info_title'>
        <h3>in the marianist tradition since 1961</h3>
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
    </div>
    <?php get_sidebar('homepage-middle'); ?>
    <div class='page'>
      <div class='promo_section'>
        <?php get_sidebar('homepage-bottom'); ?>
        <div class='clear'></div>
      </div>
    </div>

<?php get_footer(); ?>

</body>