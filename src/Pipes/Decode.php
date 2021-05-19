<?php

namespace OUTRAGEdns\PdnsProxy\Pipes;

class Decode
{
    /**
     *  Encode data
     */
    public function __invoke(string $body): array
    {
        return json_decode($body, true);
    }
}
