<?php

namespace OUTRAGEdns\PdnsProxy\Http;

use OUTRAGEdns\PdnsProxy\Api\EnvironmentFactoryInterface;
use OUTRAGEdns\PdnsProxy\Api\ProxyRequestFactory;
use OUTRAGEdns\PdnsProxy\Api\RequestHandler;
use Psr\Container\ContainerInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;

class ApiMiddlewareFactory
{
    /**
     *  Create API middleware from container
     */
    public function createFromContainer(ContainerInterface $container): ApiMiddleware
    {
        $environmentFactory = $container->get(EnvironmentFactoryInterface::class);
        $httpClient = $container->get(ClientInterface::class);
        $requestFactory = $container->get(RequestFactoryInterface::class);
        $responseFactory = $container->get(ResponseFactoryInterface::class);

        $proxyRequestFactory = new ProxyRequestFactory($requestFactory);

        $requestHandler = new RequestHandler(
            $environmentFactory,
            $httpClient,
            $proxyRequestFactory,
            $requestFactory,
            $responseFactory
        );

        return new ApiMiddleware($requestHandler, $responseFactory);
    }
}
