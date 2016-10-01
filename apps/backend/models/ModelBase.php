<?php

namespace Multi\Backend\Models;

class ModelBase extends \Phalcon\Mvc\Model
{
    public function initialize()
    {
        $this->useDynamicUpdate(true);
    }
}
