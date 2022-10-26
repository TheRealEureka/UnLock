<?php
namespace App\Controller;

use App\Service\GameService;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
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
        return $this->view->render($response, 'index.twig', [
            'conn' => isset($_SESSION['user_id']),
            'name' => $_SESSION["username"] ?? "",
            'error' => ""
        ]);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function win(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        if (!$_SESSION["currents_cards"] == null) {
            if (array_search("60", $_SESSION["currents_cards"])) {
                $this->clearGameData();
                return $this->view->render($response, 'victory.html');
            }
        }
        $response = $response->withStatus(302);
        return $response->withHeader('Location', '/play');
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function loose(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        $this->clearGameData();
        return $this->view->render($response, 'defeat.html');
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function save(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        $this->gameService->save();
        $response = $response->withStatus(302);
        return $response->withHeader('Location', '/play');
    }

    public function load(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        $this->gameService->load();
        $response = $response->withStatus(302);
        if($this->gameService->load()){
            return $response->withHeader('Location', '/play');
        }
        return $response->withHeader('Location', '/');

    }

    private function clearGameData(){
        unset($_SESSION["currents_cards"]);
        unset($_SESSION["user_time"]);
        unset($_SESSION["starting_timer"]);
        unset($_SESSION["user_penality"]);
    }

}
