<?php

class Router
{
    private array $routes = [];

    // Register a route: e.g. $router->get('/tasks/edit', 'TaskController@edit');
    public function get(string $path, string $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, string $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch(string $method, string $uri): void
    {
        // Strip query string: "/tasks/edit?id=3" -> "/tasks/edit"
        $path = parse_url($uri, PHP_URL_PATH);

        $handler = $this->routes[$method][$path] ?? null;

        if (!$handler) {
            http_response_code(404);
            echo "404 - Route not found: $method $path";
            return;
        }

        [$controllerName, $action] = explode('@', $handler);

        $controllerFile = __DIR__ . "/../app/Controllers/{$controllerName}.php";
        require_once $controllerFile;

        $controller = new $controllerName();
        $controller->$action();
    }
}
