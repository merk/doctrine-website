<?php

class DoctrineUpdateDocumentationTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('project', null, sfCommandOption::PARAMETER_REQUIRED, 'The project slug'),
    ));

    $this->namespace        = 'doctrine';
    $this->name             = 'update-docs';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [doctrine:update-docs|INFO] task updates the website documentation.
Call it with:

  [php symfony doctrine:update-docs|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    foreach (Project::getAllProjects() as $project)
    {
      if (isset($options['project']) && $options['project'] != $project->getSlug()) {
        continue;
      }

      foreach ($project->getVersions() as $version)
      {
        foreach ($version->getDocumentationItems() as $documentationItem)
        {
          $command = $documentationItem->getUpdateCommand();
          $this->logSection($project->getSlug(), $command);
          if ($documentationItem->update())
          {
            $this->logSection($project->getSlug(), 'Updated ' . $documentationItem->getTitle());
          }
        }
      }
    }
  }
}
