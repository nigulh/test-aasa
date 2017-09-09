<?php

chdir(dirname(__DIR__));
require_once 'vendor/autoload.php';
require_once 'app/autoload.php';

$loader = new Twig_Loader_Filesystem('app/templates');
$twig = new Twig_Environment($loader);
$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
    'twig' => $twig,
];

$container = new Slim\Container($configuration);
$app = new Slim\App($container);

$app->get('/about', App\Controllers\AboutController::class . ':about');
$app->get('/apply', App\Controllers\ContractController::class . ':init');
$app->post('/apply', App\Controllers\ContractController::class . ':create');

$app->run();