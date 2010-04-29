<h4>You have chose to comment on the "<?php echo $values['record_type'] ?>" named "<?php echo $record ?>" but an error occured during trying to save the comment. Correct the errors below and try again!</h4>

<?php echo get_component('comment', 'create', array('record_id' => $comment->record_id, 'record_type' => $comment->record_type)); ?>