<?php

return new \Phalcon\Config([
    'application' => [
        'appDir'         => APP_PATH . '/frontend/',
        'controllersDir' => APP_PATH . '/frontend/controllers/',
        'viewsDir'       => APP_PATH . '/frontend/views/',
        'cacheDir'       => BASE_PATH . '/cache/',
    ],
]);
