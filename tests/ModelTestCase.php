<?php

abstract class ModelTestCase extends \Phalcon\Test\ModelTestCase
{
    public function setUp()
    {
        $this->checkExtension('phalcon');

        $di = \Phalcon\Di::getDefault();
        $this->setDi($di);

        $config = $this->di['config'];
        $this->config = [
            'db' => [
                'mysql' => $config->database->test->toArray(),
            ],
        ];
        $this->setDb();
        $this->truncateAll();
    }

    public function tearDown()
    {
        // do nothing
    }

    public function truncateAll()
    {
        $this->truncateTable('user');
    }

    public function insertRows($table, $rows = [])
    {
        $db = $this->di['db'];

        foreach ($rows as $row) {
            $sql = "INSERT INTO ${table} VALUES (${row})";
            $db->execute($sql);
        }
    }
}
