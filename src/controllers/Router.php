<?php

namespace Controllers;

use \Models\Request;
use Models\Response;

class Router
{
    protected Request $request;
    protected Response $response;

    protected string $prefix;

    protected array $routes = [];
    /**
     * @param $request Models\Request 
     * @param $routes array 
     */
    function __construct(Request $request, Response $response)
    {
        $this->prefix = '/content-management-system';
        $this->request = $request;
        $this->response = $response;
    }
    public function get($path, $callback)
    {
        $this->routes['get'][$this->prefix . $path] = $callback;
    }

    public function post(string $url, $callback)
    {
        $this->routes['post'][$url] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) {

            for ($i = strlen($path) - 1; $i > 0; $i--) {
                if ($path[$i] == '/') {

                    //Take the last valid path

                    $previousPath = substr($path, 0, $i);
                    $callback = $this->routes[$method][$previousPath];
                    unset($callback[sizeof($callback) - 1]);

                    break;
                }
            }

            Application::getApp()->response->setStatusCode(404);
            return $this->renderView($callback, '404 Not Found.');
        }

        if (is_array($callback)) {
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    public function renderView($views, $message = '', $depth = 0)
    {
        $depth;

        if ($depth < sizeof($views) - 1) {
            $content = $this->renderView($views, $message, $depth + 1);
        } else {
            $content = $message;
        }

        ob_start();
        include_once Application::$rootDir . '/src/views/' . $views[$depth] . '.php';
        return str_replace('{{Content}}', $content, ob_get_clean());
    }
    public function renderContent($viewContent)
    {
        $layoutContent = $this->mainLayout();
        return str_replace('{{Content}}', $viewContent, $layoutContent);
    }

    protected function mainLayout()
    {
        ob_start();
        include_once Application::$rootDir . "/src/views/layouts/Main.php";
        return ob_get_clean();
    }
}
