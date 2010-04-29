<ul>
  <li><?php echo link_to('Download', '@download?slug='.$project->getSlug(), array('target' => '_top')) ?></li>
  <li><?php echo link_to('Documentation', '@project_documentation?slug='.$project->getSlug().'&version='.$project->getLatestVersion()->getSlug(), array('target' => '_top')) ?></li>
</ul>