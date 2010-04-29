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
  <h2><?php echo $documentationItem->getTitle() ?> Table of Contents</h2>

  <p><?php echo $documentationItem->getDescription() ?></p>

  <ul>
    <?php echo $renderer->renderMainToc() ?>
  </ul>

  <?php echo image_tag($documentationItem->getCoverImage(), 'id="cover_image"') ?>

  <?php echo get_partial('main/help') ?>
</div>