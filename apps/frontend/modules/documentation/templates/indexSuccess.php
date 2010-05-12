<?php use_stylesheet('documentation_index') ?>

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
  <li class="last">Documentation</li>
</ul>

<div id="documentation">
  <h1><?php echo $project->getTitle() ?> Documentation (<?php echo $version->getSlug() ?>)</h1>

  <p><?php echo $project->getDescription() ?></p>

  <ul>
    <?php foreach ($documentationItems as $documentationItem): ?>
      <li>
        <?php if ($icon = $documentationItem->getIcon()): ?>
          <?php echo image_tag($icon, 'class=icon') ?>
        <?php endif; ?>

        <strong><?php echo link_to($documentationItem->getTitle(), $documentationItem->getRoute()) ?></strong>
        <p><?php echo $documentationItem->getDescription() ?></p>
        
        <ul>
          <?php if ($toc = $documentationItem->getTableOfContents($sf_request->getParameter('sf_culture'), $sf_user)): ?>
            <?php $firstChapter = $toc->findByIndex(1) ?>
            <li><?php echo link_to('Start reading ' . $firstChapter->getName(), '@project_documentation_item_chapter?slug='.$project->getSlug().'&version='.$version->getSlug().'&item='.$documentationItem->getSlug().'&chapter='.$firstChapter->getPath()) ?>
          <?php endif; ?>

          <?php if ($purchaseLink = $documentationItem->getPurchaseLink()): ?>
            <li><?php echo link_to('Buy printed version', $purchaseLink) ?></li>
          <?php endif; ?>
        </ul>
        <?php if ($coverImage = $documentationItem->getCoverImage()): ?>
          <?php echo link_to(image_tag($coverImage), $purchaseLink, 'class=cover_image target=_BLANK') ?>
        <?php endif; ?>
        <?php if (isset($toc) && $toc): ?>
          <?php echo image_tag('pdf.gif') ?> PDF Coming Soon</li>
        <?php endif; ?>
      </li>
    <?php endforeach; ?>
  </ul>

  <?php echo get_partial('main/help') ?>
</div>