<?php

class Router {

    private $url;
    private $routes = [];

    public function __construct($url) {
        $this->url = $url;
    }

    public function get($path, $callable) {
        $route = new Route($path, $callable);
        $this->routes['GET'][] = $route;
    }

    public function post($path, $callable) {
        $route = new Route($path, $callable);
        $this->routes['POST'][] = $route;
    }

    public function run() {
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            throw new \Exception('REQUEST_METHOD does not exist');
        }
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->url)) {
                return $route->call();
            }
        }
        throw new \Exception('no routes matches');
    }

}

class Route {

    private $path;
    private $callable;
    private $matches;

    public function __construct($path, $callable) {
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }

    public function match($url) {
        $url = trim($url, '/');
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $regex = "#^$path$#i";
        if (!preg_match($regex, $url, $matches)) {
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    public function call() {
        if (is_string($this->callable)) {
            $params = explode('#', $this->callable);
            $controller = "\\Controller\\" . $params[0] . "Controller";
            $controller = new $controller;
            $action = $params[1];
            $controller->$action();
        } else {
            return call_user_func_array($this->callable, $this->matches);
        }
    }

}
