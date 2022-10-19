<?php

namespace Controllers;

use \Models\Request;
use Models\Response;

class Router
{
    protected Request $request;
    protected Response $response;

    protected string $prefix = '/content-management-system';

    protected array $routes = [];
    /**
     * @param $request Models\Request 
     * @param $routes array 
     */
    function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    public function get($path, $callback)
    {
        $this->routes['get'][$this->prefix . $path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            Application::getApp()->response->setStatusCode(404);
            return $this->renderContent('Not Found.');
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
    }
    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{Content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent($layout = 'Main')
    {
        ob_start();
        include_once Application::$rootDir . "/src/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params = [])
    {
        //Will include params inside the view
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$rootDir . "/src/views/layouts/$view.php";
        return ob_get_clean();
    }
}
