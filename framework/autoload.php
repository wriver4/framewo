<?php

/**
 * Framework Autoloader
 * 
 * Simple autoloader for framework classes
 */

spl_autoload_register(function ($class) {
    $framework_root = __DIR__;
    
    // Define class directories
    $directories = [
        $framework_root . '/classes/',
        $framework_root . '/examples/classes/'
    ];
    
    foreach ($directories as $directory) {
        $file = $directory . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Load configuration
if (!defined('FRAMEWORK_CONFIG')) {
    define('FRAMEWORK_CONFIG', require_once __DIR__ . '/config/app.php');
}