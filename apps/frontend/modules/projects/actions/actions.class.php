<?php

/**
 * projects actions.
 *
 * @package    doctrine_website
 * @subpackage projects
 * @author     Jonathan H. Wage
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class projectsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->getResponse()->setTitle('Doctrine - Projects');

    $this->projects = Project::getAllProjects();
  }

  public function executeView(sfWebRequest $request)
  {
    $this->project = Project::getProject($request->getParameter('slug'));

    $this->getResponse()->setTitle('Doctrine - '.$this->project->getTitle());
  }
}
