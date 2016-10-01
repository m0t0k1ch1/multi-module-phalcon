<?php

use Phalcon\Di;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('APP_PATH', __DIR__ . '/../apps');
define('ROOT_PATH', __DIR__);

set_include_path(
    ROOT_PATH . PATH_SEPARATOR . get_include_path()
);

include __DIR__ . '/../vendor/autoload.php';

$loader = new Loader;
$loader->registerDirs([
    ROOT_PATH,
]);
$loader->registerNamespaces([
    'Multi\Backend\Controllers' => APP_PATH . '/backend/controllers/',
    'Multi\Backend\Models'      => APP_PATH . '/backend/models',
    'Multi\Backend\Validations' => APP_PATH . '/backend/validations/',
    'Multi\Backend\Validators'  => APP_PATH . '/backend/validators/',
]);
$loader->register();

$di = new FactoryDefault();

$config = include APP_PATH . '/backend/config/config.php';
$di->setShared('config', function() use($config) {
    return $config;
});

Di::reset();
Di::setDefault($di);
