<?php
namespace App\Controller;


use Slim\Views\Twig;


class GameController
{
    private $view;
    private GameService $gameervice;

    public function __construct(Twig $view, GameService $gameervice)
    {
        $this->view = $view;
        $this->$gameervice = $gameervice;
    }


}
