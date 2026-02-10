<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/**
 * Resolve the Laravel base path.
 *
 * This handles two deployment scenarios:
 * 1. Local development: Laravel root is one level above `public` (../)
 * 2. Production (cPanel): Laravel core is in `/home/USER/laravel` while
 *    `public_html` contains only the `public` folder contents.
 *
 * The script checks both locations and uses the one that contains vendor/autoload.php
 */
$defaultPath = realpath(__DIR__ . '/..') ?: (__DIR__ . '/..');
$cpanelPath  = realpath(__DIR__ . '/../laravel') ?: (__DIR__ . '/../laravel');

// Determine which path contains the Laravel installation
$laravelBasePath = $defaultPath;

// Check if default path has Laravel (local development)
if (!file_exists($defaultPath . '/vendor/autoload.php')) {
    // Check cPanel path (production)
    if (file_exists($cpanelPath . '/vendor/autoload.php')) {
        $laravelBasePath = $cpanelPath;
    } else {
        // Neither path works - this is a critical error
        http_response_code(500);
        die('Error: Laravel installation not found. Checked: ' . $defaultPath . ' and ' . $cpanelPath);
    }
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = $laravelBasePath . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require $laravelBasePath . '/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once $laravelBasePath . '/bootstrap/app.php';

$app->handleRequest(Request::capture());
