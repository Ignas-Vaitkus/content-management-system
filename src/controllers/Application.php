<?php

namespace Controllers;

use Models\Request;
use Controllers\Router;
use Doctrine\ORM\EntityManager;

class Application
{
    public static string $rootDir;
    public EntityManager $entityManager;
    public Router $router;
    public Request $request;
    public function __construct(EntityManager $entityManager, string $rootDir)
    {
        self::$rootDir = $rootDir;
        $this->request = new Request();
        $this->router = new Router($this->request);
        $this->entityManager = $entityManager;
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
