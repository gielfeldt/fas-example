<?php

namespace App\Tests;

use App\ContainerFactory;
use App\RouterFactory;
use Fas\Configuration\ArrayConfiguration;
use Fas\Configuration\GlobalConfiguration;
use Laminas\Diactoros\ServerRequestFactory;
use PHPUnit\Framework\TestCase;

class RouteTest extends TestCase
{
    public function testRoute()
    {
        GlobalConfiguration::setConfiguration(new ArrayConfiguration([]));
        $router = RouterFactory::create(ContainerFactory::create());
        $request = (new ServerRequestFactory)->createServerRequest('GET', '/hello/test');
        $response = $router->handle($request);
        $this->assertEquals('{"name":"test"}', (string) $response->getBody());
    }
}
