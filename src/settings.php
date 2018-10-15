<?php
return [
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'redis' => [
            'host' => getenv('REDIS_HOST'),
            'port' => 6379
        ]
    ],
];
