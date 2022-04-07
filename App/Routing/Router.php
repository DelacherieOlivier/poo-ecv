<?php

declare(strict_types=1);

namespace App\Routing;

use App\Controller\Controller;
use App\Controller\Error404;
use App\Controller\Jeux;
use App\Controller\Welcome;

class Router
{
    public array $routes = [
        '/' => Welcome::class,
        '/404' => Error404::class,
        '/jeux' => Jeux::class,
    ];
    private static string $path;

    private static ?Router $router = null;

    private function __construct()
    {
        self::$path = $_SERVER['PATH_INFO'] ?? '/jeux';
    }

    public static function getFromGlobals(): self
    {
        if (null === self::$router) {
            self::$router = new self();
        }

        return self::$router;
    }

    public function getController()
    {
        $controllerClass = $this->routes[self::$path] ?? $this->routes['/404'];
        $controller = new $controllerClass();

        if (!$controller instanceof Controller) {
            throw new \LogicException("Controller $controller should implement".Controller::class);
        }

        return $controller;
    }
}
