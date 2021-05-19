<?php

namespace OUTRAGEdns\PdnsProxy\Api;

interface EnvironmentInterface
{
    /**
     *  Get environment ACL
     */
    public function getAcl(): AclInterface;

    /**
     *  Get environment account
     */
    public function getAccount(): ?string;

    /**
     *  Get environment ApiKey
     */
    public function getBaseApiKey(): string;

    /**
     *  Get environment BaseUrl
     */
    public function getBaseUrl(): string;

    /**
     *  Get environment request body pipeline
     */
    public function getRequestBodyPipelineProvider(): PipelineProvider;

    /**
     *  Get environment request query pipeline
     */
    public function getRequestQueryPipelineProvider(): PipelineProvider;

    /**
     *  Get environment response body pipeline
     */
    public function getResponseBodyPipelineProvider(): PipelineProvider;

    /**
     *  Can this user/environment perform this action?
     */
    public function can(string $operationId, array $constraints = []): bool;
}
