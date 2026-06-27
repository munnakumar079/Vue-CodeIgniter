<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Cross-Origin Resource Sharing (CORS) Configuration
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
 */
class Cors extends BaseConfig
{

public array $default = [
    'allowedOrigins' => ['http://localhost:5173'],
    'allowedOriginsPatterns' => [],
    'supportsCredentials' => false,
    'allowedHeaders' => ['*'],
    'exposedHeaders' => [],
    'allowedMethods' => [
        'GET',
        'POST',
        'PUT',
        'PATCH',
        'DELETE',
        'OPTIONS',
    ],
    'maxAge' => 7200,
];
}
