<?php

$router = new \Phalcon\Mvc\Router;
$router->setDefaultModule('frontend');

/*
 * View
 */
$router->add('/', [
    'module'     => 'frontend',
    'controller' => 'index',
    'action'     => 'index',
]);

/*
 * API
 */
$router->addGet('/user', [
    'module'     => 'backend',
    'controller' => 'user',
    'action'     => 'get',
]);
$router->addPost('/user', [
    'module'     => 'backend',
    'controller' => 'user',
    'action'     => 'post',
]);

return $router;
