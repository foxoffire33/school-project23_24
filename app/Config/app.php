<?php
return [
    'name' => getenv("APP_NAME"),
    'key' => getenv("APP_KEY"),
    'cache' => [
        'host' => getenv('CACHE_HOST'),
        'port' => getenv('CACHE_PORT')
    ],
    'database' => [
        'name' => getenv("DB_DATABASE"),
        'username' => getenv("DB_USERNAME"),
        'password' => getenv("DB_PASSWORD"),
        'host' => getenv("DB_HOST"),
    ]
];