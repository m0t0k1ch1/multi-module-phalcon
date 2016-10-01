<?php

abstract class ModelTestCase extends \Phalcon\Test\ModelTestCase
{
    public function setUp()
    {
        $this->checkExtension('phalcon');

        $di = \Phalcon\Di::getDefault();
        $this->setDi($di);

        $config = $di['config'];
        $this->config = [
            'db' => [
                'mysql' => $config->database->test->toArray(),
            ],
        ];
        $this->setDb();
    }

    public function tearDown()
    {
        // do nothing
    }

    public function truncateAll()
    {
        $this->truncateTable('user');
    }
}
