<?php use_stylesheet('blog') ?>
<?php use_helper('Date', 'I18N'); ?>

<ul id="breadcrumb_trail">
  <li><?php echo link_to(__('Home'), '@homepage', 'class=cms_page_navigation'); ?></li>
  <li><?php echo link_to(__('Blog'), '@blog', 'class=cms_page_navigation'); ?></li>
  <li class="last"><?php echo $blogPost['name']; ?></li>
</ul>

<?php if (isset($navigation['prev'])): ?>
  <?php slot('top1_left') ?>
    <?php echo link_to('<< ' . $navigation['prev']->getName(), $navigation['prev']->getRoute()); ?>
  <?php end_slot() ?>
<?php endif; ?>

<?php if (isset($navigation['next'])): ?>
  <?php slot('top1_right') ?>
    <?php echo link_to($navigation['next']->getName() . ' >>', $navigation['next']->getRoute()); ?>
  <?php end_slot() ?>
<?php endif; ?>

<?php echo get_partial('post_row', array('blogPost' => $blogPost, 'full' => true)); ?>

<br/>
<a name="comments"></a>
<?php echo get_component('comment', 'comments', array('record_id' => $blogPost['id'], 'record_type' => 'BlogPost')) ?>

<?php slot('right'); ?>
  <?php echo get_partial('blog/sidebar') ?>
<?php end_slot(); ?>