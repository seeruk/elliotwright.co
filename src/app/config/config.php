<?php

return [
    'caching' => [
        'default' => 'memcached',
        'memcached' => [
            'host' => 'localhost',
            'port' => 11211
        ]
    ],
    'database' => [
        'default' => [
            'host' => 'localhost',
            'username' => 'tifa',
            'password' => '',
            'port' => '3306',
            'database' => 'Test'
        ]
    ],
    'twig' => [
        'cache_dir' => __DIR__.'/../cache/twig'
    ]
];
