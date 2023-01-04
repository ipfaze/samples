<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    $logger = $this->get('logger');
    $renderer = $this->get('renderer');

    // Sample log message
    $logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $renderer->render($response, 'index.phtml', $args);
});
