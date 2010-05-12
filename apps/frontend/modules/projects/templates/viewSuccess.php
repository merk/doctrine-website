<?php use_stylesheet('project') ?>

<ul id="breadcrumb_trail">
  <li><?php echo link_to('Home', '@homepage') ?></li>
  <li><?php echo link_to('Projects', '@projects') ?></li>
  <li class="last"><?php echo $project->getTitle() ?></li>
</ul>

<div class="project" id="<?php echo $project->getSlug() ?>">
  <div id="project_content">
    <div id="top">
      <h3><?php echo $project->getTitle() ?></h3>
      <p><?php echo $project->getDescription() ?></p>

      <p>The latest stable version for <strong><?php echo $project->getShortTitle() ?></strong> is <strong><?php echo $project->getLatestVersion() ?></strong> and is in <strong><?php echo $project->getLatestVersion()->getStability() ?></strong> condition.</p>

      <ul>
        <li><?php echo link_to(image_tag('/images/disk.gif') . ' Download Information', '@download?slug='.$project->getSlug()) ?></li>
      </ul>
    </div>

    <div id="versions">
      <ul>
        <?php foreach ($project->getVersions() as $v): ?>
          <li class="version">
            <h3><?php echo link_to('Version '.$v->getSlug(), '@project_documentation?slug='.$project->getSlug().'&version='.$v->getSlug()) ?></h3>
            <ul>
              <?php if ($latestRelease = $v->getLatestRelease()): ?>
                <li><?php echo link_to('Download ' . $latestRelease->getSlug(), '@download_release?slug='.$project->getSlug().'&version='.$v->getSlug() . '&release=' . $latestRelease->getSlug()) ?></li>
              <?php else: ?>
                <li><?php echo link_to('Download ' . $v->getSlug(), '@download?slug='.$project->getSlug().'#'.$v->getSlug()) ?></li>
              <?php endif; ?>
          
              <li><?php echo link_to('Documentation', '@project_documentation?slug='.$project->getSlug().'&version='.$v->getSlug()) ?></li>
              <li><?php echo link_to('Report a Bug', $v->getIssuesLink()) ?></li>
              <li><?php echo link_to('Browse Source', $v->getBrowseSourceLink()) ?></li>
            </ul>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>

<?php echo get_partial('main/help') ?>