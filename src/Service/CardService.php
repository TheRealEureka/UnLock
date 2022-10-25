<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;

final class CardService
{
    private EntityManager $em;
    private LoggerInterface $logger;

    public function __construct(EntityManager $em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    public function get(string $id): array|null
    {
        $req = $this->em->getRepository(\App\Domain\Card::class)->findBy(['numCarte' => $id]);
        $this->logger->info("CardService::get($id)");

        return $req == null ? null : $req;
    }

    public function exist(string $id) : bool
    {
        $req = $this->em->getRepository(\App\Domain\Card::class)->findBy(['numCarte' => $id]);
        $this->logger->info("CardService::exist($id)");
        return !($req == null);
    }
    public function getUses($id) : array | null
    {
        $req = $this->em->getRepository(\App\Domain\Card::class)->findBy(['numCarte' => $id]);
        $this->logger->info("CardService::getUses($id)" . $req[0]->getUse());
        return $req[0]->getUse() == null ? null : json_decode($req[0]->getUse(), true);
    }
    public function getRequire($id) : array | null
    {
        $req = $this->em->getRepository(\App\Domain\Card::class)->findBy(['numCarte' => $id]);
        $this->logger->info("CardService::getUses($id)" . $req[0]->getRequire());
        return $req[0]->getRequire() == null ? null : json_decode($req[0]->getRequire(), true);
    }
    public function log($string)
    {
        $this->logger->info($string);
    }
}
