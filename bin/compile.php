<?php

namespace App;

require __DIR__ . '/../vendor/autoload.php';

// Compile container
$container = ContainerFactory::create();
$container->enableProxyCache(__DIR__ . '/../cache');
$container->save(__DIR__ . '/../cache/container.php', __DIR__ . '/../cache/preload.container.php');

// Compile router
$router = RouterFactory::create($container);
$router->save(__DIR__ . '/../cache/router.php', __DIR__ . '/../cache/preload.router.php');
