<?php
// MainApp/Config/config.sample.php

declare(strict_types=1);

return [
    /* Application Settings */
    'app' => [
        'name' => env('APP_NAME', 'My Application'),
        'env' => env('APP_ENV', 'production'),
        'debug' => (bool)env('APP_DEBUG', false),
        'url' => env('APP_URL', 'http://localhost'),
        'uri_prefix' => env('URI_PREFIX', ''),
        'uri_fixer' => env('URI_PREFIX', ''),
        'timezone' => env('APP_TIMEZONE', 'Europe/Moscow'),
        'locale' => env('APP_LOCALE', 'ru'),
        'faker_locale' => env('FAKER_LOCALE', 'ru_RU'),
        'allowed_methods' => explode(',', env('ALLOWED_METHODS', 'GET,POST')),
        'auth' => [
            'path' => env('AUTH_PATH', '/auth'),
            'timeout' => (int)env('AUTH_TIMEOUT', 120),
            'ldap_enabled' => (bool)env('LDAP_ENABLED', false), // По умолчанию лучше false
        ],
    ],

    /* Database Configuration */
    'database' => [
        'default' => env('DB_CONNECTION', 'pgsql'),

        'connections' => [
            'default' => [
                'driver' => 'pgsql',
                'host' => env('DB_HOST', 'localhost'),
                'port' => env('DB_PORT', '5432'),
                'database' => env('DB_DATABASE', ''),
                'username' => env('DB_USERNAME', ''),
                'password' => env('DB_PASSWORD', ''),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'schema' => 'public',
                'sslmode' => 'prefer',
            ],

            'monitor' => [
                'driver' => 'pgsql',
                'host' => env('DB_MONITOR_HOST', ''),
                'database' => env('DB_MONITOR_NAME', ''),
                'username' => env('DB_MONITOR_USER', ''),
                'password' => env('DB_MONITOR_PASS', ''),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
            ],

            'mysql' => [
                'driver' => 'mysql',
                'host' => env('DB_HOST', 'localhost'),
                'port' => env('DB_PORT', '3306'),
                'database' => env('DB_DATABASE', ''),
                'username' => env('DB_USERNAME', ''),
                'password' => env('DB_PASSWORD', ''),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'strict' => true,
                'engine' => 'InnoDB',
            ],
        ],

        'migrations' => 'migrations',
    ],

    /* LDAP Configuration */
    'ldap' => [
        'enabled' => (bool)env('LDAP_ENABLED', false),
        'log' => (bool)env('LDAP_LOG', false),
        'cache' => (bool)env('LDAP_CACHE', true),

        'connections' => [
            'default' => [
                'hosts' => array_filter([
                    env('AD_SERVER_1', ''),
                    env('AD_SERVER_2', '')
                ]),
                'base_dn' => env('AD_BASE_DN', ''),
                'username' => env('AD_USERNAME', ''),
                'password' => env('AD_PASSWORD', ''),
                'port' => (int)env('AD_PORT', 389),
                'timeout' => (int)env('AD_TIMEOUT', 5),
                'use_ssl' => (bool)env('AD_USE_SSL', false),
                'use_tls' => (bool)env('AD_USE_TLS', true),
                'version' => (int)env('AD_VERSION', 3),
                'domain' => env('AD_DOMAIN', ''),
            ],
        ],
    ],

    /* Middleware Configuration */
    'middleware' => [
        'global' => [
            \MainApp\Middlewares\AuthViewMiddleware::class,
        ],
        'groups' => [
            'web' => [],
            'api' => [],
        ],
        'aliases' => [],
    ],

    /* Cache Configuration */
	'cache' => [
		'default' => env('CACHE_DRIVER', 'file'),
		'stores' => [
			'file' => [
				'driver' => 'file',
				'path' => APP_DIR.'cache/',
			],
			'redis' => [
				'driver' => 'redis',
				'host' => env('REDIS_HOST', '127.0.0.1'),
				'port' => env('REDIS_PORT', 6379),
				'database' => env('REDIS_DATABASE', 0),
			],
			'apcu' => [
				'driver' => 'apcu',
			]
		],
		'prefix' => env('CACHE_PREFIX', 'app_cache'),
	],

    /* Session Configuration */
    'session' => [
        'driver' => env('SESSION_DRIVER', 'file'),
        'lifetime' => (int)env('SESSION_LIFETIME', 120),
        'expire_on_close' => (bool)env('SESSION_EXPIRE_ON_CLOSE', false),
        'encrypt' => (bool)env('SESSION_ENCRYPT', false),
        'files' => __DIR__.'/../../storage/sessions',
        'cookie' => env('SESSION_COOKIE', 'app_session'),
    ],
];
