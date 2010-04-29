<?php use_helper('I18N'); ?>

<h2><?php echo __('Comments'); ?> (<?php echo $comments->count(); ?>) [ <a href="#add_comment"><?php echo __('add comment'); ?></a> ]</h2>

<?php if ($comments->count() > 0): ?>
  <?php foreach ($comments as $comment): ?>
    <?php echo get_partial('comment/row', array('comment' => $comment)); ?>
  <?php endforeach; ?>
<?php else: ?>
  <p><strong><?php echo __('No Comments'); ?></strong></p>
<?php endif; ?>