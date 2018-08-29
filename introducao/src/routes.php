<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->get('/hello', function() {
    return 'Hello Word';

});

$app->get('/{name}', function(Request $request, Response $response, $args) {
    $this->logger->info("Slim-App / route");
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/hello/[{name}]', function(Request $request, Response $response) {
    $name = $request->getAttribute('name') ?? 'World';
    return $response;
});
