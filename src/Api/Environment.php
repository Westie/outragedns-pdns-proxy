<?php

namespace OUTRAGEdns\PdnsProxy\Api;

use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;

class Environment implements EnvironmentInterface
{
    private $account;
    private $acl;
    private $authenticator;
    private $baseApiKey;
    private $baseUrl;
    private $requestBodyPipelineProvider;
    private $requestQueryPipelineProvider;
    private $responseBodyPipelineProvider;

    /**
     *  Set environment account
     */
    public function setAccount(string $account): void
    {
        $this->account = $account;
    }

    /**
     *  Get environment account
     */
    public function getAccount(): ?string
    {
        return $this->account;
    }

    /**
     *  Set environment ACL
     */
    public function setAcl(AclInterface $acl): void
    {
        $this->acl = $acl;
    }

    /**
     *  Get environment ACL
     */
    public function getAcl(): AclInterface
    {
        return $this->acl;
    }

    /**
     *  Set authenticator
     */
    public function setAuthenticator(AuthenticatorInterface $authenticator): void
    {
        $this->authenticator = $authenticator;
    }

    /**
     *  Get authenticator
     */
    public function getAuthenticator(): ?AuthenticatorInterface
    {
        return $this->authenticator;
    }

    /**
     *  Set environment ApiKey
     */
    public function setBaseApiKey(string $baseApiKey): void
    {
        $this->baseApiKey = $baseApiKey;
    }

    /**
     *  Get environment ApiKey
     */
    public function getBaseApiKey(): string
    {
        return $this->baseApiKey;
    }

    /**
     *  Set environment BaseUrl
     */
    public function setBaseUrl(string $baseUrl): void
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     *  Get environment BaseUrl
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     *  Set environment request body pipeline
     */
    public function setRequestBodyPipelineProvider(PipelineProvider $requestBodyPipelineProvider): void
    {
        $this->requestBodyPipelineProvider = $requestBodyPipelineProvider;
    }

    /**
     *  Get environment request body pipeline
     */
    public function getRequestBodyPipelineProvider(): PipelineProvider
    {
        if (empty($this->requestBodyPipelineProvider)) {
            $this->requestBodyPipelineProvider = new PipelineProvider();
        }

        return $this->requestBodyPipelineProvider;
    }

    /**
     *  Set environment request query pipeline
     */
    public function setRequestQueryPipelineProvider(PipelineProvider $requestBodyPipelineProvider): void
    {
        $this->requestQueryPipelineProvider = $requestQueryPipelineProvider;
    }

    /**
     *  Get environment request query pipeline
     */
    public function getRequestQueryPipelineProvider(): PipelineProvider
    {
        if (empty($this->requestQueryPipelineProvider)) {
            $this->requestQueryPipelineProvider = new PipelineProvider();
        }

        return $this->requestQueryPipelineProvider;
    }

    /**
     *  Set environment response body pipeline
     */
    public function setResponseBodyPipelineProvider(PipelineProvider $responseBodyPipelineProvider): void
    {
        $this->responseBodyPipelineProvider = $responseBodyPipelineProvider;
    }

    /**
     *  Get environment response body pipeline
     */
    public function getResponseBodyPipelineProvider(): PipelineProvider
    {
        if (empty($this->responseBodyPipelineProvider)) {
            $this->responseBodyPipelineProvider = new PipelineProvider();
        }

        return $this->responseBodyPipelineProvider;
    }

    /**
     *  Can this user/environment perform this action?
     */
    public function can(string $operationId, array $constraints = []): bool
    {
        return $this->acl->can($operationId, $constraints);
    }
}
