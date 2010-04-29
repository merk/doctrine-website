<?php

class DoctrineExtensionVersion
{
  protected
    $_name,
    $_summary,
    $_description,
    $_version,
    $_packageXml,
    $_author,
    $_authorNick,
    $_authorEmail,
    $_stability,
    $_dirFolder;

  public function __construct($name, $version)
  {
    global $doctrine_svn_path;

    $this->_name = $name;
    $version = str_replace('_', '.', $version);
    $e = explode('-', $version);
    $this->_version = $e[1];
    $this->_doctrineVersion = $e[0];
    $this->_dirFolder = $version;
    $packageXmlPath = $doctrine_svn_path.'/extensions/'.$name.'/branches/'.$this->getDirFolder().'/package.xml';
    if (file_exists($packageXmlPath))
    {
      $this->_packageXml = simplexml_load_file($packageXmlPath);
      $this->_summary = (string) $this->_packageXml->summary;
      $this->_description = (string) $this->_packageXml->description;
      $this->_author = (string) $this->_packageXml->lead->name;
      $this->_authorNick = (string) $this->_packageXml->lead->user;
      $this->_authorEmail = (string) $this->_packageXml->lead->email;
      $this->_stability = (string) $this->_packageXml->stability->api;
    }
  }

  public function getDescription()
  {
    return $this->_description;
  }

  public function getSummary()
  {
    return $this->_summary;
  }

  public function getAuthor()
  {
    return $this->_author;
  }

  public function getAuthorNick()
  {
    return $this->_authorNick;
  }

  public function getAuthorEmail()
  {
    return $this->_authorEmail;
  }

  public function getStability()
  {
    return $this->_stability;
  }

  public function getDirFolder()
  {
    return $this->_dirFolder;
  }

  public function getDoctrineVersion()
  {
    return $this->_doctrineVersion;
  }

  public function getVersion()
  {
    return $this->_version;
  }
}