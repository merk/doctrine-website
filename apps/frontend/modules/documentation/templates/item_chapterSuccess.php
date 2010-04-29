<?php slot('top1') ?>
  <?php echo get_partial('documentation/version_menu', array(
    'version' => $version,
    'project' => $project
  )) ?>
<?php end_slot() ?>

<?php use_helper('Documentation') ?>

<ul id="breadcrumb_trail">
  <li><?php echo link_to('Home', '@homepage') ?></li>
  <li><?php echo link_to('Projects', '@projects') ?></li>
  <li><?php echo link_to($project->getTitle(), $project->getRoute()) ?></li>
  <li><?php echo link_to('Documentation', '@project_documentation?slug='.$project->getSlug().'&version='.$sf_request->getParameter('version')) ?></li>
  <li><?php echo link_to($documentationItem->getTitle(), '@project_documentation_item?slug='.$project->getSlug().'&version='.$sf_request->getParameter('version').'&item='.$documentationItem->getSlug()) ?></li>
  <li class="last"><?php echo $renderer->getOption('section')->getName() ?></li>
</ul>


<div id="documentation">
  <?php echo get_partial('documentation/next_prev', array('renderer' => $renderer)) ?>

  <?php echo $renderer->render() ?>

  <?php echo get_partial('documentation/next_prev', array('renderer' => $renderer)) ?>

  <?php echo get_partial('main/help') ?>
</div>

<?php slot('right') ?>
  <h2>Table of Contents</h2>
  <ul class="tree">
    <?php echo $renderer->renderToc() ?>
  </ul>
<?php end_slot() ?>