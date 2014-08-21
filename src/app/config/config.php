<?php

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
            'host' => '192.168.50.20',
            'username' => 'tifa',
            'password' => '',
            'port' => '3306',
            'database' => 'elliotwright'
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
