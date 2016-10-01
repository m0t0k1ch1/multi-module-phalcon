<?php

namespace Multi\Backend;

use \Phalcon\DiInterface;
use \Phalcon\Loader;
use \Phalcon\Mvc\Dispatcher;
use \Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use \Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader;
        $loader->registerNamespaces([
            'Multi\Backend\Controllers' => APP_PATH . '/backend/controllers/',
            'Multi\Backend\Models'      => APP_PATH . '/backend/models',
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

        $di->setShared('db', function() use($config) {
            $dbConfig = $config->database->toArray();
            $dbClass  = '\Phalcon\Db\Adapter\Pdo\\' . $dbConfig['adapter'];
            unset($dbConfig['adapter']);
            return new $dbClass($dbConfig);
        });

        $di->setShared('modelsMetadata', function() {
            return new MetaDataAdapter();
        });
    }
}
