<?php

use \Phalcon\Di\FactoryDefault;
use \Phalcon\Loader;
use \Phalcon\Mvc\Router;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/apps');

$di = new FactoryDefault;

$di->set('router', function() {
    return include APP_PATH . '/routes.php';
});

try {
    $router = $di['router'];
    $router->handle();

    $moduleName = $router->getModuleName();

    switch ($moduleName) {
    case 'frontend':
        require_once APP_PATH . '/frontend/Module.php';
        $module = new \Multi\Frontend\Module;
        break;
    case 'backend':
        require_once APP_PATH . '/backend/Module.php';
        $module = new \Multi\Backend\Module;
        break;
    default:
        throw new \RuntimeException('unknown module');
    }

    $module->registerAutoloaders($di);
    $module->registerServices($di);

    $dispatcher = $di['dispatcher'];
    $dispatcher->setModuleName($moduleName);
    $dispatcher->setControllerName($router->getControllerName());
    $dispatcher->setActionName($router->getActionName());
    $dispatcher->setParams($router->getParams());
    $dispatcher->dispatch();

    $response = $di['response'];

    if ($moduleName == 'frontend') {
        $view = $di['view'];
        $view->start();
        $view->render(
            $dispatcher->getControllerName(),
            $dispatcher->getActionName(),
            $dispatcher->getParams()
        );
        $view->finish();

        $response->setContent($view->getContent());
    }

    $response->send();
}
catch (\Exception $e) {
    echo $e;
}
