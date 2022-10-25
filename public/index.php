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

//Auto load
require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$container = require __DIR__ . '/../bootstrap.php';
AppFactory::setContainer($container);


try {
    $twig = Twig::create('view/', ['cache' => false]);
    $app->add(TwigMiddleware::create($app, $twig));
} catch (Throwable $e) {
    echo $e->getMessage();
}

error_reporting(E_ALL ^ E_DEPRECATED);


$app->get(
    '/twig/{id}',
    function (Request $rq, Response $rs, array $args): Response {
        $view = Twig::fromRequest($rq);
        $id = $args['id'];
        $chars = $id;
        if (gettype($id) == 'string') {
            $id = strlen($id);
        }
        return $view->render($rs, 'test.html', [
            'id' => $id,
            'chars' => $chars,
            'users' => array("john", "alex", "jane", "joe")
        ]);
    }
);


$app->get(
    '/play',
    function (Request $rq, Response $rs): Response {
        $time = "60:00";

        if (isset($_SESSION['user_time'])) {
            $time = date_diff(new DateTime(), new DateTime(date('m/d/Y H:i:s', $_SESSION['user_time'])))->format('%i:%s');
        } else {
            $date = new DateTimeImmutable();
            $_SESSION['user_time'] = $date->getTimestamp();
            $_SESSION["currents_cars"] = array("A", "9", "22", "H", "B", "6");
        }

        $cards = array();
        foreach ($_SESSION["currents_cars"] as $key => $value) {
            if (Utils\CardResolver::exist($value)) {
                $cards[$key] = Utils\CardResolver::getCard($value)["image"];
            } else {
                unset($_SESSION["currents_cars"][$key]);
            }
        }

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'game.twig', [
            'cards' =>  $cards,
            'timer_start' => $time,
            'debug' => $_SESSION["currents_cars"]
        ]);
    }
)
;
$app->get('/play/display/{id}', function (Request $rq, Response $rs, array $args): Response {
    $id = strtoupper($args['id']);
    if (isset($_SESSION["currents_cars"])) {
        if (!in_array($id, $_SESSION["currents_cars"]) && Utils\CardResolver::exist($id)) {
            $_SESSION["currents_cars"][] = $id;
        }
    }

    $rs = $rs->withStatus(302);
    return $rs->withHeader('Location', '/play');
});

$app->get('/play/hide/{id}', function (Request $rq, Response $rs, array $args): Response {
    $id = strtoupper($args['id']);
    if (isset($_SESSION["currents_cars"])) {
        if (in_array($id, $_SESSION["currents_cars"])) {
            unset($_SESSION["currents_cars"][array_search($id, $_SESSION["currents_cars"])]);
        }
    }

    $rs = $rs->withStatus(302);
    return $rs->withHeader('Location', '/play');
});

$app->get(
    '/',
    function (Request $rq, Response $rs): Response {
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'index.html');
    }
);

try {
    $app->run();
} catch (Throwable $e) {
    echo $e->getMessage();
}
