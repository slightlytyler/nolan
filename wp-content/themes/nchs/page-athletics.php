<?php
/* Template Name: Athletics */
get_header(); ?>

<style type="text/css">
.right_sidebar {
  position: absolute !important;
}
</style>

<div class='slider_section'>
  <?php $image_url = types_render_field( "athletics-background-image", array('raw' => true)) ?>
  <?php if($image_url !== ''): ?>
  <div class='slider_athletic' style="background-image: url('<?php echo $image_url; ?>')">
  <?php else: ?>
  <div class='slider_athletic'>
  <?php endif; ?>
    <div class='slide_wrapper'>
      <div class='slide1_title'>
        <?php $_title = get_the_title(); ?>
        <h3><?php the_title() ?></h3>
        <?php echo types_render_field("athletics-header-subtext", array("raw" => true)) ?>
      </div>
      <div class='slide_img'>
        <?php $slide_img = types_render_field( "athletics-foreground-image", array( "alt" => "Lorem", "width" => "191", "height" => "254", "proportional" => "true" )); ?>
        <?php if ($slide_img !== ''): ?>
          <?php echo $slide_img; ?>
        <?php else: ?>
          <img src="<?php echo get_template_directory_uri(); ?>/img/slide_viking.png" />
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
</div>

<?php get_template_part('nav'); ?>

<?php
global $post;
$slug = get_post( $post )->post_name;
?>

<div class='page'>
      <div class='info_title'>
        <h3>in the marIanist tradition since 1961</h3>
      </div>
    </div>
    <div class='page_header_box'>
      <h2><?php the_title() ?></h2>
    </div>

    <div class='main_section'>
      <?php
      $args = array( 'post_type' => 'news-story', 'posts_per_page' => 3, 'news-category' => $slug );
      $loop = new WP_Query( $args );
      ?>
      <?php if ($loop->have_posts()): ?>
      <div class='page'>
        <h3 class='title_section top_title_mod'>
          Latest News
          <div class='view_more_box'>
            <a href='#'>View More »</a>
          </div>
        </h3>
      </div>
      <div class='lates_news_section'>
        <div class='page'>
          <div class='blog_wrapper'>
            <?php
            $i = 0;

            while ( $loop->have_posts() ) :
              $loop->the_post();
            ?>
            <?php if ($i == 0): ?>
            <div class='main_news'>
              <div class='media'>
                <div class='pull-left'>
                  <?php the_post_thumbnail(array(146, 132)); ?>
                </div>
                <div class='media-body'>
                  <h4 class='media-heading'>
                    <a href='<?php the_permalink(); ?>'><?php the_title(); ?></a>
                  </h4>
                  <div class='post_date'><?php the_time('m.d.y'); ?></div>
                  <?php echo substr(get_the_content(), 0, 288); ?>
                  <a href='<?php the_permalink(); ?>'>Read More »</a>
                </div>
              </div>
            </div>
            <?php else: ?>
              <?php if ($i == 1): ?><div class='sub_news'><?php endif; ?>
              <div class='media'>
                <div class='pull-left'>
                  <?php the_post_thumbnail(array(82, 73)); ?>
                </div>
                <div class='media-body'>
                  <h4 class='media-heading'>
                    <a href='<?php the_permalink(); ?>'><?php the_title(); ?></a>
                  </h4>
                  <div class='post_date'><?php the_time('m.d.y'); ?></div>
                </div>
              </div>
            <?php endif; ?>
            <?php $i++; ?>
            <?php endwhile; ?>
            <?php if ($i > 1): ?></div><?php endif; ?>
          </div>
        </div>
        <div class='clear'></div>
      </div>
      <?php endif; ?>

      <div class='page'>
        <div class='blog_wrapper'>
          <div class='schedule_section'>
            <h3 class='title_section'>
              Schedule
            </h3>
            <table>
              <tr>
                <th>DATE</th>
                <th>TIME</th>
                <th>OPPONENT</th>
                <th>LOCATION</th>
                <th>LEVEL</th>
                <th>RESULTS</th>
              </tr>
              <tr>
                <td>08.15.13</td>
                <td>7:00PM</td>
                <td>Benedictine</td>
                <td>Football Field</td>
                <td>1</td>
                <td>Coming Soon</td>
              </tr>
              <tr>
                <td>08.15.13</td>
                <td>7:00PM</td>
                <td>Benedictine</td>
                <td>Football Field</td>
                <td>1</td>
                <td>Coming Soon</td>
              </tr>
              <tr>
                <td>08.15.13</td>
                <td>7:00PM</td>
                <td>Benedictine</td>
                <td>Football Field</td>
                <td>1</td>
                <td>Coming Soon</td>
              </tr>
              <tr>
                <td>08.15.13</td>
                <td>7:00PM</td>
                <td>Benedictine</td>
                <td>Football Field</td>
                <td>1</td>
                <td>Coming Soon</td>
              </tr>
              <tr>
                <td>08.15.13</td>
                <td>7:00PM</td>
                <td>Benedictine</td>
                <td>Football Field</td>
                <td>1</td>
                <td>Coming Soon</td>
              </tr>
              <tr>
                <td>08.15.13</td>
                <td>7:00PM</td>
                <td>Benedictine</td>
                <td>Football Field</td>
                <td>1</td>
                <td>Coming Soon</td>
              </tr>
              <tr>
                <td>08.15.13</td>
                <td>7:00PM</td>
                <td>Benedictine</td>
                <td>Football Field</td>
                <td>1</td>
                <td>Coming Soon</td>
              </tr>
            </table>
          </div>

          <?php
          $args = array( 'post_type' => 'coach', 'posts_per_page' => -1, 'sport' => $slug );
          $loop = new WP_Query( $args );
          ?>

          <?php if ($loop->have_posts()): ?>
          <div class='coaches_section'>
            <h3 class='title_section'>
              Coaches
              <div class='view_more_box'>
                <a href='<?php echo get_post_type_archive_link( 'coach' ); ?>'>View More »</a>
              </div>
            </h3>
            <div class='coach_slider'>
              <ul class='slides'>
                <?php
                while ( $loop->have_posts() ) :
                  $loop->the_post();
                ?>
                <li>
                  <div class='coach_slider_wrapper'>
                    <div class='coach_slider_img'>
                      <?php echo types_render_field( "coach-picture", array("alt" => get_the_title(), "title" => get_the_title(), "width" => 182, "height" => 195 )) ?>
                    </div>
                    <div class='coach_slider_title'>
                      <a class='coach_name' href='<?php echo get_permalink() ?>'><?php the_title() ?></a>
                      <a class='position' href='<?php echo get_permalink() ?>'><?php echo types_render_field( "coach-position", array() ) ?></a>
                      <a class='more_info' href='<?php echo get_permalink() ?>'>Read Bio »</a>
                    </div>
                  </div>
                </li>
                <?php endwhile; ?>
              </ul>
            </div>
          </div>
          <?php endif; ?>

          <?php
          $args = array( 'post_type' => 'player', 'posts_per_page' => -1, 'sport' => $slug );
          $loop = new WP_Query( $args );
          ?>

          <?php if ($loop->have_posts()): ?>
          <div class='players_section'>
            <h3 class='title_section'>
              Players
              <div class='view_more_box'>
                <a href='<?php echo get_post_type_archive_link( 'player' ); ?>'>View More »</a>
              </div>
            </h3>
            <div class='best_player_box'>
              <img src="<?php echo get_template_directory_uri(); ?>/img/pic_7.jpg" />
              <div class='player_name'>Lorem ipsum Dolor Sit</div>
              <div class='player_position'>
                DEFENSIVE BACK
                <br>
                SOPHOMORE
              </div>
            </div>
            <div class='team_box'>
              <ul class='slides'>
                <?php
                $i = 0;
                
                echo "<li>";
                while ( $loop->have_posts() ) :
                  $loop->the_post();

                  if ($i % 15 == 0 && $i % 2 != 0) {
                    echo "<div class='clear'></div>";
                    echo "</li>";
                    echo "<li>";
                  }
                  
                  echo "<div class='player_pic'><a href='".get_permalink()."'>".types_render_field( "players-picture", array("alt" => get_the_title(), "title" => get_the_title(), "width" => 76, "height" => 81 ))."</a></div>";
  
                  $i++;
                endwhile;
                ?>
                <?php
                if ($i-1 % 15 != 0) {
                  echo "<div class='clear'></div>";
                  echo "</li>";
                }
                ?>
              </ul>
              <div class='clear'></div>
            </div>
          </div>
          <?php endif; ?>

        </div>
        <div class='clear'></div>
      </div>

      <div class='right_sidebar'>
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
      </div>
      <div class='clear'></div>
    </div>

<?php get_footer() ?>