<?php use_helper('Blog', 'Date', 'Text', 'I18N'); ?>

<div class="blog_post">
  <?php echo get_gravatar($blogPost['User']['username'], 'class=gravatar align=right') ?>

  <?php if (!isset($full)): ?>
    <h2><?php echo link_to($blogPost['name'], '@blog_post?slug='.$blogPost['slug']); ?></h2>
  <?php else: ?>
    <h2><?php echo $blogPost['name']; ?></h2>
  <?php endif; ?>

  <div class="tags">
    <strong>Tags:</strong>
    <?php $tags = array() ?> 
    <?php foreach ($blogPost->getTags() as $tag): ?>
      <?php $tags[] = link_to($tag['name'], '@blog_tag?tag='.$tag->slug) ?></li>
    <?php endforeach; ?>
    <?php echo implode(', ', $tags) ?>
  </div>

  <h3><?php echo __('Posted %1% ago', array('%1%' => distance_of_time_in_words(strtotime($blogPost['created_at'])))); ?></h3>

  <p class="body">
    <?php if (isset($full)): ?>
      <?php echo $blogPost['formatted_body']; ?>
    <?php else: ?>
      <?php echo truncate_text(strip_tags($blogPost['formatted_body']), 300); ?> [<?php echo link_to(__('read more'), '@blog_post?slug=' . $blogPost['slug']); ?>] [<?php echo link_to($blogPost['num_comments'] . ' ' . __('Comments'), '@blog_post?slug=' . $blogPost['slug'] . '#comments'); ?>]
    <?php endif; ?>
  </p>
</div>