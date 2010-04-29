<?php

class ProjectVersionRelease
{
  public $version;
  public $data;

  public function __construct($version, $data)
  {
    $this->version = $version;
    $this->data = $data;
  }

  public function getSlug()
  {
    return $this->data['slug'];
  }

  public function getPackageLink()
  {
    return 'http://www.doctrine-project.org/downloads/'.$this->getPackageName();
  }

  public function getPackageName()
  {
    return $this->data['package_name'];
  }

  public function getSvnCheckoutCommand()
  {
    return isset($this->data['svn_checkout_command']) ? $this->data['svn_checkout_command'] : null;
  }

  public function getGitCheckoutCommand()
  {
    return isset($this->data['git_checkout_command']) ? $this->data['git_checkout_command'] : null;
  }

  public function canBePearInstalled()
  {
    return isset($this->data['pear_install_command']) ? true : false;
  }

  public function getPearInstallCommand()
  {
    return $this->data['pear_install_command'];
  }
}