<?php
global $slug;
global $_title;
?>
<div class='calendar_box'>
  <?php
  $bookmarks = get_bookmarks( array(
    'category_name'  => $slug
    )
  );
  ?>
  <?php if (!empty($bookmarks)) : ?>
  <div class='calendar_head'>
    <h4><?php echo $_title ?> links</h4>
  </div>
  <div class='calendar_body'>
  <div class='calendar_content latest_news_box'>
    <?php
    foreach ($bookmarks as $bookmark) {
      echo '<div class="media"><div class="media-body">';
      echo '<a href="'.$bookmark->link_url.'">'.$bookmark->link_name.'</a>';
      echo '</div></div>';
    }
    ?>
    <div class='facebook_link'></div>
  </div>
  <?php else: ?>
  <div class='calendar_body'>
  <?php endif;?>
    <div class='hchs_watermark_icon'></div>
    <?php
    if ( !dynamic_sidebar( 'athletics-right-widget-area' ) ) {}
    ?>
  </div>
  <div class='calendar_footer'></div>
</div>
<div class='clear'></div>