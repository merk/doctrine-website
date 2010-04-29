<ul>
  <?php foreach ($sessions as $session): ?>
    <li>
      <span class="date"><strong><?php echo link_to(date('M d', strtotime($session['date_begin'])), (string) $session['url'], 'target=_BLANK'); ?>:</strong></span>
      <span class="city"><?php echo $session['city']; ?></span>
      <span class="title-language">(<?php echo $session['title']; ?> - <?php echo $session['language']; ?>)</span>
    </li>
  <?php endforeach; ?>
</ul>

<p><strong><?php echo link_to('More Trainings', 'http://www.sensiolabs.com/en/training', 'target=_BLANK'); ?></strong></p>