<?php

class Router
{
    private array $routes;

    public function addRouter(string $path, array $rules): void
    {
        $this->routes[$path] = $rules;
    }

    public function processRouter(string $url, string $method): void
    {
        $routes = $this->routes;
        if (!$routes) {
            throw new Exception('Routes is not fined');
        }

        $url = strrchr($url, '/');
        $controllerAction = null;
        foreach ($routes as $routeUrl => $routeMethods) {
            if ($routeUrl === $url) {
                $controllerAction = $routeMethods[$method] ?? null;
                break;
            }
        }

        if (!isset($controllerAction)) {
            header('not found', true, 404);
            echo '404';
            exit;
        }

        [$controller, $action] = explode('@', $controllerAction);


        if (!isset($controller) && !isset($action)) {
            throw new Exception('invalid route');
        }

        $controllerObj = new $controller();
        $controllerObj->$action();
    }
}