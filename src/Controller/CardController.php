<?php
namespace Unlock\Controller;

use DateTime;
use DateTimeImmutable;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Unlock\Service\CardService;

class CardController
{
    private $view;
    private CardService $cardService;

    public function __construct(Twig $view, CardService $cardService)
    {
        $this->view = $view;
        $this->cardService = $cardService;
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws \Exception
     */
    public function show(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        $time = "60:00";

        if (isset($_SESSION['user_time'])) {
            $time = date_diff(new DateTime(), new DateTime(date('m/d/Y H:i:s', $_SESSION['user_time'])))->format('%i:%s');
        } else {
            $date = new DateTimeImmutable();
            $_SESSION['user_time'] = $date->getTimestamp();
            $_SESSION["currents_cars"] = array("P1");
        }

        $cards = array();
        foreach ($_SESSION["currents_cars"] as $key => $value) {
            if (\Unlock\Utils\CardResolver::exist($value)) {
                $cards[$key] = \Unlock\Utils\CardResolver::getCard($value)["image"];
            } else {
                unset($_SESSION["currents_cars"][$key]);
            }
        }
        return $this->view->render($response, 'game.twig', [
             'cards' =>  $cards,
             'timer_start' => $time
         ]);

    }
}
