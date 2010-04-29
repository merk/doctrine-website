<?php
class MyInflector extends Doctrine_Inflector
{
  public static function releaseUrlize($word, $record)
  {
    $slug = parent::urlize($word);
    $slug = str_replace('-', '_', $slug);
		return strtoupper($slug);
  }
}