<?php

abstract class UnitTestCase extends \Phalcon\Test\UnitTestCase
{
    private $_loaded = false;

    public function setUp()
    {
        $this->checkExtension('phalcon');

        $di = \Phalcon\Di::getDefault();
        $this->setDi($di);
    }

    public function tearDown()
    {
        // do nothing
    }
}
