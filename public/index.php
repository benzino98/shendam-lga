<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/**
 * Resolve the Laravel base path.
 *
 * Locally, the app lives one level above `public` (../).
 * On production (cPanel), the core app is deployed to `/home/shendam/laravel`
 * while `public_html` contains only the `public` folder contents.
 */
$laravelBasePath = realpath(__DIR__ . '/..') ?: (__DIR__ . '/..');
$altBasePath     = realpath(__DIR__ . '/../laravel') ?: (__DIR__ . '/../laravel');

// If the default vendor path does not exist, fall back to the /laravel directory
if (! file_exists($laravelBasePath . '/vendor/autoload.php') && file_exists($altBasePath . '/vendor/autoload.php')) {
    $laravelBasePath = $altBasePath;
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
