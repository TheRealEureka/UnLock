<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
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

    public function login(string $username, string $password) : bool|int
    {
        $req = $this->em->getRepository(\App\Domain\User::class)->findBy(['username' => $username]);
        $this->logger->info("UserService::get($username)");
        if ($req == null) {
            $this->logger->info("UserService::get($username) : user not found");
            return false;
        } else {
            if ($req[0]->checkPassword($password)) {
                $this->logger->info("UserService::get($username) : user found");
                return $req[0]->getId();
            } else {
                $this->logger->info("UserService::get($username) : wrong password");
                return false;
            }
        }
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function signup(string $username, string $password, string $password_confirm): bool|int
    {
        if (strlen($username)>2 && ($password == $password_confirm) && strlen($password)>3) {
            $newUser = new \App\Domain\User($username, $password);
            $this->em->persist($newUser);
            $this->em->flush();
            $this->logger->info("UserService::signup($username)");
            return $newUser->getId();
        } else {
            $this->logger->info("UserService::signup($username) : error");
            return false;
        }
    }
}
