<?php

/**
 * Application Configuration
 */
define("DOCROOT", dirname($_SERVER['DOCUMENT_ROOT']));
define("FRAMEWORK", DOCROOT . '/framework');
define("URL", $protocol . $_SERVER['HTTP_HOST']);

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
        'password_min_length' => 14
    ],
    'paths' => [
        'templates' => FRAMEWORK . '/templates',
        'views' => FRAMEWORK . '/views',
        'assets' => URL . '/assets',
        'uploads' => FRAMEWORK . '/uploads'
    ]
];