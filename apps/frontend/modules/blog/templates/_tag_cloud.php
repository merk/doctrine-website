<?php use_helper('Blog'); ?>

<h2>Popular Tags</h2>

<div id="tag_cloud">
  <?php echo build_tag_cloud($tags); ?>
</div>