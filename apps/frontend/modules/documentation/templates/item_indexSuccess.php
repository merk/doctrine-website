<?php use_stylesheet('documentation_item_index') ?>

<?php slot('top1') ?>
  <?php echo get_partial('documentation/version_menu', array(
    'version' => $version,
    'project' => $project
  )) ?>
<?php end_slot() ?>

<ul id="breadcrumb_trail">
  <li><?php echo link_to('Home', '@homepage') ?></li>
  <li><?php echo link_to('Projects', '@projects') ?></li>
  <li><?php echo link_to($project->getTitle(), $project->getRoute()) ?></li>
  <li><?php echo link_to('Documentation', '@project_documentation?slug='.$project->getSlug().'&version='.$sf_request->getParameter('version')) ?></li>
  <li class="last"><?php echo $documentationItem->getTitle() ?></li>
</ul>

<div id="documentation">
  <?php if ($toc = $renderer->renderMainToc()): ?>
    <h2><?php echo $documentationItem->getTitle() ?> Table of Contents</h2>

    <p><?php echo $documentationItem->getDescription() ?></p>

    <ul>
      <?php echo $renderer->renderMainToc() ?>
    </ul>
  <?php else: ?>
    <h1><?php echo $documentationItem->getTitle() ?> coming soon...</h1>
  <?php endif; ?>

  <?php if ($coverImage = $documentationItem->getCoverImage()): ?>
    <?php echo link_to(image_tag($coverImage, 'id="cover_image"'), $documentationItem->getPurchaseLink()) ?>
  <?php endif; ?>

  <?php echo get_partial('main/help') ?>
</div>