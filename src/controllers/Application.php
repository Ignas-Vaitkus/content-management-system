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
    public static array $pages;
    private static $app = null;

    //With user roles and user entities this bool would not be required
    public static bool $isAdmin;
    public static string $adminPrefix;
    private function __construct(EntityManager $entityManager, string $rootDir, string $adminPrefix)
    {
        self::$entityManager = $entityManager;
        self::$rootDir = $rootDir;
        self::$adminPrefix = $adminPrefix;
        if (isset($_SERVER['PATH_INFO'])) {
            self::$isAdmin = substr($_SERVER['PATH_INFO'], 0, strlen(self::$adminPrefix)) == self::$adminPrefix;
        } else {
            self::$isAdmin = false;
        }

        self::$app = $this;

        $this->response = new Response();
        $this->request = new Request();
        $this->router = new Router($this->request, $this->response);

        self::$pages = $entityManager->getRepository('Models\Page')->findAll();
    }

    public static function getApp(EntityManager $entityManager = null, string $rootDir = null, $adminPrefix = null): Application
    {
        if (self::$app == null) {
            self::$app = new Application($entityManager, $rootDir, $adminPrefix);
        }

        return self::$app;
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
