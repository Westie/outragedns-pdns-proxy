<?php

namespace OUTRAGEdns\PdnsProxy\Http;

use OUTRAGEdns\PdnsProxy\Api\AclException;
use OUTRAGEdns\PdnsProxy\Api\RequestHandler;
use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ApiMiddleware extends ApiMiddlewareAbstract
{
    private $requestHandler;
    private $responseFactory;

    /**
     *  Constructor
     */
    public function __construct(RequestHandler $requestHandler, ResponseFactoryInterface $responseFactory)
    {
        $this->requestHandler = $requestHandler;
        $this->responseFactory = $responseFactory;
    }

    /**
     *  PowerDNS API router
     */
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $requestMethod = strtolower($request->getMethod());
        $requestUrl = parse_url($request->getRequestTarget(), PHP_URL_PATH);

        try {
            foreach ($this->getRoutes() as $routePath => $route) {
                if (preg_match($routePath, $requestUrl)) {
                    if (isset($route[$requestMethod])) {
                        return $this->handle($request, $route[$requestMethod]);
                    } elseif ($requestMethod === 'options') {
                        return $this->handleOptions($request);
                    }
                }
            }
        } catch (RequestExceptionInterface $exception) {
            return $this->handleRequestException($exception);
        } catch (AclException $exception) {
            return $this->handleAclException($exception);
        }

        return $handler->handle($request);
    }

    /**
     *  Deal with a successful match
     */
    protected function handle(ServerRequestInterface $request, array $route): ResponseInterface
    {
        return $this->requestHandler->handle($request, $route);
    }

    /**
     *  Deal with CORS requests
     */
    protected function handleOptions(ServerRequestInterface $request): ResponseInterface
    {
        return $this->responseFactory->createResponse(200)
            ->withHeader('Access-Control-Allow-Headers', 'X-Api-Key')
            ->withHeader('Access-Control-Allow-Methods', '*')
            ->withHeader('Access-Control-Allow-Origin', '*');
    }

    /**
     *  Handle network exception
     */
    protected function handleRequestException(RequestExceptionInterface $exception): ResponseInterface
    {
        return $exception->getResponse();
    }

    /**
     *  Handle ACL exception
     */
    protected function handleAclException(AclException $exception): ResponseInterface
    {
        $response = $this->responseFactory->createResponse(403);
        $response->getBody()->write($exception->getMessage());

        return $response;
    }
}
