<?php

namespace Controllers;

use \Models\Request;

class Router
{
    public Request $request;

    protected array $routes = [];
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        echo $path;
    }
    /**
     * @param $request Models\Request 
     * @param $routes array 
     */
    function __construct(Request $request)
    {
        $this->request = $request;
    }
}
