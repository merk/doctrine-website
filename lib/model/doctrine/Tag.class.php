<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Tag extends BaseTag
{
  public function getNumSnippets()
  {
    if (isset($this->Snippets) && isset($this->Snippets[0]->num_snippets))
    {
      return $this->Snippets[0]->num_snippets;
    } else {
      $query = new Doctrine_Query();
      $query->from('SnippetTag s')
            ->where('s.tag_id = ?', $this->getId());
      
      return $query->count();
    }
  }
}