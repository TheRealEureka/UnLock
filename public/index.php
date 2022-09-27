<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\App;
use Slim\Container;

require 'vendor/autoload.php';


error_reporting(E_ALL ^ E_DEPRECATED);

$container = new Container(['settings' => ['displayErrorDetails' => true]]);
$app = new App($container);
//DEFAULT
$app->get('/',
    function (Request $rq, Response $rs): Response {
    return $rs->write("aled");
});

try {
    $app->run();
} catch (Throwable $e) {
    echo $e->getMessage();
}