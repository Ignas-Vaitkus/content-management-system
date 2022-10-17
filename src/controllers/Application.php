<?php

namespace Controllers;

use Doctrine\ORM\ORMSetup;
use Models\Request;
use Controllers\Router;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;

class Application
{
    private $isDevMode = true;
    private $proxyDir = null;
    private $cache = null;
    private $useSimpleAnnotationReader = false;
    private Configuration $config;

    //Note usually connection parameters would stored in a different file
    private $conn = array(
        'driver'   => 'pdo_mysql',
        'host'     => '127.0.0.1',
        'dbname'   => 'cms',
        'user'     => 'cms_admin',
        'password' => 'mysql'
    );
    public EntityManager $entityManager;
    public Router $router;
    public Request $request;
    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);

        $this->config =
            ORMSetup::createAnnotationMetadataConfiguration(
                array(__DIR__ . '/..'),
                $this->isDevMode,
                $this->proxyDir,
                $this->cache,
                $this->useSimpleAnnotationReader
            );

        $this->entityManager =  EntityManager::create($this->conn, $this->config);
    }

    public function run()
    {
        $this->router->resolve();
    }
}
