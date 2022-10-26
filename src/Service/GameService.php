<?php

namespace App\Service;

use App\Domain\Game;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Psr\Log\LoggerInterface;

final class GameService
{
    private EntityManager $em;
    private LoggerInterface $logger;

    public function __construct(EntityManager $em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    public function getByUser(string $id): Game|null
    {
        $req = $this->em->getRepository(Game::class)->findBy(['id_user' => $id]);
        $this->logger->info("GameService::get($id)");
        return $req == null ? null : $req[0];
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function save() : bool
    {
        if (isset($_SESSION["user_id"]) && isset($_SESSION["currents_cards"]) && isset($_SESSION["user_time"]) && isset($_SESSION["user_penality"])) {
            $game = $this->getByUser($_SESSION["user_id"]);
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
            if ($game == null) {
                $game = new Game($_SESSION["user_id"],json_encode( $_SESSION["currents_cards"]), $_SESSION["user_penality"], json_encode($time));
                $this->em->persist($game);

            } else {


                $game->setCurrentsCards(json_encode($_SESSION["currents_cards"]));
                $game->setUserPenality($_SESSION["user_penality"]);
                $game->setStartingTimer(json_encode($time));
            }
            $this->logger->info("GameService::save()");

            $this->em->flush();
            return true;

        }
        return false;
    }
    public function load(){
        if (isset($_SESSION["user_id"])) {
            $game = $this->getByUser($_SESSION["user_id"]);
            if ($game !== null) {
                $_SESSION["user_penality"] = json_decode($game->getUserPenality(),true);
                $_SESSION["starting_timer"] = json_decode($game->getStartingTimer(),true);
                $_SESSION["currents_cards"] =json_decode( $game->getCurrentsCards(),true);
                unset($_SESSION["user_time"]);
                return true;
            }
        }
        return false;
    }
}
