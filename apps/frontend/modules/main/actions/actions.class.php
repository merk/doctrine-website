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
      ->where('c.core = ?', 1)
      ->andWhere('c.active = ?', 1)
      ->orderBy('c.active DESC')
      ->execute();

    $this->otherContributors = Doctrine_Core::getTable('Contributor')
      ->createQuery('c')
      ->where('c.core = ?', 0)
      ->orWhere('c.core = ? AND c.active = ?', array(1, 0))
      ->orderBy('c.active DESC')
      ->execute();
  }

  public function executeError404()
  {
  }
}