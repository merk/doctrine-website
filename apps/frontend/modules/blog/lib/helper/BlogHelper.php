<?php

function get_gravatar($email, $options = array(), $size = 40)
{
  $default = "http://www.somewhere.com/homestar.jpg";
  $url = 'http://www.gravatar.com/avatar.php?gravatar_id='.md5(strtolower($email)).'&default='.urlencode($default).'&size='.$size;
  return image_tag($url, $options);
}

function build_tag_cloud($tags)
{
  $links = array();
  if (count($tags))
  {
    $tagsArray = array();
    foreach ($tags as $tag)
    {
      $name = trim($tag['name']);
      if ($name)
      {
        $tagsArray[$name.":::".$tag['slug']] = $tag['num_blog_posts'];
      }
    }
    $maxSize = 250; // max font size in %
    $minSize = 100; // min font size in %

    // get the largest and smallest array values
    $maxQty = max(array_values($tagsArray));
    $minQty = min(array_values($tagsArray));

    // find the range of values
    $spread = $maxQty - $minQty;
    if (0 == $spread) { // we don't want to divide by zero
        $spread = 1;
    }

    // determine the font-size increment
    // this is the increase per tag quantity (times used)
    $step = ($maxSize - $minSize)/($spread);
    foreach ($tagsArray as $key => $value)
    {
      $e = explode(':::', $key);
      $key = $e[0];
      $slug = $e[1];
      $size = $minSize + (($value - $minQty) * $step);
      $options = array('style' => 'font-size: ' . $size . '%', 'title' => $value . ' items tagged with ' . $key);
      $links[] = link_to($key, '@blog_tag?tag=' . $slug, $options) . ' ';
    }
  }
  return '<span class="tag">'. implode('</span><span class="tag">', $links) . '</span>';
}