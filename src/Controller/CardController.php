<?php
namespace App\Controller;

use DateTime;
use DateTimeImmutable;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use App\Service\CardService;

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
        $time = array(
            "minutes" => 60,
            "second" => 0
        );
        $back = $this->cardService->getBack();

        if (!isset($_SESSION['currents_cards'])) {
            $_SESSION["currents_cards"] = ["P1","15","24","55","H","6","R"];
        }
        if(!isset($_SESSION['user_time']))
        {
            $date = new DateTimeImmutable();
            $_SESSION['user_time'] = $date->getTimestamp();
        }
        if(!isset($_SESSION['user_penality']))
        {
            $_SESSION['user_penality'] = 0;
        }
        if(!isset($_SESSION['starting_timer']))
        {
            $_SESSION['starting_timer'] = $time;
        }


        $played = explode(":", date_diff(new DateTime(), new DateTime(date('m/d/Y H:i:s', $_SESSION['user_time'])))->format('%i:%s'));

        $played = array(
            "minutes" => $played[0],
            "second" => $played[1],
        );

        $time['minutes'] =  ($_SESSION['starting_timer']['minutes'] - $played['minutes']) - $_SESSION['user_penality']; ;

        $time['second'] =   $_SESSION['starting_timer']['second'] - $played['second'];
        if($time['second'] < 0 && $time['minutes'] > 0)
        {
            $time['minutes']--;
            $time['second'] = 60 + $time['second'];
        }



        $cards = array();
        foreach ($_SESSION["currents_cards"] as $key => $value) {
            $card = $this->cardService->get($value);
            if ($card != null && isset($card[0])) {
                $cards[$key] = $card[0];
            } else {
                unset($_SESSION["currents_cards"][$key]);
            }
        }

        return $this->view->render($response, 'game.twig', [
             'cards' =>  $cards,
             'cards_back' => $back,
             'timer' => $time,
            'disable' => isset($_SESSION["user_id"]) ? "" : "disabled"
         ]);
    }

    public function addCard(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        $id = strtoupper($request->getParsedBody()['id']);
        if (strlen($id) >3) {
            $to_add = "";
            switch ($id) {
                case '1247':
                    $to_add = "91";
                    break;
                case '4233':
                    $to_add = "60";
                    break;
                case '6815':
                    $response = $response->withStatus(302);
                    return $response->withHeader('Location', '/win');
            }
            if ($to_add != "") {
                $this->add($to_add);
            }
        } elseif (isset($_SESSION["currents_cards"])) {
            if (!in_array($id, $_SESSION["currents_cards"]) && $this->cardService->exist($id)) {
                $type = $this->cardService->getType($id);
                if ($type =="trap") {
                    $_SESSION["user_penality"] += 10;
                }
                $this->add($id);
            }
        }


        $response = $response->withStatus(302);
        return $response->withHeader('Location', '/play');
    }

    public function hideCard(ServerRequestInterface $request, ResponseInterface $response, array $args) : ResponseInterface
    {
        $id = strtoupper($args['id']);
        $this->splice($id);

        $response = $response->withStatus(302);
        return $response->withHeader('Location', '/play');
    }

    private function splice($id) : void
    {
        if (isset($_SESSION["currents_cards"])) {
            if (in_array($id, $_SESSION["currents_cards"])) {
                $index = array_search($id, $_SESSION["currents_cards"]);
                if ($index) {
                    unset($_SESSION["currents_cards"][$index]);
                }
            }
        }
    }
    private function add($id) : void
    {
        if ($this->checkRequirments($id)) {
            $_SESSION["currents_cards"][] = $id;
            $uses = $this->cardService->getUses($id);
            if ($uses !== null) {
                foreach ($uses as $use) {
                    $this->splice($use);
                }
            }
        }
    }
    private function checkRequirments($id): bool
    {
        $req = $this->cardService->getRequire($id);
        if ($req !== null) {
            foreach ($req as $r) {
                if (!in_array($r, $_SESSION["currents_cards"])) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }
}
