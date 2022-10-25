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
}
