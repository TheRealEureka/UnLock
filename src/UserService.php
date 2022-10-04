<?php

use Doctrine\ORM\EntityManager;

final class UserService
{
    private EntityManager $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function signUp(string $email): User
    {
        $newUser = new User($email);

        $this->em->persist($newUser);
        $this->em->flush();

        return $newUser;
    }
}