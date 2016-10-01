<?php

abstract class ActionTestCase extends \Phalcon\Test\FunctionalTestCase
{
    protected $module;

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

        $this->di->set('router', function() {
            return include APP_PATH . '/routes.php';
        });

        require_once APP_PATH . '/backend/Module.php';
        $this->module = new \Multi\Backend\Module;

        $this->di->remove('response');

        $_SESSION = [];
        $_GET     = [];
        $_POST    = [];
        $_COOKIE  = [];
        $_REQUEST = [];
        $_FILES   = [];
    }

    protected function exec($httpMethod, $url, $params = [])
    {
        $_SERVER['REQUEST_METHOD'] = $httpMethod;

        switch ($httpMethod) {
        case 'GET':
            $_GET = array_merge($_GET, $params);
            break;
        case 'POST':
            $_POST = array_merge($_POST, $params);
            break;
        default:
            break;
        }

        $di = $this->getDi();

        $router = $di['router'];
        $router->handle($url);

        $this->module->registerAutoloaders($di);
        $this->module->registerServices($di);

        $config = $this->config;
        $di->setShared('db', function() use($config) {
            $dbClass = 'Phalcon\Db\Adapter\Pdo\Mysql';
            return new $dbClass($config['db']['mysql']);
        });

        $dispatcher = $di['dispatcher'];
        $dispatcher->setModuleName('backend');
        $dispatcher->setControllerName($router->getControllerName());
        $dispatcher->setActionName($router->getActionName());
        $dispatcher->setParams($router->getParams());
        $dispatcher->dispatch();

        return $di['response'];
    }

    protected function assertHttpStatusOk(\Phalcon\Http\Response $response)
    {
        $this->assertEquals($response->getStatusCode(), '200 OK');
    }

    protected function assertResponseEquals(\Phalcon\Http\Response $response, $body)
    {
        $this->assertJsonStringEqualsJsonString(
            $response->getContent(),
            json_encode($body)
        );
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
