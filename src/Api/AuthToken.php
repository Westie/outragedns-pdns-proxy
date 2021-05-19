<?php

namespace OUTRAGEdns\PdnsProxy\Api;

class AuthToken implements AuthTokenInterface
{
    private $account;
    private $apiKey;

    /**
     *  Constructor
     */
    public function __construct(string $account, string $apiKey)
    {
        $this->account = $account;
        $this->apiKey = $apiKey;
    }

    /**
     *  Get account
     */
    public function getAccount(): string
    {
        return $this->account;
    }

    /**
     *  Get API key (for this account only)
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }
}
