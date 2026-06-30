<?php

namespace App\Manager;

use App\Client\Contracts\UserClientInterface;
use App\DTO\User as UserDTO;
use App\Entity\User;
use App\Mailer\CreateUserMailer;

class UserManager
{
    public function __construct(
        protected readonly UserClientInterface $userClient,
        protected readonly CreateUserMailer $createUserMailer,
    ) {
    }

    public function createUser(UserDTO $userDTO): void
    {
        $user = new User();

        $user->setEmail($userDTO->email);
        $user->setFirstName($userDTO->firstname);
        $user->setName($userDTO->name);

//        dd($user);

        $this->userClient->create($user);

        $this->createUserMailer->sendMail($user);
    }
}
