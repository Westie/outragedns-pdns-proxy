<?php

namespace OUTRAGEdns\PdnsProxy\Api;

use Exception;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;

class ProxyRequestFactory
{
    private $requestFactory;

    /**
     *  Constructor
     */
    public function __construct(RequestFactoryInterface $requestFactory)
    {
        $this->requestFactory = $requestFactory;
    }

    /**
     *  Create API request
     */
    public function createRequest(EnvironmentInterface $environment, RequestInterface $request, array $route): RequestInterface
    {
        $requestParameters = [];
        $requestUrl = parse_url($request->getRequestTarget(), PHP_URL_PATH);
        $requestQueryParameters = parse_url($request->getRequestTarget(), PHP_URL_QUERY);

        // we need to sanitise the parameters that have been passed in the matches array as this
        // will include numerical keys (not something that is needed)
        if (!empty($route['parameters'])) {
            $pathKeys = [];

            preg_match($route['routePath'], $requestUrl, $requestParameters);

            foreach ($route['parameters'] as $parameter) {
                if ($parameter['in'] === 'path') {
                    $pathKeys[$parameter['name']] = true;
                }
            }

            $requestParameters = array_intersect_key($requestParameters, $pathKeys);
        }

        // check to see if we can actually run this request
        if (!$environment->can($route['operationId'], $requestParameters)) {
            throw new AclException('Permission denied for operation ' . $route['operationId']);
        }

        // mess around with some paths
        $targetPath = $route['apiPath'];

        if (!empty($requestParameters)) {
            foreach ($requestParameters as $key => $value) {
                $targetPath = str_replace('{' . $key . '}', $value, $targetPath);
            }
        }

        if (!empty($requestQueryParameters)) {
            parse_str($requestQueryParameters, $requestQueryParameters);

            $pipeline = $environment->getRequestQueryPipelineProvider()->build($route['operationId']);

            if (!empty($pipeline)) {
                $requestQueryParameters = $pipeline->process($requestQueryParameters);
            }

            $requestQueryParameters = '?' . http_build_query($requestQueryParameters);
        }

        // generate our proxy request
        $proxyRequestUrl = $environment->getBaseUrl() . $targetPath . $requestQueryParameters;

        $clone = $this->requestFactory->createRequest($request->getMethod(), $proxyRequestUrl)
            ->withHeader('User-Agent', 'OUTRAGEdns-Pdns-Proxy')
            ->withHeader('X-Api-Key', $environment->getBaseApiKey());

        // we may need to modify our body at certain points so we'll add in pipelines in order to
        // account for this
        $requestBody = (string) $request->getBody();

        if (!empty($requestBody)) {
            $pipeline = $environment->getRequestBodyPipelineProvider()->build($route['operationId']);

            if (!empty($pipeline)) {
                $requestBody = $pipeline->process($requestBody);
            }
        }

        $clone->getBody()->write($requestBody);

        return $clone;
    }
}
