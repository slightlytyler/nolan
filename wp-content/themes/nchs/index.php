<?php

get_header(); ?>

<?php get_template_part('slider', 'index'); ?>
<?php get_template_part('nav'); ?>

<div class='page'>
      <div class='info_title'>
        <h3>in the marianist tradition since 1961</h3>
      </div>
      <div class='info_section'>
        <?php get_sidebar("homepage-top")?>
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
    <?php get_sidebar('homepage-right'); ?>
    <?php get_sidebar('homepage-middle'); ?>
    <div class='page'>
      <div class='promo_section'>
        <?php get_sidebar('homepage-bottom'); ?>
        <div class='clear'></div>
      </div>
    </div>

<?php get_footer(); ?>

</body>