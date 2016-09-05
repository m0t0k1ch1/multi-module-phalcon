<?php

namespace Multi\Frontend;

use \Phalcon\DiInterface;
use \Phalcon\Loader;
use \Phalcon\Mvc\Dispatcher;
use \Phalcon\Mvc\ModuleDefinitionInterface;
use \Phalcon\Mvc\View;
use \Phalcon\Mvc\View\Engine\Php as PhpEngine;
use \Phalcon\Mvc\View\Engine\Volt as VoltEngine;

class Module implements ModuleDefinitionInterface
{
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader;
        $loader->registerNamespaces([
            'Multi\Frontend\Controllers' => APP_PATH .'/frontend/controllers/'
        ]);
        $loader->register();
    }

    public function registerServices(DiInterface $di)
    {
        $config = include APP_PATH . '/frontend/config/config.php';

        $di->setShared('config', function() use($config) {
            return $config;
        });

        $di->setShared('dispatcher', function() {
            $dispatcher = new Dispatcher;
            $dispatcher->setDefaultNamespace('Multi\Frontend\Controllers');

            return $dispatcher;
        });

        $di->setShared('view', function () use($config) {
            $view = new View;
            $view->setDI($this);
            $view->setViewsDir($config->application->viewsDir);
            $view->registerEngines([
                '.volt' => function($view) use($config) {
                    $volt = new VoltEngine($view, $this);
                    $volt->setOptions([
                        'compiledPath'      => $config->application->cacheDir,
                        'compiledSeparator' => '_',
                    ]);

                    return $volt;
                },
                '.phtml' => PhpEngine::class,
            ]);

            return $view;
        });
    }
}
