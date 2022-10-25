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
use Unlock\Controller\CardController;

require __DIR__ . '/../vendor/autoload.php';

$container = require_once __DIR__ . '/../bootstrap.php';

AppFactory::setContainer($container);

$app = AppFactory::create();

$app->add(TwigMiddleware::createFromContainer($app));



error_reporting(E_ALL ^ E_DEPRECATED);


$app->get(
    '/',
    function (Request $rq, Response $rs): Response {
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'index.html');
    }
);


$app->get('/play', CardController::class . " :show");

$app->post('/display', function (Request $rq, Response $rs): Response {
    $id = strtoupper($rq->getParsedBody()['id']);
    if (isset($_SESSION["currents_cars"])) {
        if (!in_array($id, $_SESSION["currents_cars"]) && Utils\CardResolver::exist($id)) {
            $_SESSION["currents_cars"][] = $id;
        }
    }

    $rs = $rs->withStatus(302);
    return $rs->withHeader('Location', '/play');
});

$app->post('/hide', function (Request $rq, Response $rs): Response {
    $id = strtoupper($rq->getParsedBody()['id']);
    if (isset($_SESSION["currents_cars"])) {
        if (in_array($id, $_SESSION["currents_cars"])) {
            unset($_SESSION["currents_cars"][array_search($id, $_SESSION["currents_cars"])]);
        }
    }

    $rs = $rs->withStatus(302);
    return $rs->withHeader('Location', '/play');
});


try {
    $app->run();
} catch (Throwable $e) {
    echo $e->getMessage();
}
