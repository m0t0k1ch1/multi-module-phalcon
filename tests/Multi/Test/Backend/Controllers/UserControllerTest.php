<?php

namespace Multi\Test\Backend\Controllers;

class UserControllerTest extends \ActionTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->insertRows('user', [
            "1, 'm0t0k1ch1', 'm0t0k1ch1.310@gmail.com'",
        ]);
    }

    public function testGet()
    {
        $response = $this->exec('GET', '/user');

        $this->assertHttpStatusOk($response);
        $this->assertResponseEquals($response, [
            'name' => 'm0t0k1ch1',
        ]);
    }

    public function testPost()
    {
        $response = $this->exec('POST', '/user', [
            'name'  => 'm0t0k1ch2',
            'email' => 'm0t0k1ch2.310@gmail.com',
        ]);

        $this->assertHttpStatusOk($response);
        $this->assertResponseEquals($response, []);
    }
}
