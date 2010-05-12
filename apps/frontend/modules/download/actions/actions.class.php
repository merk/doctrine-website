<?php

/**
 * download actions.
 *
 * @package    doctrine_website
 * @subpackage download
 * @author     Jonathan H. Wage
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class downloadActions extends sfActions
{
  public function executeRedirect()
  {
    $this->redirect('@download?slug=orm');
  }

  public function executeIndex(sfWebRequest $request)
  {
    $this->project = Project::getProject($request->getParameter('slug'));
    $this->versions = $this->project->getVersions();

    $this->getResponse()->setTitle('Doctrine - Download '.$this->project->getTitle());
  }

  public function executeVersion_release(sfWebRequest $request)
  {
    $this->project = Project::getProject($request->getParameter('slug'));
    $this->version = $this->project->getVersion($request->getParameter('version'));
    $this->release = $this->version->getRelease($request->getParameter('release'));

    $this->getResponse()->setTitle('Doctrine - Download '.$this->project->getTitle().' ' . $this->release->getSlug());
  }
}
