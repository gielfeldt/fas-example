<?php

namespace App;

use Fas\Configuration\ConfigurationInterface;
use Fas\Configuration\GlobalConfiguration;
use Fas\DI\Container;
use Fas\Routing\WhoopsMiddleware;
use Laminas\Diactoros\ResponseFactory;
use Psr\Http\Message\ResponseFactoryInterface;

class ContainerFactory
{
    public static function create()
    {
        $container = new Container();

        $container->set(ResponseFactoryInterface::class, ResponseFactory::class);
        $container->set(ConfigurationInterface::class, [GlobalConfiguration::class, 'getConfiguration']);
        $container->set(WhoopsMiddleware::class, static function (ResponseFactoryInterface $responseFactory, ConfigurationInterface $config) {
            $whoopsMiddleware = new WhoopsMiddleware($responseFactory);
            $whoopsMiddleware->includeStackTrace($config->get('include_stack_trace', false));
            return $whoopsMiddleware;
        });

        return $container;
    }
}
