<?php

namespace OUTRAGEdns\PdnsProxy\Api;

use Psr\Http\Message\RequestInterface;

interface EnvironmentFactoryInterface
{
    /**
     *  Create environment
     */
    public function createEnvironment(RequestInterface $request): EnvironmentInterface;
}
