#!/bin/bash

mkdir -p tmp
curl https://raw.githubusercontent.com/PowerDNS/pdns/master/docs/http-api/swagger/authoritative-api-swagger.yaml -o tmp/pdns-authoritative-api-swagger.yaml
