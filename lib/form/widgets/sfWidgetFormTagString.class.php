<?php
class sfWidgetFormTagString extends sfWidgetFormTextarea
{
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    if ($value)
    {
      $tags = Doctrine_Query::create()
        ->from('Tag t')
        ->whereIn('t.id', $value)
        ->fetchArray();
    } else {
      $tags = array();
    }

    $tagsArray = array();
    foreach ($tags as $tag)
    {
      $tagsArray[] = strtolower(trim($tag['name']));
    }
    $tagsArray = array_unique($tagsArray);
    $value = implode(', ', $tagsArray);
    $attributes['cols'] = 80;
    $attributes['rows'] = 2;
    $html  = $this->renderContentTag('textarea', self::escapeOnce($value), array_merge(array('name' => $name), $attributes));
    return $html;
  }
}