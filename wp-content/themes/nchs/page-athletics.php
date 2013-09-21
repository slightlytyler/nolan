<?php
/* Template Name: Athletics */
get_header(); ?>

<?php 
global $_title; $_title = get_the_title(); 
global $post;
$slug = get_post( $post )->post_name;
?>

	

<div class='page'>
      <div class='info_title'>
        <h3>in the marianist tradition since 1961</h3>
      </div>
    </div>
    <div class='page_header_box'>
      <h2><?php the_title() ?></h2>
    </div>

    <div class='main_section'>
      <?php
      $args = array( 'post_type' => 'post', 'posts_per_page' => 3, 'category_name' => $slug );
      $loop = new WP_Query( $args );
      ?>
      <?php if ($loop->have_posts()): ?>
      <div class='page'>
        <h3 class='title_section top_title_mod'>
          Latest News
          <div class='view_more_box'>
            <a href='<?php echo get_post_type_archive_link( 'post' ); ?>'>View More »</a>
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
                  <?php the_post_thumbnail('nchs-athletics-news-featured'); ?>
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
                  <?php the_post_thumbnail('nchs-athletics-news'); ?>
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
		
	  <?php wp_reset_query(); ?>
      <div class='page lowerhalf'>
        <div class='blog_wrapper'>
	<?php if( has_event_category($slug) || $slug=="athletics") : ?>
          <div class='schedule_section'>
            <h3 class='title_section'>
              Schedule
            </h3>
        <?php /* This date is hardcoded just as an example. Date format must be: m/d/yyyy. Both options are optional. */ ?>
		    <?php echo do_shortcode('[ai1ec view="schedule" from_date="5/16/2010" to_date="10/10/2013" cat_name="'.$slug.'"]'); ?>
          </div>
		<?php endif;?>
          <?php
          $args = array( 'post_type' => 'coach', 'posts_per_page' => -1, 'sport' => $slug );
          $loop = new WP_Query( $args );
          ?>

          <?php if ($loop->have_posts()): ?>
          <div class='coaches_section'>
            <h3 class='title_section'>
              Coaches
              <div class='view_more_box'>
                <?php
                $coach_archive_url = add_query_arg('sport', $slug, get_post_type_archive_link( 'coach' ));
                ?>
                <a href='<?php echo $coach_archive_url; ?>'>View More »</a>
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
                    <?php $url = $coach_archive_url . "#" . get_the_ID(); ?>
                    <div class='coach_slider_title'>
                      <a class='coach_name' href='<?php echo $url; ?>'><?php the_title() ?></a>
                      <a class='position' href='<?php echo $url; ?>'><?php echo types_render_field( "coach-position" ,array('raw'=>true)) ?></a>
                      <a class='more_info' href='<?php echo $url; ?>'>Read Bio »</a>
                    </div>
                  </div>
                </li>
                <?php endwhile; ?>
              </ul>
            </div>
          </div>
          <?php endif; ?>
		  <?php wp_reset_query(); ?>
		
          <?php
          $args = array( 'post_type' => 'player', 'posts_per_page' => -1, 'sport' => $slug );
          $loop = new WP_Query( $args );
          ?>

          <?php if ($loop->have_posts()): ?>
          <div class='players_section'>
            <h3 class='title_section'>
              Players
              <div class='view_more_box'>
                <?php
                $player_archive_url = add_query_arg('sport', $slug, get_post_type_archive_link( 'player' ));
                ?>
                <a href='<?php echo $player_archive_url; ?>'>View More »</a>
              </div>
            </h3>
            <?php
            $i = 0;
            
            while ( $loop->have_posts() ) :
                  $loop->the_post();
            ?>
            <?php if ($i == 0) : ?>
            <div class='best_player_box'>
              <?php echo types_render_field( "players-picture", array("width" => 183, "height" => 257 )) ?>
              <div class='player_name'><?php the_title(); ?></div>
              <div class='player_position'>
                <?php echo types_render_field( "players-position", array()) ?>
              </div>
            </div>
            <div class='team_box'>
              <ul class='slides'>
                <li>
            <?php endif; ?>
                <?php

                  if ($i % 15 == 0 && $i % 2 != 0) {
                    echo "<div class='clear'></div>";
                    echo "</li>";
                    echo "<li>";
                  }
                  
                  echo "<div class='player_pic'><a href='#' data-name='".get_the_title()."' data-position='".types_render_field( "players-position", array())."' data-image='".types_render_field( "players-picture", array("width" => 183, "height" => 257, "raw" => true ))."' onClick='updatePlayerPicture(this); return false;'>".types_render_field( "players-picture", array("alt" => get_the_title(), "title" => get_the_title(), "width" => 76, "height" => 81 ))."</a></div>";
  
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
	  <?php wp_reset_query(); ?>
        </div>
        <div class='clear'></div>
      </div>

      <div class='right_sidebar'>
        <?php get_sidebar("athletics")?>
      </div>
      <div class='clear'></div>
    </div>


    <script type="text/javascript">
    function updatePlayerPicture (element) {
      var name = $(element).data('name');
      var position = $(element).data('position');
      var image = $(element).data('image');
      
      $(".best_player_box .player_name").html(name);
      $(".best_player_box .player_position").html(position);
      $(".best_player_box img").attr('src', image);
    }
    </script>

<?php get_footer() ?>