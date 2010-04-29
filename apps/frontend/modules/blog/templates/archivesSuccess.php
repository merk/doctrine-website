<?php use_stylesheet('blog') ?>
<?php use_helper('I18N'); ?>

<ul id="breadcrumb_trail">
  <li><?php echo link_to('Home', '@homepage', 'class=cms_page_navigation'); ?></li>
  <li><?php echo link_to('Blog', '@blog', 'class=cms_page_navigation'); ?></li>
  <li class="last"><?php echo __('Archives'); ?></li>
</ul>

<ul id="blog-archives">
  <?php foreach ($archives as $month => $posts): ?>
    <li>
      <a name="<?php echo Doctrine_Inflector::urlize($month); ?>"></a>
      <?php echo __($month); ?>
      <ul>
        <?php foreach ($posts as $post): ?>
          <li><span class="day"><?php echo date('jS', strtotime($post['created_at'])); ?> </span><?php echo link_to($post['name'], '@blog_post?id=' . $post['id'] . '&slug=' . $post['slug']); ?> [<?php echo link_to($post['num_comments'] . ' Comments', $post->getRecordRoute() . '#comments'); ?>]</li>
        <?php endforeach; ?>
      </ul>
    </li>
  <?php endforeach; ?>
</ul>

<?php slot('right'); ?>
  <h2>Archives</h2>
  <ul>
    <?php foreach ($archives as $month => $posts): ?>
      <li><?php echo link_to(__($month) . ' (' . count($posts) . ')', '@blog_archives#' . Doctrine_Inflector::urlize($month)); ?></li>
    <?php endforeach; ?>
  </ul>
<?php end_slot(); ?>