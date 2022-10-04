<?php

use Slim\Factory\AppFactory;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
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

$app->get('/twig/{id}',
    function (Request $rq, Response $rs, array $args) : Response {
       $view = Twig::fromRequest($rq);
       $id = $args['id'];
       if (gettype($id) == 'string') {
        $id = (int)$id;
       }
       return $view->render($rs, 'test.html', [
            'id' => $id,
            'users' => array("john", "alex", "jane", "joe")
        ]);
    });

$app->get('/',
    function (Request $rq, Response $rs): Response {
        $rs->getBody()->write("Je suis un grand travailleur ;)");
        return $rs;
});

try {
    $app->run();
} catch (Throwable $e) {
    echo $e->getMessage();
}