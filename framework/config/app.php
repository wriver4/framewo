<?php

/**
 * Application Configuration
 */

return [
    'name' => 'Framework Application',
    'version' => '1.0.0',
    'debug' => true,
    'timezone' => 'UTC',
    'session' => [
        'timeout' => 3600, // 1 hour
        'name' => 'framework_session'
    ],
    'security' => [
        'csrf_protection' => true,
        'password_min_length' => 6
    ],
    'paths' => [
        'templates' => __DIR__ . '/../templates',
        'assets' => __DIR__ . '/../assets',
        'uploads' => __DIR__ . '/../uploads'
    ]
];