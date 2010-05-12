<?php echo get_component('blog', 'tag_cloud'); ?>
<br style="clear: both;" />
<h2>Other Views</h2>
<ul>
  <li id="feed"><?php echo link_to('Blog RSS Feed', '@latest_blog_posts_rss') ?> <?php echo link_to(image_tag('rss-icon.gif'), '@latest_blog_posts_rss', array('style' => 'vertical-align: bottom')); ?></li>
  <li id="archives"><?php echo link_to('Browse Archives', '@blog_archives'); ?></li>
  <li id="most_popular"><?php echo link_to('Most Popular Posts', '@blog_most_popular'); ?></li>
</ul>