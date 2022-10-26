<?php
namespace Unlock;

session_start();

use DateTime;
use DateTimeImmutable;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Throwable;

require __DIR__ . '/../vendor/autoload.php';

$container = require_once __DIR__ . '/../bootstrap.php';

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->add(TwigMiddleware::createFromContainer($app));



error_reporting(E_ALL ^ E_DEPRECATED);



$app->get('/', \App\Controller\GameController::class . ':start');


$app->get('/play', \App\Controller\CardController::class . ':show');
$app->post('/display', \App\Controller\CardController::class . ':addCard');
$app->get('/hide/{id}', \App\Controller\CardController::class . ':hideCard');
$app->post('/login', \App\Controller\UserController::class . ':login');
$app->post('/signup', \App\Controller\UserController::class . ':signup');
$app->get('/logout', \App\Controller\UserController::class . ':logout');
$app->get('/win', \App\Controller\GameController::class . ':win');
$app->get('/loose', \App\Controller\GameController::class . ':loose');



$app->get('/reset', function (Request $rq, Response $rs): Response {
    session_destroy();
    $rs = $rs->withStatus(302);
    return $rs->withHeader('Location', '/play');
});


try {
    $app->run();
} catch (Throwable $e) {
    echo $e->getMessage();
}
