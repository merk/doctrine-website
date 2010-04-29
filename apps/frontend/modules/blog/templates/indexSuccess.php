<?php use_stylesheet('blog') ?>
<?php use_helper('Date', 'Text', 'I18N'); ?>

<ul id="breadcrumb_trail">
  <li><?php echo link_to(__('Home'), '@homepage', 'class=cms_page_navigation'); ?></li>
  <li class="last"><?php echo __('Blog'); ?></li>
</ul>

<?php if ($sf_request->hasParameter('tag')): ?>
  <?php slot('top1') ?>
    Found <strong><?php echo count($blogPosts) ?></strong> blog posts with the tag <strong>"<?php echo $tag->getName() ?>"</strong>
  <?php end_slot() ?>
<?php endif; ?>

<div id="blog">  
  <?php foreach($blogPosts AS $blogPost): ?>
    <?php echo get_partial('post_row', array('blogPost' => $blogPost)); ?>
  <?php endforeach; ?>
</div>

<?php slot('right'); ?>
  <?php echo get_partial('blog/sidebar') ?>
<?php end_slot(); ?>