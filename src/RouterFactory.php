<?php

namespace App;

use Fas\Configuration\ConfigurationInterface;
use Fas\Routing\Router;
use Fas\Routing\WhoopsMiddleware;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;

class RouterFactory
{
    public static function create(ContainerInterface $container)
    {
        $router = new Router($container);
        $router->middleware(WhoopsMiddleware::class);

        $router->map('GET', '/hello/[{name}]', function (ResponseFactoryInterface $responseFactory, ConfigurationInterface $configuration, $name = null) {
            $name = $name ?? $configuration->get('example.default.name', 'nobody');
            $response = $responseFactory->createResponse(200);
            $response->getBody()->write(json_encode(['name' => $name]));
            return $response
                ->withHeader('Content-Type', 'application/json');
        });

        return $router;
    }
}
