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

    public function post(string $path, $callback)
    {
        $this->routes['post'][$this->prefix . $path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) {
            Application::getApp()->response->setStatusCode(404);

            for ($i = strlen($path) - 1; $i > 0; $i--) {
                if ($path[$i] == '/') {

                    //Take the last valid path
                    $previousPath = substr($path, 0, $i + 1);

                    //If the path previous path matches the last valid path set the callback to that
                    if ($this->prefix . '/' == $previousPath) {
                        $callback = $this->routes[$method][$previousPath];
                    } else {
                        //If the path previous path matches the last valid path set the callback to that
                        if (!isset($this->routes[$method][substr($previousPath, 0, -1)])) {
                            continue;
                        }
                        $callback = $this->routes[$method][substr($previousPath, 0, -1)];
                    }

                    //Shorten the view array by one to output the message
                    unset($callback[sizeof($callback) - 1]);

                    break;
                }
            }

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
