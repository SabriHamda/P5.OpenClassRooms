<?php

namespace core\Router;

use app\Exceptions\NotFoundHttpException;

class Router
{
    private $routes = [];
    //private $params;
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
        $this->loadRoutes();
    }

    public function loadRoutes()
    {
        $routes = require __DIR__ . './../../config/routes.php'; // tableau de routes ...
        foreach ($routes as $route) {
            $params = isset($route['params']) ? $route['params'] : null;
            $method = isset($route['method']) ? $route['method'] : 'GET';
            $this->routes[] = new Route($route['path'], $route['controller'], $route['action'], $params, $method);
        }
    }

    public function handleRequest()
    {
        $url = $this->request->getUri();
        $method = $this->request->getMethod();
        $hasHandler = false;
        foreach ($this->routes as $route) {
            if ($route->match($url, $method)) {
                $controllerClassName = $route->getController();
                $controller = (new $controllerClassName($this->request));
                $controller->{$route->getAction()}($route->getParameterValue());
                $hasHandler = true;
                break;
            }
        }

        if (!$hasHandler) {
            header('location: /error');
            throw new NotFoundHttpException();
        }
    }
}
