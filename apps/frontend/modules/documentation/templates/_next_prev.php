<div class="chapter-nav">
  <?php if ($prevHtml = get_prev($renderer)): ?>
    <div class="previous">
      <?php echo $prevHtml ?>
    </div>
  <?php endif; ?>

  <?php if ($nextLink = get_next($renderer)): ?>
    <div class="next">
      <?php echo $nextLink ?>
    </div>
  <?php endif; ?>
</div>