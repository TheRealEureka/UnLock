<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;

class UserService
{
    private EntityManager $em;
    private LoggerInterface $logger;

    public function __construct(EntityManager $em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

}