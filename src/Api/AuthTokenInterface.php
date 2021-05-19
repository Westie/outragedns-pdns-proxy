<?php

namespace OUTRAGEdns\PdnsProxy\Api;

interface AuthTokenInterface
{
    /**
     *  Get account
     */
    public function getAccount(): string;

    /**
     *  Get API key (for this account only)
     */
    public function getApiKey(): string;
}
