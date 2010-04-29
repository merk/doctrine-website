<?php
function get_doc_item_release_languages($docItem)
{
  global $doctrine_svn_path;

  $release = $docItem->getApiRelease();

  $languages = array();

  $path = $doctrine_svn_path . $release->getSvnPath() . '/' . $docItem->getSvnPath();
  $found = glob($path . '/*.txt');

  foreach ($found as $file)
  {
    $info = pathinfo($file);
    $languages[] = $info['filename'];
  }
  return $languages;
}

function get_doc_item_release_language_menu($docItem, $route = null)
{
  return get_change_language_menu(get_doc_item_release_languages($docItem), $route);
}

function doc_item_has_multiple_languages($docItem)
{
  return count(get_doc_item_release_languages($docItem)) > 1 ? true:false;
}

function get_change_language_menu($languages = null, $url = null)
{
  $sf_user = sfContext::getInstance()->getUser();

  use_helper('I18N');
  if ($languages === null)
  {
    $languages = array('en', 'fr');
  }

  $languages = (array) $languages;

  $html = '';
  foreach ($languages as $key)
  {
    if ($url)
    {
      $replaced = str_replace('SF_CULTURE', $key, $url);
      $html .= '<a href="' . $replaced . '" title="Read in ' . format_language($sf_user->getLanguage($key), $sf_user->getLanguage()) . '">' . image_tag($key . '.png') . '</a>';
    } else {
      if (sfContext::getInstance()->getUser()->getCulture() == $key)
      {
        $html .= image_tag($key . '.png', 'class=selected_lang title=Currentling reading in ' . format_language($sf_user->getLanguage($key), $sf_user->getLanguage()));
      } else {
        $html .= link_to(image_tag($key . '.png', 'class=other_lang'), '@change_language?new_culture=' . $key, 'title=Read in ' . format_language($sf_user->getLanguage($key), $sf_user->getLanguage()));
      }
    }

    $html .= '&nbsp;';
  }

  return $html;
}