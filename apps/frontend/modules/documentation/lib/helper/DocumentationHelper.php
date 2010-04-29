<?php
function get_next_and_prev_nav($renderer)
{
  return get_partial('documentation/next_and_prev_nav', array('renderer' => $renderer));
}

function get_next_prev($renderer, $text = null, $prev = true)
{
  $sf_user = sfContext::getInstance()->getUser();
  $toc = $renderer->getToc();
  $fromIndex = $renderer->getChapter()->getIndex();
  $e = explode('.', $fromIndex);

  if ($prev)
  {
    $e[count($e) - 1] = $e[count($e) - 1] - 1;
    $prevIndex = implode('.', $e);
    $prev = $prevIndex > 0 ? $toc->findByIndex($prevIndex):false;
    if ($prev)
    {
      $text = $text ? $text:'<< ' . $prev->getName();
      return link_to($text, '@project_documentation_item_chapter?slug='.$renderer->getProject()->getSlug().'&item='.$renderer->getDocumentationItem()->getSlug().'&version=' . $renderer->getDocumentationItem()->getVersion()->getSlug() . '&chapter=' . $prev->getPath());
    }
  } else {
    $e[count($e) - 1] = $e[count($e) - 1] + 1;
    $nextIndex = implode('.', $e);
    $next = $nextIndex <= count($toc) ? $toc->findByIndex($nextIndex):false;
    if ($next)
    {
      $text = $text ? $text:$next->getName() . ' >>';
      return link_to($text, '@project_documentation_item_chapter?slug='.$renderer->getProject()->getSlug().'&item='.$renderer->getDocumentationItem()->getSlug().'&version=' . $renderer->getDocumentationItem()->getVersion()->getSlug() . '&chapter=' . $next->getPath());
    }
  }
}

function get_next($renderer, $text = null)
{
  return get_next_prev($renderer, $text, false);
}

function get_prev($renderer, $text = null)
{
  return get_next_prev($renderer, $text, true);
}