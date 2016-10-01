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

    public function postAction()
    {
        $params = $this->request->getPost();

        $v = new \Multi\Backend\Validations\SignupValidation;

        $messages = $v->validate($params);
        if (count($messages) > 0) {
            $this->sendValidationMessages($messages);
            return;
        }

        $this->sendJsonResponse([]);
    }
}
