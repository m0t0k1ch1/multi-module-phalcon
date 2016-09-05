<?php

namespace Multi\Backend\Controllers;

class UserController extends ControllerBase
{
    public function getAction()
    {
        $this->sendJsonResponse([
            'name' => 'm0t0k1ch1',
        ]);
    }
}
