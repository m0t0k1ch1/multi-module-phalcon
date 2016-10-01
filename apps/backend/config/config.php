<?php

return new \Phalcon\Config([
    'application' => [
        'appDir'         => APP_PATH . '/backend/',
        'controllersDir' => APP_PATH . '/backend/controllers/',
    ],
    'database' => [
        'app' => [
            'adapter'  => 'Mysql',
            'host'     => 'localhost',
            'username' => 'root',
            'password' => '',
            'dbname'   => 'multi',
            'charset'  => 'utf8',
        ],
        'test' => [
            'host'     => 'localhost',
            'username' => 'root',
            'password' => '',
            'dbname'   => 'multi-test',
            'charset'  => 'utf8',
        ],
    ],
]);
