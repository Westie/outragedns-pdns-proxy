<?php

namespace OUTRAGEdns\PdnsProxy\Api;

interface AclInterface
{
    /**
     *  Can this user/session perform this action?
     */
    public function can(string $operationId, array $constraints = []): bool;
}
