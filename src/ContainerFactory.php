<?php

namespace App;

use Fas\Configuration\ArrayConfiguration;
use Fas\Configuration\ConfigurationInterface;
use Fas\Configuration\GlobalConfiguration;
use Fas\DI\Container;
use Laminas\Diactoros\ResponseFactory;
use Psr\Http\Message\ResponseFactoryInterface;

class ContainerFactory
{
    public static function create()
    {
        $container = new Container();

        $container->set(ResponseFactoryInterface::class, ResponseFactory::class);
        $container->set(ConfigurationInterface::class, [GlobalConfiguration::class, 'getConfiguration']);

        return $container;
    }
}
