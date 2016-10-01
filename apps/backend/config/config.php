<?php

return new \Phalcon\Config([
    'database' => [
        'adapter'  => 'Mysql',
        'host'     => 'localhost',
        'username' => 'root',
        'password' => '',
        'dbname'   => 'multi',
        'charset'  => 'utf8',
    ],
    'application' => [
        'appDir'         => APP_PATH . '/backend/',
        'controllersDir' => APP_PATH . '/backend/controllers/',
    ],
]);
