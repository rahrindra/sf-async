<?php

namespace App\Manager;

use App\Client\Contracts\UserClientInterface;
use App\DTO\User as UserDTO;
use App\Entity\User;
use App\Mailer\CreateUserMailer;
use App\Message\UserEmailNotification;
use Symfony\Component\Messenger\MessageBusInterface;

class UserManager
{
    public function __construct(
        protected readonly UserClientInterface $userClient,
        protected readonly CreateUserMailer $createUserMailer,
        protected readonly MessageBusInterface $bus,
    ) {
    }

    public function createUser(UserDTO $userDTO): void
    {
        $user = new User();

        $user->setEmail($userDTO->email);
        $user->setFirstName($userDTO->firstname);
        $user->setName($userDTO->name);

        $this->userClient->create($user);

        $this->bus->dispatch(new UserEmailNotification($user->getId()));
    }
}
