<?php
/**
 * documentation actions.
 *
 * @package    doctrine_website
 * @subpackage documentation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class documentationActions extends sfActions
{
  public function executeApi()
  {
    $this->project = Project::getProject($this->getRequestParameter('slug'));
    $this->version = $this->project->getVersion($this->getRequestParameter('version'));

    $this->setLayout(false);
    sfConfig::set('sf_web_debug', false);
  }

  public function executeApi_navigation()
  {
    $this->project = Project::getProject($this->getRequestParameter('slug'));
    $this->version = $this->project->getVersion($this->getRequestParameter('version'));

    $this->setLayout(false);
    sfConfig::set('sf_web_debug', false);
  }

  public function executeGlobal_index()
  {
    $this->getResponse()->setTitle('Doctrine - Documentation');
    $this->projects = Project::getAllProjects();
  }

  public function executeIndex()
  {
    $this->project = Project::getProject($this->getRequestParameter('slug'));
    $this->version = $this->project->getVersion($this->getRequestParameter('version'));
    $this->documentationItems = $this->version->getDocumentationItems($this->getRequestParameter('version'));

    $this->getResponse()->setTitle('Doctrine - '.$this->project->getTitle().' Documentation ('.$this->version->getSlug().')');
  }

  public function executeItem_index()
  {
    $this->project = Project::getProject($this->getRequestParameter('slug'));
    $this->version = $this->project->getVersion($this->getRequestParameter('version'));
    $this->documentationItem = $this->version->getDocumentationItem($this->getRequestParameter('item'));
    $this->renderer = $this->documentationItem->getRenderer(
      $this->getRequestParameter('sf_culture'),
      $this->getUser(),
      $this->getRequestParameter('format', 'DoctrineXhtml')
    );

    $this->getResponse()->setTitle('Doctrine - '.$this->documentationItem->getTitle());
  }

  public function executeItem_chapter()
  {
    $this->project = Project::getProject($this->getRequestParameter('slug'));
    $this->version = $this->project->getVersion($this->getRequestParameter('version'));
    $this->documentationItem = $this->version->getDocumentationItem($this->getRequestParameter('item'));
    $this->renderer = $this->documentationItem->getRenderer(
      $this->getRequestParameter('sf_culture'),
      $this->getUser(),
      $this->getRequestParameter('chapter')
    );

    $this->getResponse()->setTitle('Doctrine - '.$this->documentationItem->getTitle().' / '.$this->renderer->getChapter()->getName());
  }
}