<?php

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

class Router
{
    /**
     * @var array<string, array<string, callable|array{0: string, 1: string}>>
     */
    private array $routes = [];

    public function get(string $uri, callable|array $action): void
    {
        $this->register('GET', $uri, $action);
    }

    public function post(string $uri, callable|array $action): void
    {
        $this->register('POST', $uri, $action);
    }

    public function dispatch(string $method, string $uri): void
    {
        $method = strtoupper($method);
        $uri = $this->normalize($uri);

        $action = $this->routes[$method][$uri] ?? null;

        if (!$action) {
            http_response_code(404);
            echo '404 - Pagina non trovata';
            return;
        }

        $this->invoke($action);
    }

    private function register(string $method, string $uri, callable|array $action): void
    {
        $method = strtoupper($method);
        $uri = $this->normalize($uri);
        $this->routes[$method][$uri] = $action;
    }

    private function normalize(string $uri): string
    {
        $uri = rtrim($uri, '/');
        return $uri === '' ? '/' : $uri;
    }

    private function invoke(callable|array $action): void
    {
        if (is_callable($action)) {
            $action();
            return;
        }

        [$class, $method] = $action;

        if (!class_exists($class)) {
            throw new RuntimeException("Controller {$class} non trovato.");
        }

        $instance = new $class();

        if (!method_exists($instance, $method)) {
            throw new RuntimeException("Metodo {$method} non definito in {$class}.");
        }

        $instance->{$method}();
    }
}
