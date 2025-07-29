<?php

/**
 * Database Configuration
 * 
 * Configure your database connection settings here.
 * Copy this file and rename it to match your environment.
 */

return [
    'host' => 'localhost',
    'database' => 'framewo_framewo',
    'username' => 'framewo_framew',
    'password' => 'Mg6ti4EovrYa311',
    'charset' => 'utf8mb4',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
];