<?php
class blogComponents extends sfComponents
{
  public function executeLatest_blog_posts()
  {
    $blogPostTable = Doctrine::getTable('BlogPost');
    
    $this->latestBlogPosts = $blogPostTable->getLatest(5);
  }

  public function executeTag_cloud()
  {
    $q = Doctrine_Query::create()
      ->select('t.*, COUNT(DISTINCT p.id) as num_blog_posts')
      ->from('Tag t')
      ->leftJoin('t.BlogPosts p')
      ->where('p.id IS NOT NULL')
      ->groupBy('t.id')
      ->orderBy('num_blog_posts DESC')
      ->limit(20);
    $this->tags = $q->fetchArray();
  }
}