<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);


$auth = function($request, $response, $next) {
    //$response->getBody()->write('BEFORE');
    if (isset($_SESSION['user']) && is_array($_SESSION['user'])) {
        $response = $next($request, $response);
    } else {
        $response = $response->withStatus(401)->write('Page protected');
    }
    
    //$response->getBody()->write('AFTER');

    return $response;
};

//$app->add($auth);