<?php

/**
 * main actions.
 *
 * @package    doctrine_website
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class mainActions extends sfActions
{
  public function executeIndex()
  {
    $this->projects = Project::getPrimaryProjects();
    $this->blogPosts = Doctrine_Core::getTable('BlogPost')->getHomepageBlogPosts();
  }

  public function executeAbout()
  {
    $this->getResponse()->setTitle('Doctrine - About');

    $this->contributors = Doctrine_Core::getTable('Contributor')
      ->createQuery('c')
      ->orderBy('c.core DESC, c.active DESC')
      ->execute();
  }

  public function executeError404()
  {
  }
}