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
    public function getBack(): array
    {
        $qb = $this->em->getRepository(\App\Domain\Card::class)->createQueryBuilder('c');
        $req=$qb->select("c.image_back")
            ->where($qb->expr()->isNotNull("c.image_back"))
           ->getQuery()->getResult();
        $this->logger->info("CardService::getBack()".print_r($req, true));

        return $req;
    }
}
