<?php

namespace Multi\Test\Backend\Models;

use \Multi\Backend\Models\UserModel;

class UserModelTest extends \ModelTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->insertRows('user', [
            "1, 'm0t0k1ch1', 'm0t0k1ch1.310@gmail.com'",
            "2, 'm0t0k1ch2', 'm0t0k1ch2.310@gmail.com'",
        ]);
    }

    public function testFirstByEmail1()
    {
        $user = UserModel::firstByEmail('m0t0k1ch1.310@gmail.com');
        $this->assertNotEmpty($user);
        $this->assertEquals($user->id, 1);
        $this->assertEquals($user->name, 'm0t0k1ch1');
        $this->assertEquals($user->email, 'm0t0k1ch1.310@gmail.com');
    }

    public function testFirstByEmail2()
    {
        $user = UserModel::firstByEmail('m0t0k1ch2.310@gmail.com');
        $this->assertNotEmpty($user);
        $this->assertEquals($user->id, 2);
        $this->assertEquals($user->name, 'm0t0k1ch2');
        $this->assertEquals($user->email, 'm0t0k1ch2.310@gmail.com');
    }
}
