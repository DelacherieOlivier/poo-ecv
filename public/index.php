<?php

declare(strict_types=1);

session_start();

spl_autoload_register(function ($fqcn): void {
    $path = str_replace('\\', '/', $fqcn);
    require_once __DIR__.'/../'.$path.'.php';
});

define('APP_ENV', 'dev');

$router = \App\Routing\Router::getFromGlobals();

$controller = $router->getController();

$controller->render();
