<?php

namespace OUTRAGEdns\PdnsProxy\Http;

abstract class ApiMiddlewareAbstract
{
    /**
     * Retrieve a list of available routes - automatically generated, do not change
     */
    final protected function getRoutes(): array
    {
        return [
            '@^/api/v1/error/?$@' => [
                'get' => [
                    'operationId' => 'error',
                    'apiPath' => '/api/v1/error',
                    'routePath' => '@^/api/v1/error/?$@'
                ]
            ],
            '@^/api/v1/servers/?$@' => [
                'get' => [
                    'operationId' => 'listServers',
                    'tags' => [
                        'servers'
                    ],
                    'apiPath' => '/api/v1/servers',
                    'routePath' => '@^/api/v1/servers/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@' => [
                'get' => [
                    'operationId' => 'listServer',
                    'tags' => [
                        'servers'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/cache/flush/?$@' => [
                'put' => [
                    'operationId' => 'cacheFlushByName',
                    'tags' => [
                        'servers'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'domain',
                            'in' => 'query',
                            'required' => true,
                            'type' => 'string'
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/cache/flush',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/cache/flush/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/?$@' => [
                'get' => [
                    'operationId' => 'listZones',
                    'tags' => [
                        'zones'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone',
                            'in' => 'query',
                            'required' => false,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'dnssec',
                            'in' => 'query',
                            'required' => false,
                            'type' => 'boolean',
                            'default' => true
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/?$@'
                ],
                'post' => [
                    'operationId' => 'createZone',
                    'tags' => [
                        'zones'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'rrsets',
                            'in' => 'query',
                            'type' => 'boolean',
                            'default' => true
                        ],
                        [
                            'name' => 'zone_struct',
                            'required' => true,
                            'in' => 'body',
                            'schema' => [
                                '$ref' => '#/definitions/Zone'
                            ]
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@' => [
                'get' => [
                    'operationId' => 'listZone',
                    'tags' => [
                        'zones'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ],
                        [
                            'name' => 'rrsets',
                            'in' => 'query',
                            'type' => 'boolean',
                            'default' => true
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@'
                ],
                'delete' => [
                    'operationId' => 'deleteZone',
                    'tags' => [
                        'zones'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@'
                ],
                'patch' => [
                    'operationId' => 'patchZone',
                    'tags' => [
                        'zones'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ],
                        [
                            'name' => 'zone_struct',
                            'required' => true,
                            'in' => 'body',
                            'schema' => [
                                '$ref' => '#/definitions/Zone'
                            ]
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@'
                ],
                'put' => [
                    'operationId' => 'putZone',
                    'tags' => [
                        'zones'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ],
                        [
                            'name' => 'zone_struct',
                            'required' => true,
                            'in' => 'body',
                            'schema' => [
                                '$ref' => '#/definitions/Zone'
                            ]
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/notify/?$@' => [
                'put' => [
                    'operationId' => 'notifyZone',
                    'tags' => [
                        'zones'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}/notify',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/notify/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/axfr-retrieve/?$@' => [
                'put' => [
                    'operationId' => 'axfrRetrieveZone',
                    'tags' => [
                        'zones'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}/axfr-retrieve',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/axfr-retrieve/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/export/?$@' => [
                'get' => [
                    'operationId' => 'axfrExportZone',
                    'tags' => [
                        'zones'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}/export',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/export/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/rectify/?$@' => [
                'put' => [
                    'operationId' => 'rectifyZone',
                    'tags' => [
                        'zones'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}/rectify',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/rectify/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/config/?$@' => [
                'get' => [
                    'operationId' => 'getConfig',
                    'tags' => [
                        'config'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/config',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/config/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/config/(?<config_setting_name>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@' => [
                'get' => [
                    'operationId' => 'getConfigSetting',
                    'tags' => [
                        'config'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'config_setting_name',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/config/{config_setting_name}',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/config/(?<config_setting_name>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/statistics/?$@' => [
                'get' => [
                    'operationId' => 'getStats',
                    'tags' => [
                        'stats'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'statistic',
                            'in' => 'query',
                            'required' => false,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'includerings',
                            'in' => 'query',
                            'required' => false,
                            'type' => 'boolean',
                            'default' => true
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/statistics',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/statistics/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/search-data/?$@' => [
                'get' => [
                    'operationId' => 'searchData',
                    'tags' => [
                        'search'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'q',
                            'in' => 'query',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'max',
                            'in' => 'query',
                            'required' => true,
                            'type' => 'integer'
                        ],
                        [
                            'name' => 'object_type',
                            'in' => 'query',
                            'required' => false,
                            'type' => 'string'
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/search-data',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/search-data/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/metadata/?$@' => [
                'get' => [
                    'operationId' => 'listMetadata',
                    'tags' => [
                        'zonemetadata'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}/metadata',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/metadata/?$@'
                ],
                'post' => [
                    'operationId' => 'createMetadata',
                    'tags' => [
                        'zonemetadata'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ],
                        [
                            'name' => 'metadata',
                            'required' => true,
                            'in' => 'body',
                            'schema' => [
                                '$ref' => '#/definitions/Metadata'
                            ]
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}/metadata',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/metadata/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/metadata/(?<metadata_kind>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@' => [
                'get' => [
                    'operationId' => 'getMetadata',
                    'tags' => [
                        'zonemetadata'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ],
                        [
                            'name' => 'metadata_kind',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}/metadata/{metadata_kind}',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/metadata/(?<metadata_kind>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@'
                ],
                'put' => [
                    'operationId' => 'modifyMetadata',
                    'tags' => [
                        'zonemetadata'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ],
                        [
                            'name' => 'metadata_kind',
                            'required' => true,
                            'type' => 'string',
                            'in' => 'path'
                        ],
                        [
                            'name' => 'metadata',
                            'required' => true,
                            'in' => 'body',
                            'schema' => [
                                '$ref' => '#/definitions/Metadata'
                            ]
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}/metadata/{metadata_kind}',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/metadata/(?<metadata_kind>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@'
                ],
                'delete' => [
                    'operationId' => 'deleteMetadata',
                    'tags' => [
                        'zonemetadata'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ],
                        [
                            'name' => 'metadata_kind',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}/metadata/{metadata_kind}',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/metadata/(?<metadata_kind>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/cryptokeys/?$@' => [
                'get' => [
                    'operationId' => 'listCryptokeys',
                    'tags' => [
                        'zonecryptokey'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}/cryptokeys',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/cryptokeys/?$@'
                ],
                'post' => [
                    'operationId' => 'createCryptokey',
                    'tags' => [
                        'zonecryptokey'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ],
                        [
                            'name' => 'cryptokey',
                            'required' => true,
                            'in' => 'body',
                            'schema' => [
                                '$ref' => '#/definitions/Cryptokey'
                            ]
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}/cryptokeys',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/cryptokeys/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/cryptokeys/(?<cryptokey_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@' => [
                'get' => [
                    'operationId' => 'getCryptokey',
                    'tags' => [
                        'zonecryptokey'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ],
                        [
                            'name' => 'cryptokey_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}/cryptokeys/{cryptokey_id}',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/cryptokeys/(?<cryptokey_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@'
                ],
                'put' => [
                    'operationId' => 'modifyCryptokey',
                    'tags' => [
                        'zonecryptokey'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ],
                        [
                            'name' => 'cryptokey_id',
                            'required' => true,
                            'in' => 'path',
                            'type' => 'string'
                        ],
                        [
                            'name' => 'cryptokey',
                            'required' => true,
                            'in' => 'body',
                            'schema' => [
                                '$ref' => '#/definitions/Cryptokey'
                            ]
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}/cryptokeys/{cryptokey_id}',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/cryptokeys/(?<cryptokey_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@'
                ],
                'delete' => [
                    'operationId' => 'deleteCryptokey',
                    'tags' => [
                        'zonecryptokey'
                    ],
                    'parameters' => [
                        [
                            'name' => 'server_id',
                            'in' => 'path',
                            'required' => true,
                            'type' => 'string'
                        ],
                        [
                            'name' => 'zone_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ],
                        [
                            'name' => 'cryptokey_id',
                            'type' => 'string',
                            'in' => 'path',
                            'required' => true
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/zones/{zone_id}/cryptokeys/{cryptokey_id}',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/zones/(?<zone_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/cryptokeys/(?<cryptokey_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/tsigkeys/?$@' => [
                'parameters' => [
                    0 => [
                        'name' => 'server_id',
                        'in' => 'path',
                        'required' => true,
                        'type' => 'string'
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/tsigkeys',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/tsigkeys/?$@'
                ],
                'get' => [
                    'operationId' => 'listTSIGKeys',
                    'tags' => [
                        'tsigkey'
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/tsigkeys',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/tsigkeys/?$@'
                ],
                'post' => [
                    'operationId' => 'createTSIGKey',
                    'tags' => [
                        'tsigkey'
                    ],
                    'parameters' => [
                        [
                            'name' => 'tsigkey',
                            'required' => true,
                            'in' => 'body',
                            'schema' => [
                                '$ref' => '#/definitions/TSIGKey'
                            ]
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/tsigkeys',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/tsigkeys/?$@'
                ]
            ],
            '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/tsigkeys/(?<tsigkey_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@' => [
                'parameters' => [
                    0 => [
                        'name' => 'server_id',
                        'in' => 'path',
                        'required' => true,
                        'type' => 'string'
                    ],
                    1 => [
                        'name' => 'tsigkey_id',
                        'in' => 'path',
                        'required' => true,
                        'type' => 'string'
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/tsigkeys/{tsigkey_id}',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/tsigkeys/(?<tsigkey_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@'
                ],
                'get' => [
                    'operationId' => 'getTSIGKey',
                    'tags' => [
                        'tsigkey'
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/tsigkeys/{tsigkey_id}',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/tsigkeys/(?<tsigkey_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@'
                ],
                'put' => [
                    'operationId' => 'putTSIGKey',
                    'tags' => [
                        'tsigkey'
                    ],
                    'parameters' => [
                        [
                            'name' => 'tsigkey',
                            'schema' => [
                                '$ref' => '#/definitions/TSIGKey'
                            ],
                            'in' => 'body',
                            'required' => true
                        ]
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/tsigkeys/{tsigkey_id}',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/tsigkeys/(?<tsigkey_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@'
                ],
                'delete' => [
                    'operationId' => 'deleteTSIGKey',
                    'tags' => [
                        'tsigkey'
                    ],
                    'apiPath' => '/api/v1/servers/{server_id}/tsigkeys/{tsigkey_id}',
                    'routePath' => '@^/api/v1/servers/(?<server_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/tsigkeys/(?<tsigkey_id>[A-Za-z0-9\\-\\_\\.\\@]*?)/?$@'
                ]
            ]
        ];
    }
}
