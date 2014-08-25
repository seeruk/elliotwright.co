<?php

$dbHost = '192.168.50.20';
$dbPort = '3306';
$dbUser = 'tifa';
$dbPass = '';
$dbName = 'elliotwright';

return [
    'app' => [
        'site_name' => 'Elliot Wright'
    ],
    'caching' => [
        'default' => 'memcached',
        'memcached' => [
            'host' => '192.168.50.30',
            'port' => 11211
        ]
    ],
    'database' => [
        'default' => [
            'host'     => $dbHost,
            'port'     => $dbPort,
            'username' => $dbUser,
            'password' => $dbPass,
            'database' => $dbName
        ]
    ],
    'migrations' => [
        'paths' => [
            'migrations' => __DIR__.'/../migrations'
        ],
        'environments' => [
            'default_migration_table' => 'migrations_tracking',
            'default_database' => 'dev',
            'prod' => [
                'adapter' => 'mysql',
                'host'    => $dbHost,
                'name'    => $dbName,
                'user'    => $dbUser,
                'pass'    => $dbPass,
                'port'    => $dbPort,
                'charset' => 'utf8'
            ],
            'dev' => [
                'adapter' => 'mysql',
                'host'    => $dbHost,
                'name'    => $dbName,
                'user'    => $dbUser,
                'pass'    => $dbPass,
                'port'    => $dbPort,
                'charset' => 'utf8'
            ]
        ]
    ],
    'security' => [
        'forms' => [
            'csrf_secret' => 'OZBip2b!#l%7bq%0&ZivT@PYPUceZVdo'
        ],
        'login_route' => 'sm_authentication_login'
    ],
    'twig' => [
        'cache_dir' => __DIR__.'/../cache/twig'
    ]
];
