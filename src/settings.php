<?php
return [
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'redis' => [
            'host' => getenv('REDIS_HOST'),
            'port' => 6379
        ],
        'access' => [
            'token' => getenv('ACCESS_TOKEN') ? getenv('ACCESS_TOKEN') : ""
        ]
    ]
];
