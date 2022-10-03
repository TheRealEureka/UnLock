<?php

use Slim\Factory\AppFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Unlock\Utility\ConnectionFactory;

//Auto load
require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

ConnectionFactory::setConfig(__DIR__ . '/../conf.ini');


try {
    $twig = Twig::create('view/', ['cache' => false]);
    $app->add(TwigMiddleware::create($app, $twig));
} catch (Throwable $e) {
    echo $e->getMessage();
}


error_reporting(E_ALL ^ E_DEPRECATED);

$app->get('/twig/{id}',
    function (Request $rq, Response $rs, array $args) : Response {
       $view = Twig::fromRequest($rq);
       return $view->render($rs, 'test.html', [
            'id' => $args['id'],
            'users' => array("john", "alex", "jane", "joe")
        ]);
    });
$app->get('/sql',
    function (Request $rq, Response $rs): Response {
        $db = ConnectionFactory::makeConnection();
        $stmt = $db->query("SELECT * FROM test");
        $stmt->execute();
        $rs->getBody()->write(json_encode($stmt->fetchAll()));
        return $rs;
    });
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