<?php

namespace App\Service;

use App\Domain\Game;
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
        $req = $this->em->getRepository(\App\Domain\Game::class)->findBy(['id_user' => $id]);
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
            if ($game == null) {
                $game = new \App\Domain\Game($_SESSION["user_id"],json_encode( $_SESSION["currents_cards"]), $_SESSION["user_penality"], $_SESSION["user_time"]);
                $this->em->persist($game);

            } else {
                $game->setCurrentsCards(json_encode($_SESSION["currents_cards"]));
                $game->setUserPenality($_SESSION["user_penality"]);
                $game->setUserTime($_SESSION["user_time"]);
            }
            $this->logger->info("GameService::save()");

            $this->em->flush();
            return true;

        }
        return false;
    }
}
