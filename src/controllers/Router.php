<?php

namespace Controllers;

use \Models\Request;

class Router
{
    protected Request $request;

    protected string $prefix = '/content-management-system';

    protected array $routes = [];
    /**
     * @param $request Models\Request 
     * @param $routes array 
     */
    function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function get($path, $callback)
    {
        $this->routes['get'][$this->prefix . $path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod() ?? 'get';
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            return "Not found.";
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    public function renderView($view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);
        return str_replace('{{Content}}', $viewContent, $layoutContent);
        // include_once  Application::$rootDir . "src/views/layouts/$view.php";
    }

    protected function layoutContent()
    {
        ob_start();
        include_once Application::$rootDir . "/src/views/layouts/Main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$rootDir . "/src/views/layouts/$view.php";
        return ob_get_clean();
    }
}
