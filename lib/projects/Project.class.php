<?php

class Project
{
  public $slug;

  public static $projects;

  public function __construct($slug)
  {
    $projects = self::getProjectsData();
    if ( ! isset($projects[$slug]))
    {
      throw new InvalidArgumentException(
        sprintf('Could not find project with slug "%s"', $slug)
      );
    }
    $this->data = $projects[$slug];
  }

  public function getVersion($slug)
  {
    if ( ! isset($this->data['versions'][$slug]))
    {
      return false;
    }
    $version = $this->data['versions'][$slug];
    $version['slug'] = $slug;
    return new ProjectVersion($this, $version);
  }

  public function getVersions()
  {
    $versions = array();
    foreach (array_reverse($this->data['versions']) as $slug => $version)
    {
      $version['slug'] = $slug;
      $versions[$slug] = new ProjectVersion($this, $version);
    }
    return $versions;
  }

  public static function getAllProjects()
  {
    $projects = array();
    foreach (array_keys(self::getProjectsData()) as $slug)
    {
      $projects[] = self::getProject($slug);
    }
    return $projects;
  }

  public static function getPrimaryProjects()
  {
    $projects = array();
    foreach (array_keys(self::getProjectsData()) as $slug)
    {
      $project = self::getProject($slug);
      if ($project->isPrimary()) {
        $projects[] = $project;
      }
    }
    return $projects;
  }

  public static function getProject($slug)
  {
    try {
      return new self($slug);
    } catch (InvalidArgumentException $e) {
      return false;
    }
  }

  public function isPrimary()
  {
    return isset($this->data['is_primary']) && $this->data['is_primary'] ? true : false;
  }

  public function getRoute()
  {
    return '@project?slug='.$this->getSlug();
  }

  public function getSlug()
  {
    return $this->data['slug'];
  }

  public function getTitle()
  {
    return $this->data['title'];
  }

  public function getShortTitle()
  {
    return $this->data['short_title'];
  }

  public function getDescription()
  {
    return $this->data['description'];
  }

  public function getNamespace()
  {
    return $this->data['namespace'];
  }

  public function getIssuesLink()
  {
    return $this->getLatestVersion()->getIssuesLink();
  }

  public function getLatestVersion()
  {
    return $this->getVersion($this->data['latest_version']);
  }

  public static function exists($slug)
  {
    $projects = self::getProjectsData();
    return isset($projects[$slug]) ? true : false;
  }

  public static function getProjectsData()
  {
    if (!self::$projects)
    {
      self::$projects = sfYaml::load(sfConfig::get('sf_config_dir').'/projects.yml');
    }
    return self::$projects;
  }
}