<?php

use Symfony\Component\Yaml\Yaml;

require './vendor/autoload.php';

$schema = Yaml::parseFile('tmp/pdns-authoritative-api-swagger.yaml');

(new OUTRAGEdns\PdnsProxy\Dev\HttpMiddlewareGenerator($schema))->build();
