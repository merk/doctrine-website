You are currently reading the <strong><?php echo $version->getSlug() ?></strong> documentation.

<?php if ($versions = $version->getOtherVersions()): ?>
  Switch to 
  <?php foreach ($versions as $otherVersion): ?>
    <?php echo link_to($otherVersion->getSlug(), '@project_documentation?slug='.$project->getSlug().'&version='.$otherVersion->getSlug()) ?>&nbsp;
  <?php endforeach; ?>
<?php endif; ?>