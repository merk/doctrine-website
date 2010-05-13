<?php use_helper('Blog', 'Date', 'Text'); ?>

<div class="blog_post">
  <?php echo get_gravatar($blogPost['User']['email_address'], array('class' => 'gravatar', 'align' => 'right')) ?>

  <?php if (!isset($full)): ?>
    <h2><?php echo link_to($blogPost['name'], '@blog_post?slug='.$blogPost['slug']); ?></h2>
  <?php else: ?>
    <h2><?php echo $blogPost['name']; ?></h2>
  <?php endif; ?>

  <?php $tags = array() ?> 
  <?php foreach ($blogPost->getTags() as $tag): ?>
    <?php $tags[strtolower($tag['name'])] = link_to($tag['name'], '@blog_tag?tag='.$tag->slug) ?></li>
  <?php endforeach; ?>
  <?php if ($tags): ?>
    <div class="tags">
      <strong>Tags:</strong>
      <?php echo implode(', ', $tags) ?>
    </div>
  <?php endif; ?>

  <p><strong><?php echo 'Posted ' . distance_of_time_in_words(strtotime($blogPost['created_at'])) . ' ago by '.current(explode('@', $blogPost['User'])); ?></strong></p>

  <p class="body">
    <?php if (isset($full)): ?>
      <?php echo $blogPost['formatted_body']; ?>
    <?php else: ?>
      <?php echo truncate_text(strip_tags($blogPost['formatted_body']), 300); ?> [<?php echo link_to('read more', '@blog_post?slug=' . $blogPost['slug']); ?>] [<?php echo link_to($blogPost['num_comments'] . ' ' . 'Comments', '@blog_post?slug=' . $blogPost['slug'] . '#comments'); ?>]
    <?php endif; ?>
  </p>
</div>