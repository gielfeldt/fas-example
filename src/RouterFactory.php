<?php

namespace App;

use Fas\Configuration\ConfigurationInterface;
use Fas\Routing\ErrorResponse;
use Fas\Routing\Router;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;

class RouterFactory
{
    public static function create(ContainerInterface $container)
    {
        // assumes $container is already set
        $router = new Router($container);
        $router->middleware(ErrorResponse::class);

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
