<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Create Container using PHP-DI
$settings = require __DIR__ . '/../src/settings.php';
use DI\Container;
use DI\ContainerBuilder;
$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(['settings' => $settings]);
$container = $containerBuilder->build();


// Instantiate the app
use Slim\Factory\AppFactory;
AppFactory::setContainer($container);
$app = AppFactory::create();

// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();
