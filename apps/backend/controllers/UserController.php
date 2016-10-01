<?php

namespace Multi\Backend\Controllers;

class UserController extends ControllerBase
{
    public function getAction()
    {
        $this->sendJsonResponse([
            'name'  => 'm0t0k1ch1',
            'email' => 'm0t0k1ch1.310@gmail.com',
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
