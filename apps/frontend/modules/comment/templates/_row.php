<?php use_helper('Date', 'I18N'); ?>

<a name="comment_<?php echo $comment->getId(); ?>"></a>
<div class="comment_row" id="comment_<?php echo $comment['id']; ?>">

  <h3>
    <?php echo $comment['subject'] ?>

    <?php echo __('Posted by %1% about %2% ago.', array('%1%' => $comment->poster, '%2%' => distance_of_time_in_words(strtotime($comment['created_at'])))); ?>
  </h3>

  <p class="body"><?php echo DocConverter::renderMarkup($comment['body']); ?></p>

  <?php if ($sf_user->hasCredential('comments')): ?>
    <?php echo link_to(image_tag('/sf/sf_admin/images/delete.png').' Delete', '@delete_comment?id='.$comment['id'], 'confirm=Are you sure?') ?>
  <?php endif; ?>
</div>