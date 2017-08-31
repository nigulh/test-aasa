<?php
require_once 'vendor/autoload.php';
require_once 'controllers/ContractController.php';
require_once 'controllers/AboutController.php';

$loader = new Twig_Loader_Filesystem('./templates');
$twig = new Twig_Environment($loader);
$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
    'twig' => $twig,
];

$container = new \Slim\Container($configuration);
$app = new \Slim\App($container);

$app->get('/about', \AboutController::class . ':about');
$app->get('/apply', \ContractController::class . ':init');
$app->post('/apply', \ContractController::class . ':create');

$app->run();