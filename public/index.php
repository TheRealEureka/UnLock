<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

error_reporting(E_ALL ^ E_DEPRECATED);

$app->get('/',
    function (Request $rq, Response $rs): Response {
        $rs->getBody()->write("Aled");
        return $rs;
});

try {
    $app->run();
} catch (Throwable $e) {
    echo $e->getMessage();
}