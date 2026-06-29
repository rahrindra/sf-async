<?php

namespace App\Manager;

use App\Client\Contracts\UserClientInterface;
use App\DTO\User as UserDTO;
use App\Entity\User;

class UserManager
{
    public function __construct(
        protected readonly UserClientInterface $userClient,
    ) {
    }

    public function createUser(UserDTO $userDTO): void
    {
        $user = new User();

        $user->setEmail($userDTO->email);
        $user->setFirstName($userDTO->firstname);
        $user->setName($userDTO->name);


        $this->userClient->create($user);
    }
}
