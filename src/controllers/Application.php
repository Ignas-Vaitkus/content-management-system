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
    public static Application $app;
    public function __construct(EntityManager $entityManager, string $rootDir)
    {
        self::$rootDir = $rootDir;
        self::$entityManager = $entityManager;
        self::$app = $this;

        $this->response = new Response();
        $this->request = new Request();
        $this->router = new Router($this->request, $this->response);
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
