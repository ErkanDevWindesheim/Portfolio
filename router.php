<?php

class Router {
    private array $routes = [];
    
    // Add a route with GET method
    public function get(string $path, callable $handler): void {
        $this->addRoute('GET', $path, $handler);
    }

    // Add a route with POST method
    public function post(string $path, callable $handler): void {
        $this->addRoute('POST', $path, $handler);
    }

    // Add route to the routes array
    private function addRoute(string $method, string $path, callable $handler): void {
        $this->routes[$method][$this->formatRoute($path)] = $handler;
    }

    // Process the incoming request and match it to a route
    public function dispatch(): void {
        $requestUri = $this->formatRoute($_SERVER['REQUEST_URI']);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // Match the URI and method to a registered route
        if (isset($this->routes[$requestMethod])) {
            foreach ($this->routes[$requestMethod] as $route => $handler) {
                // Handle dynamic route variables (e.g. /edit/{id})
                $routeRegex = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $route);
                if (preg_match("#^$routeRegex$#", $requestUri, $matches)) {
                    array_shift($matches); // Remove full match
                    return call_user_func_array($handler, $matches);
                }
            }
        }

        // If no match, return 404
        header("HTTP/1.0 404 Not Found");
        echo "404 - Route Not Found";
    }

    // Utility to normalize the route format
    private function formatRoute(string $route): string {
        return rtrim(parse_url($route, PHP_URL_PATH), '/');
    }
}
