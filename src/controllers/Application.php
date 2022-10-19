<?php

namespace Controllers;

use Models\Request;
use Controllers\Router;
use Doctrine\ORM\EntityManager;
use Models\Response;

class Application
{
    public static string $rootDir;
    public static EntityManager $entityManager;
    public Router $router;
    public Request $request;
    public Response $response;
    public array $pages;
    private static $app = null;
    private function __construct(EntityManager $entityManager, string $rootDir)
    {
        self::$rootDir = $rootDir;
        self::$entityManager = $entityManager;
        self::$app = $this;

        $this->response = new Response();
        $this->request = new Request();
        $this->router = new Router($this->request, $this->response);

        $this->pages = $entityManager->getRepository('Models\Page')->findAll();
    }

    public static function getApp(EntityManager $entityManager = null, string $rootDir = null): Application
    {
        if (self::$app == null) {
            self::$app = new Application($entityManager, $rootDir);
        }

        return self::$app;
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
