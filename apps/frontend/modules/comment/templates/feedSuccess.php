<?php decorate_with(false); ?>
<?php echo urldecode(str_replace('/chapter/', '?chapter=', $feed->asXml())) ?>