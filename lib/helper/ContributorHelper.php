<?php

function contributor_photo($contributor, $options = array())
{
  $path = sfConfig::get('sf_upload_dir') . '/assets/' . strtolower($contributor->getNick()) . '.gif';
  $options['size'] = '50x50';
  $options['title'] = $contributor->getNick();
  if (file_exists($path))
  {
    return image_tag('/uploads/assets/' . strtolower($contributor->getNick()) . '.gif', $options);
  } else {
    return image_tag('/uploads/assets/no_image.png', $options);
  }
}