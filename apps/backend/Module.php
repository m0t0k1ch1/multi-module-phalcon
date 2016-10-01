<?php

namespace Multi\Backend;

use \Phalcon\DiInterface;
use \Phalcon\Loader;
use \Phalcon\Mvc\Dispatcher;
use \Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader;
        $loader->registerNamespaces([
            'Multi\Backend\Controllers' => APP_PATH . '/backend/controllers/',
            'Multi\Backend\Validations' => APP_PATH . '/backend/validations/',
        ]);
        $loader->register();
    }

    public function registerServices(DiInterface $di)
    {
        $config = include APP_PATH . '/backend/config/config.php';

        $di->setShared('config', function() use($config) {
            return $config;
        });

        $di->setShared('dispatcher', function() {
            $dispatcher = new Dispatcher;
            $dispatcher->setDefaultNamespace('Multi\Backend\Controllers');

            return $dispatcher;
        });
    }
}
