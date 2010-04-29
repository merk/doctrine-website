<?php

class DoctrineExtension
{
  protected
    $_extension,
    $_name;

  public static function synchronizeWithDb()
  {
    global $doctrine_svn_path;

    $html = file_get_contents('http://svn.doctrine-project.org/extensions');

    preg_match_all("/\<li\>(.*)<\/li\>/", $html, $matches);
    foreach ($matches[1] as $match)
    {
      $extension = strip_tags($match);
      $extension = substr($extension, 0, strlen($extension) - 1);
      $path = $doctrine_svn_path.'/extensions/'.$extension;

      if (is_dir($path) && $extension != '.')
      {
        $name = $extension;

        $extension = Doctrine::getTable('Extension')->findOneByName($extension);
        $doctrineExtension = new self($name, $extension);
        if (!$extension)
        {
          $extension = new Extension();
        }
        $doctrineExtension->setExtension($extension);

        $extension->name = $name;
        $extension->save();

        $doctrineExtension->synchronizeVersionsWithDb();
      }
    }
  }

  public function __construct($name, $extension)
  {
    $this->_name = $name;
    $this->_extension = $extension;
  }

  public function setExtension($extension)
  {
    $this->_extension = $extension;
  }

  public function synchronizeVersionsWithDb()
  {
    global $doctrine_svn_path;

    $this->_versions = array();
    $html = file_get_contents('http://svn.doctrine-project.org/extensions/'.$this->_name.'/branches');
    preg_match_all("/\<li\>(.*)<\/li\>/", $html, $matches);

    foreach ($matches[1] as $match)
    {
      $versionName = strip_tags($match);
      $versionName = substr($versionName, 0, strlen($versionName) - 1);
      $path = $doctrine_svn_path.'/extensions/'.$this->_name.'/branches/'.$versionName;

      if (is_dir($path) && $versionName != '.')
      {
        $version = new DoctrineExtensionVersion($this->_name, $versionName);

        $versionName = str_replace('.', '_', $versionName);
        $q = Doctrine::getTable('ExtensionVersion')
          ->createQuery('v')
          ->where('v.name = ? AND v.extension_id = ?', array($versionName, $this->_extension->id));

        $extensionVersion = $q->fetchOne();
        if (!$extensionVersion)
        {
          $extensionVersion = new ExtensionVersion();
        }

        $extensionVersion->Extension = $this->_extension;
        $extensionVersion->name = $versionName;
        $extensionVersion->summary = $version->getSummary();
        $extensionVersion->description = $version->getDescription();
        $extensionVersion->author = $version->getAuthor();
        $extensionVersion->author_nick = $version->getAuthorNick();
        $extensionVersion->author_email = $version->getAuthorEmail();
        $extensionVersion->stability = $version->getStability();
        $extensionVersion->doctrine_version = $version->getDoctrineVersion();
        $extensionVersion->extension_version = $version->getVersion();
        $extensionVersion->save();

        $this->_extension->summary = $version->getSummary();
        $this->_extension->author = $version->getAuthor();
        $this->_extension->author_nick = $version->getAuthorNick();
        $this->_extension->author_email = $version->getAuthorEmail();
        $this->_extension->description = $version->getDescription();
        $this->_extension->save();

        $extensionVersion->runUnitTests();
      }
    }
  }

  public function getName()
  {
    return $this->_name;
  }

  public function getVersion()
  {
    return $this->_version;
  }
}
