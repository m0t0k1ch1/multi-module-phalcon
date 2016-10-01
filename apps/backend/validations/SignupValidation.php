<?php

namespace Multi\Backend\Validations;

class SignupValidation extends \Phalcon\Validation
{
    public function initialize()
    {
        $this->setFilters('name', [
            'trim',
            'string',
        ]);
        $this->add(
            'name',
            new \Phalcon\Validation\Validator\PresenceOf([
                'message' => 'name is required',
            ])
        );

        $this->setFilters('email', [
            'trim',
            'string',
        ]);
        $this->add(
            'email',
            new \Phalcon\Validation\Validator\PresenceOf([
                'message' => 'email is required',
            ])
        );
        $this->add(
            'email',
            new \Phalcon\Validation\Validator\Email([
                'message' => 'invalid email',
            ])
        );
        $this->add(
            'email',
            new \Multi\Backend\Validators\UniqueUserEmailValidator
        );
    }
}
