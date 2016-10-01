<?php

namespace Multi\Backend\Models;

class UserModel extends ModelBase
{
    public function getSource()
    {
        return 'user';
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
