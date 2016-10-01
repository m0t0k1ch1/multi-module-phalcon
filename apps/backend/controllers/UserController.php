<?php

namespace Multi\Backend\Controllers;

use \Multi\Backend\Models\UserModel;

class UserController extends ControllerBase
{
    public function getAction()
    {
        $id = 1;

        $user = UserModel::findFirst($id);

        $this->sendJsonResponse([
            'name' => $user->name,
        ]);
    }
}
