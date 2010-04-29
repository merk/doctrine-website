<?php

/**
 * blog actions.
 *
 * @package    doctrine_website
 * @subpackage blog
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class blogActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->getResponse()->setTitle('Doctrine - Latest Blog Posts');

    $this->blogPosts = $this->getRoute()->getObjects();
  }

  public function executeTag(sfWebRequest $request)
  {
    $this->blogPosts = $this->getRoute()->getObjects();

    $tag = $request->getParameter('tag');
    $this->tag = Doctrine::getTable('Tag')->createQuery('t')
      ->andWhere('t.slug = ? OR t.name = ?')
      ->fetchOne(array($tag, $tag));

    $this->getResponse()->setTitle('Doctrine - Blog posts with the tag "'.$this->tag->getName().'"');
    $this->setTemplate('index');
  }

  public function executePopular()
  {
    $this->blogPosts = $this->getRoute()->getObjects();

    $this->getResponse()->setTitle('Doctrine - Most Popular Blog Posts');
  }
  
  public function executeView()
  {
    $this->blogPost = $this->getRoute()->getObject();
    $this->navigation = Doctrine::getTable('BlogPost')->getNavigationPosts($this->blogPost->getId());
    $this->getResponse()->setTitle('Doctrine - ' . $this->blogPost->getName());
  }

  public function executeFeed()
  {
    $latestBlogPosts = $this->getRoute()->getObjects();

    $feed = new sfAtom1Feed();
    $feed->setTitle('Doctrine Blog');
    $feed->setLink('http://www.doctrine-project.org/blog');
    $this->getContext()->getConfiguration()->loadHelpers(array('Url'));
    foreach($latestBlogPosts as $b)
    {
      $i = new sfFeedItem();
      $i->setPubDate(strtotime($b->getCreatedAt()));
      $i->setTitle($b->getName());
      $i->setContent($b->getFormattedBody());
      $i->setLink($b->getRoute());
      $i->setUniqueId(url_for($b->getRoute(), true));
      $i->setAuthorName($b->getUser()->getUsername());
      $i->setAuthorEmail($b->getUser()->getUsername());
      
      $feed->addItem($i);
    }
    
    $this->feed = $feed;
  }
  
  public function executeArchives()
  {
    $this->archives = $this->getRoute()->getObjects();
  }
}