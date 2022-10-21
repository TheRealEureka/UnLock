<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");

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
//Pour acceder a request.html
$app->get('/test/post', function (Request $request, Response $response) {
    $view = Twig::fromRequest($request);
    return $view->render($response, 'request.html', []);
});

//Exemple de route de l'API qui retourne le tableau des POST
$app->post('/test/post', function (Request $request, Response $response) {
    $data = json_decode($request->getBody(), true);
    $response->getBody()->write(json_encode(array('status' => 'ok', 'data' => $data)));
    return $response;
});

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
        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'game.html');
    }
);
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
