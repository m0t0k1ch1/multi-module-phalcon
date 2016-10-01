<?php

namespace Multi\Test\Backend\Models;

use \Multi\Backend\Models\UserModel;

class UserModelTest extends \ModelTestCase
{
    public function testA()
    {
        $this->assertEquals(
            "works",
            "works",
            "This is OK"
        );
    }

    public function testB()
    {
        $this->assertEquals(
            "works",
            "works1",
            "This will fail"
        );
    }
}
