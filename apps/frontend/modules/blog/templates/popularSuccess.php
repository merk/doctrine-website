<h1>Most Popular Blog Posts</h1>

<?php foreach($blogPosts AS $blogPost): ?>
  <?php echo get_partial('post_row', array('blogPost' => $blogPost)); ?>
<?php endforeach; ?>

<?php slot('right'); ?>
  <?php echo get_partial('blog/sidebar') ?>
<?php end_slot(); ?>