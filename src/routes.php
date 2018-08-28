<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->get('/hello', function() {
    return 'Hello Word';

});

$app->get('/{name}', function(Request $request, Response $response, $args) {
    var_dump($args);
    return '';
});

$app->get('/hello/[{name}]', function(Request $request, Response $response) {
    $name = $request->getAttribute('name') ?? 'World';
    return $response;
});
