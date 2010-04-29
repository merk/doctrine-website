<?php

require_once(dirname(__FILE__).'/config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);

$autoload = sfSimpleAutoload::getInstance(sfConfig::get('sf_cache_dir').'/project_autoload.cache');
$autoload->loadConfiguration(sfFinder::type('file')->name('autoload.yml')->in(array(
  sfConfig::get('sf_symfony_lib_dir').'/config/config',
  sfConfig::get('sf_config_dir'),
)));
$autoload->register();

if (!isset($argv[0])) {
    die('This program must be run from the command line using the CLI version of PHP');
    
// check we are using the correct version of PHP
} elseif (!defined('T_COMMENT') || !extension_loaded('tokenizer') || version_compare(phpversion(), '4.3.0', '<')) {
    error('You need PHP version 4.3.0 or greater with the "tokenizer" extension to run this script, please upgrade');
    exit;
}

// include PHPDoctor class
set_include_path(get_include_path() . PATH_SEPARATOR . 'lib/vendor/phpdoctor');
require('lib/vendor/phpdoctor/classes'.DIRECTORY_SEPARATOR.'phpDoctor.php');

// get name of config file to use
if (!isset($argv[1])) {
    if (isset($_ENV['PHPDoctor'])) {
        $argv[1] = $_ENV['PHPDoctor'];
    } elseif (is_file('default.ini')) {
        phpDoctor::warning('Using default config file "default.ini"');
        $argv[1] = 'default.ini';
    } else {
        phpDoctor::error('Usage: phpdoc.php [config_file]');
        exit;
    }
}

$phpdoc = new phpDoctor($argv[1]);

$rootDoc = $phpdoc->parse();

$phpdoc->execute($rootDoc);

?>