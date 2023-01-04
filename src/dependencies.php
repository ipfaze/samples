<?php
// DIC configuration
use Slim\Views\PhpRenderer;

// view renderer
$container->set('renderer', function () {
    global $settings;
    $rendererSettings = $settings['settings']['renderer'];

    return new PhpRenderer($rendererSettings['template_path']);
});


// monolog
$container->set('logger', function () {
    global $settings;
    $loggerSettings = $settings['settings']['logger'];
    
    $logger = new Monolog\Logger($loggerSettings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($loggerSettings['path'], $loggerSettings['level']));
    return $logger;
});
