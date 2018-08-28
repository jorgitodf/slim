<?php

$container = $app->getContainer();

$container['renderer'] = function($c) {
    $settings = $c->get('settings')['renderer'];
    return new \Slim\View\PhpRenderer($settings['template_path']);
};
