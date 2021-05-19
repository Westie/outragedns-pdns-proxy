<?php

namespace OUTRAGEdns\PdnsProxy\Pipes;

class Encode
{
    /**
     *  Encode data
     */
    public function __invoke(array $body): string
    {
        return json_encode($body);
    }
}
