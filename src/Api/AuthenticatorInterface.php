<?php

namespace OUTRAGEdns\PdnsProxy\Api;

interface AuthenticatorInterface
{
    /**
     *  Authenticate a user and return some credential information
     */
    public function authenticateToken(string $token): AuthTokenInterface;
}
