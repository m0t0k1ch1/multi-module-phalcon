<?php

namespace Multi\Backend\Models;

class UserModel extends ModelBase
{
    public function getSource()
    {
        return 'user';
    }

    public function validation()
    {
        $this->validate(
            new \Phalcon\Mvc\Model\Validator\Uniqueness([
                'field'   => 'email',
                'message' => 'the email is already used',
            ])
        );

        return $this->validationHasFailed() ? false : true;
    }

    public static function firstByEmail($email)
    {
        return self::query()
            ->where('email = :email:', ['email' => $email])
            ->limit(1)
            ->execute()
            ->getFirst();
    }
}
