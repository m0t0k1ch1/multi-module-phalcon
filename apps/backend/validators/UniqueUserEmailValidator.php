<?php

namespace Multi\Backend\Validators;

use \Multi\Backend\Models\UserModel;

class UniqueUserEmailValidator extends \Phalcon\Validation\Validator
{
    public function validate(\Phalcon\Validation $v, $attr)
    {
        $value = $v->getValue($attr);

        $duplicatedUser = UserModel::firstByEmail($value);
        if (!empty($duplicatedUser)) {
            $message = $this->getOption('message');
            if (empty($message)) {
                $message = 'the email is already used';
            }

            $v->appendMessage(
                new \Phalcon\Validation\Message($message, $attr, 'UniqueUserEmail')
            );

            return false;
        }

        return true;
    }
}
