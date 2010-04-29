<li class="project" id="<?php echo $project->getSlug() ?>">
  <h3><?php echo link_to($project->getTitle(), '@project?slug='.$project->getSlug()) ?></h3>
  <p><?php echo $project->getDescription() ?></p>

  <ul>
    <li><?php echo link_to('Issues', $project->getIssuesLink()) ?></li>
    <li><?php echo link_to('Documentation', '@project_documentation?slug='.$project->getSlug().'&version='.$project->getLatestVersion()->getSlug()) ?></li>
    <li><?php echo link_to('Download', '@download?slug='.$project->getSlug()) ?></li>
  </ul>
</li>