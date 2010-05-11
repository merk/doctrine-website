<?php

class ProjectVersion
{
  public $project;
  public $data;

  public function __construct($project, $data)
  {
    $this->project = $project;
    $this->data = $data;
  }

  public function getOtherVersions()
  {
    $versions = $this->project->getVersions();
    foreach ($versions as $key => $version)
    {
      if ($version->getSlug() === $this->getSlug())
      {
        unset($versions[$key]);
      }
    }
    return $versions;
  }

  public function getProject()
  {
    return $this->project;
  }

  public function getSvnCheckoutCommand()
  {
    return isset($this->data['svn_checkout_command']) ? $this->data['svn_checkout_command'] : null;
  }

  public function getGitCheckoutCommand()
  {
    return isset($this->data['git_checkout_command']) ? $this->data['git_checkout_command'] : null;
  }

  public function getSlug()
  {
    return $this->data['slug'];
  }

  public function getIssuesLink()
  {
    return $this->data['issues_link'];
  }

  public function getStability()
  {
    return isset($this->data['stability']) ? $this->data['stability'] : 'alpha';
  }

  public function getApiSourcePath()
  {
      return isset($this->data['api_source_path']) ? $this->data['api_source_path'] : null;
  }

  public function getDocumentationItems()
  {
    $items = array();
    if (isset($this->data['documentation_items']))
    {
      foreach ($this->data['documentation_items'] as $item => $data)
      {
        $items[$item] = new DocumentationItem($this, $data);
      }
    }
    return $items;
  }

  public function getDocumentationItem($item)
  {
    return new DocumentationItem($this, $this->data['documentation_items'][$item]);
  }

  public function getRelease($slug)
  {
    $release = $this->data['releases'][$slug];
    $release['slug'] = $slug;
    return new ProjectVersionRelease($this, $release);
  }

  public function getReleases()
  {
    $releases = array();
    if (isset($this->data['releases']))
    {
      foreach (array_reverse($this->data['releases']) as $slug => $release)
      {
        $release['slug'] = $slug;
        $releases[$slug] = new ProjectVersionRelease($this, $release);
      }
    }
    return $releases;
  }

  public function getLatestRelease()
  {
    return current($this->getReleases());
  }

  public function getBrowseSourceLink()
  {
    return $this->data['browse_source_link'];
  }

  public function __toString()
  {
    return $this->getSlug();
  }
}