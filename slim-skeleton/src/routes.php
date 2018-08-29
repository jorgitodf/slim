<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/hello/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
})->add($auth);

$app->get('/users', function (Request $request, Response $response, array $args) {
    $table = $this->db->table('users');
    $users = $table->get();

    // Render index view
    return $this->renderer->render($response, 'users/index.phtml', ['users' => $users]);
})->add($auth);

$app->post('/users', function (Request $request, Response $response, array $args) {

    $data = [
        'name' => filter_input(INPUT_POST, 'name'),
        'email' => filter_input(INPUT_POST, 'email'),
        'password' => filter_input(INPUT_POST, 'password'),
    ];

    $table = $this->db->table('users');
    $users = $table->insert($data);

    // Render index view
    //return $this->renderer->render($response, 'users/index.phtml', ['users' => $users]);
    return $response->withStatus(302)->withHeader('Location', '/users');
})->add($auth);

$app->get('/users/{id}', function (Request $request, Response $response, array $args) {

    $id = $args['id'];

    $table = $this->db->table('users');
    $users = $table->where('id', $id)->delete($data);

    return $response->withStatus(302)->withHeader('Location', '/users');
})->add($auth);

/*
$app->get('/login', function ($request, $response) {
    $response->getBody()->write("Página de Login");
    return $response;
});
*/

$app->map(['GET', 'POST'], '/login', function ($request, $response) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $table = $this->db->table('users');
        $users = $table->where(['email' => $email, 'password' => $password])->get();
        if ($users->count()) {
            $_SESSION['user'] = (array)$users->first();
            return $response->withStatus(302)->withHeader('Location', '/users');
        }
    }
    return $this->renderer->render($response, 'users/login.phtml');
});