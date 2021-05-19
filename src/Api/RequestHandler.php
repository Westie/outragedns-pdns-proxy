<?php

namespace OUTRAGEdns\PdnsProxy\Api;

use Exception;
use OUTRAGEdns\PdnsProxy\Api\PipelineProvider;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RequestHandler
{
    private $environmentFactory;
    private $httpClient;
    private $proxyRequestFactory;
    private $requestFactory;
    private $responseFactory;

    /**
     *  Constructor
     */
    public function __construct(
        EnvironmentFactoryInterface $environmentFactory,
        ClientInterface $httpClient,
        ProxyRequestFactory $proxyRequestFactory,
        RequestFactoryInterface $requestFactory,
        ResponseFactoryInterface $responseFactory
    ) {
        $this->environmentFactory = $environmentFactory;
        $this->httpClient = $httpClient;
        $this->proxyRequestFactory = $proxyRequestFactory;
        $this->requestFactory = $requestFactory;
        $this->responseFactory = $responseFactory;
    }

    /**
     *  Process the match, and return a response
     */
    public function handle(ServerRequestInterface $request, array $route): ResponseInterface
    {
        // create our session
        $environment = $this->environmentFactory->createEnvironment($request);

        // if no account has been defined, and there is an authenticator, then we can go ahead and
        // authenticate the environment based on the X-Api-Key header
        if ($environment->getAccount() === null) {
            $apiKey = $request->getHeaderLine('X-Api-Key');
            $apiAuthenticator = $environment->getAuthenticator();

            if (!empty($apiAuthenticator)) {
                $environment->setAccount($apiAuthenticator->authenticateToken($apiKey)->getAccount());
            }
        }

        // build our request
        $request = $this->proxyRequestFactory->createRequest($environment, $request, $route);

        // get our response, and mess about with changing the response if such a thing is
        // needed (hello masking data)
        $response = $this->httpClient->send($request);
        $responseBody = (string) $response->getBody();

        if (empty($responseBody)) {
            return $response;
        }

        // since we're unable to create a new stream, we'll be needing to create a cloned response
        // because thank you PSR
        $pipeline = $environment->getResponseBodyPipelineProvider()->build($route['operationId']);

        if (!empty($pipeline)) {
            $clone = $this->responseFactory->createResponse($response->getStatusCode());

            foreach ($response->getHeaders() as $header => $headerData) {
                if ($header !== 'Content-Length') {
                    $clone = $clone->withHeader($header, $headerData);
                }
            }

            $clone->getBody()->write($pipeline->process($responseBody));

            return $clone;
        }

        return $response;
    }
}
