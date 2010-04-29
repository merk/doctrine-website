<?php
function get_comments($record_id, $record_type)
{
    return get_component('comment', 'comments', array('record_id' => $record_id, 'record_type' => $record_type));
}