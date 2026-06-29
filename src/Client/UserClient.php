<?php

namespace App\Client;

use App\Client\Contracts\UserClientInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserClient implements UserClientInterface
{
    public function __construct(
        protected readonly EntityManagerInterface $entityManager
    ) {

    }

    public function create(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
