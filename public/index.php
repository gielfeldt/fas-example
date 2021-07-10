<?php

namespace App;

require __DIR__ . '/../vendor/autoload.php';

use App\ContainerFactory;
use App\RouterFactory;
use Fas\Configuration\DotNotation;
use Fas\Configuration\FileCache;
use Fas\Configuration\GlobalConfiguration;
use Fas\Configuration\YamlLoader;
use Fas\DI\Container;
use Fas\Routing\CachedRouter;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

// Load configuration
$configuration = FileCache::load(__DIR__ . '/../cache/config.php') ?? new DotNotation(YamlLoader::loadWithOverrides(__DIR__ . '/../config.yaml'));
GlobalConfiguration::setConfiguration($configuration);

// Setup container
$container = Container::load(__DIR__ . '/../cache/container.php') ?? ContainerFactory::create();
$container->enableProxyCache(__DIR__ . '/../cache');

// Setup router
$router = CachedRouter::load(__DIR__ . '/../cache/router.php', $container) ?? RouterFactory::create($container);

// Handle actual request
$request = ServerRequestFactory::fromGlobals();
$response = $router->handle($request);
(new SapiEmitter)->emit($response);
