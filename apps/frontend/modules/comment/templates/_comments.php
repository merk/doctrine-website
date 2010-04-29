<?php $commentsId = 'comments_'.$record_id.'_'.$record_type; ?>
<?php $addId = 'add_'.$record_id.'_'.$record_type; ?>

<div class="comments" id="<?php echo $commentsId; ?>">
    <?php echo get_component('comment', 'comments_list', array('comments' => $comments, 'record_id' => $record_id, 'record_type' => $record_type)); ?>
</div>

<?php echo get_component('comment', 'create', array('record_id' => $record_id, 'record_type' => $record_type)); ?>