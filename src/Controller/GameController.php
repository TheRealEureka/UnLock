<?php
namespace App\Controller;

use App\Service\GameService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GameController
{
    private $view;
    private GameService $gameService;

    public function __construct(Twig $view, GameService $gameService)
    {
        $this->view = $view;
        $this->gameService = $gameService;
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function start(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        return $this->view->render($response, 'index.html');
    }
    public function win(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        if ($_SESSION["currents_cars"] == null && array_search("60", $_SESSION["currents_cars"])) {
            return $this->view->render($response, 'win.html');
        }
        $response = $response->withStatus(302);
        return $response->withHeader('Location', '/play');
    }
}
