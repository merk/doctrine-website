<?php

require_once sfConfig::get('sf_lib_dir').'/vendor/Sensei/Sensei/Doc/Toc.php';

class DocumentationItem
{
  public $project;
  public $version;
  public $data = array(
    'purchase_link' => null,
    'cover_image' => null,
    'toc_path' => null,
    'icon' => null,
    'update_command' => null
  );

  public function __construct($version, $data)
  {
    $this->project = $version->getProject();
    $this->version = $version;
    $this->data = array_merge($this->data, (array) $data);
  }

  public function getProject()
  {
    return $this->project;
  }

  public function getVersion()
  {
    return $this->version;
  }

  public function getTitle()
  {
    return $this->data['title'];
  }

  public function getDescription()
  {
    return $this->data['description'];
  }

  public function getSlug()
  {
    return $this->data['slug'];
  }

  public function getPurchaseLink()
  {
    return $this->data['purchase_link'];
  }

  public function getCoverImage()
  {
    return $this->data['cover_image'];
  }

  public function getIcon()
  {
    return $this->data['icon'];
  }

  public function getUpdateCommand()
  {
    return $this->data['update_command'];
  }

  public function update()
  {
    if ($command = $this->getUpdateCommand())
    {
      chdir(sfConfig::get('sf_data_dir'));
      passthru($command);
      return true;
    }
  }

  public function getRoute()
  {
    if (isset($this->data['route']))
    {
      return $this->data['route'];
    }
    return '@project_documentation_item?slug='.$this->project->getSlug().'&version='.$this->version->getSlug().'&item='.$this->getSlug();
  }

  public function getTableOfContentsPath($language, $user)
  {
    $pattern = sfConfig::get('sf_data_dir').'/'.$this->data['toc_path'].'/%s.txt';
    $languages = array(
      $language,
      $user->getCulture(),
      sfConfig::get('sf_default_culture')
    );
    foreach ($languages as $language)
    {
      $path = sprintf($pattern, $language);
      if (file_exists($path))
      {
        return $path;
      }
    }
  }

  public function getTableOfContents($language, $user)
  {
    if ($path = $this->getTableOfContentsPath($language, $user))
    {
      return new Sensei_Doc_Toc($path);
    }
    return false;
  }

  public function getRenderer($language, $user, $chapter = null)
  {
    $renderer = new DocItemRenderer($this, $language, $user);
    if (isset($this->data['markup_parser']))
    {
      $renderer->setMarkupParser($this->data['markup_parser']);
    }
    $renderer->setOption('title', $this->project->getTitle());
    $renderer->setOption('author', 'Doctrine Core Team');
    $renderer->setOption('version', 'Doctrine ' . $this->version->getSlug());
    $renderer->setOption('subject', $this->getTitle());
    $renderer->setOption('keywords', $this->getDescription());
    $renderer->setOption('template', '%CONTENT%');

    if ($chapter)
    {
      $renderer->setOption('section', $renderer->getToc()->findByPath($chapter));
    }

    $wiki = Text_Wiki::singleton('Doc');
    $wiki->setFormatConf('Xhtml', 'translate', HTML_SPECIALCHARS);
    
    return $renderer;
  }
}