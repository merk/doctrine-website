<div id="documentation">
  <?php foreach ($projects as $project) :?>
    <?php if ($documentationItems = $project->getLatestVersion()->getDocumentationItems()): ?>

      <h2><?php echo link_to($project->getTitle().' Documentation', '@project_documentation?slug='.$project->getSlug().'&version='.$project->getLatestVersion()->getSlug()) ?></h2>

      <ul>
        <?php foreach ($documentationItems as $documentationItem): ?>
          <li>
            <strong><?php echo link_to($documentationItem->getTitle(), $documentationItem->getRoute()) ?></strong>
            <p><?php echo $documentationItem->getDescription() ?></p>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  <?php endforeach; ?>
  <?php echo get_partial('main/help') ?>
</div>