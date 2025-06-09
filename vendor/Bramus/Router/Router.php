<?php

namespace Bramus\Router;

class Router {
    protected $routes = [];

    public function get($route, $callback) {
        $this->routes['GET'][$route] = $callback;
    }

    public function post($route, $callback) {
        $this->routes['POST'][$route] = $callback;
    }

    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $basePath = dirname($_SERVER['SCRIPT_NAME']);
        $path = '/' . ltrim(str_replace($basePath, '', $uri), '/');

        if (isset($this->routes[$method][$path])) {
            $callback = $this->routes[$method][$path];
            if (is_string($callback)) {
                [$class, $method] = explode('@', $callback);
                $controller = new $class();
                call_user_func([$controller, $method]);
            } elseif (is_callable($callback)) {
                call_user_func($callback);
            }
        } else {
            header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
            echo "404 - Page non trouvée";
        }
    }
}
