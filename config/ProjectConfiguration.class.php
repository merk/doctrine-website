<?php

require_once realpath(dirname(__FILE__) . '/..') . '/lib/vendor/symfony/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enableAllPluginsExcept(array('sfPropelPlugin'));

    $vendorPath = sfConfig::get('sf_lib_dir') . DIRECTORY_SEPARATOR . 'vendor';
    $includePath = get_include_Path() . PATH_SEPARATOR . $vendorPath;
    set_include_path($includePath);

    require_once('Sensei/Sensei.php');
    require_once('Text/Wiki.php');

    spl_autoload_register(array('Sensei', 'autoload'));
  }
}