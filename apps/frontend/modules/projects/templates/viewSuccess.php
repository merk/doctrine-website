<?php use_stylesheet('project') ?>

<ul id="breadcrumb_trail">
  <li><?php echo link_to('Home', '@homepage') ?></li>
  <li><?php echo link_to('Projects', '@projects') ?></li>
  <li class="last"><?php echo $project->getTitle() ?></li>
</ul>

<div class="project" id="<?php echo $project->getSlug() ?>">
  <div id="project_content">
    <h3><?php echo $project->getTitle() ?></h3>
    <p><?php echo $project->getDescription() ?></p>

    <p>The latest stable version for <strong><?php echo $project->getShortTitle() ?></strong> is <strong><?php echo $project->getLatestVersion() ?></strong> and is in <strong><?php echo $project->getLatestVersion()->getStability() ?></strong> condition.</p>

    <ul>
      <li><strong><?php echo link_to(image_tag('/images/disk.gif') . ' Download Information', '@download?slug='.$project->getSlug()) ?></strong></li>
    </ul>

    <h3>Versions</h3>
    <ul>
      <?php foreach ($project->getVersions() as $v): ?>
        <li>
          <strong><?php echo link_to($v->getSlug(), '@project_documentation?slug='.$project->getSlug().'&version='.$v->getSlug()) ?></strong>
          <ul>
            <?php if ($latestRelease = $v->getLatestRelease()): ?>
              <li><strong><?php echo link_to('Download ' . $latestRelease->getSlug(), '@download_release?slug='.$project->getSlug().'&version='.$v->getSlug() . '&release=' . $latestRelease->getSlug()) ?></strong></li>
            <?php else: ?>
              <li><strong><?php echo link_to('Download ' . $v->getSlug(), '@download?slug='.$project->getSlug().'#'.$v->getSlug()) ?></strong></li>
            <?php endif; ?>
          
            <li><strong><?php echo link_to('Documentation', '@project_documentation?slug='.$project->getSlug().'&version='.$v->getSlug()) ?></strong></li>
            <li><strong><?php echo link_to('Report a Bug', $v->getIssuesLink()) ?></strong></li>
            <li><strong><?php echo link_to('Browse Source', $v->getBrowseSourceLink()) ?></strong></li>
          </ul>
        </li>
      <?php endforeach; ?>
    </ul>

  </div>
</div>

<?php echo get_partial('main/help') ?>