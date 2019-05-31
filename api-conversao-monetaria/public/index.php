<?php
if (PHP_SAPI === 'cli-server') {
    $_SERVER['SCRIPT_NAME'] = pathinfo(__FILE__, PATHINFO_BASENAME);
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);
unset($app->getContainer()['errorHandler']);
unset($app->getContainer()['phpErrorHandler']);

// Set up dependencies
$dependencies = require __DIR__ . '/../src/dependencies.php';
$dependencies($app);

// Register middleware
$middleware = require __DIR__ . '/../src/middleware.php';
$middleware($app);

// Register routes
$routes = require __DIR__ . '/../src/routes.php';
$routes($app);

// Run app
$app->run();
