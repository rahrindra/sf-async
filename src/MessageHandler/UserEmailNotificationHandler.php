<?php

namespace App\MessageHandler;

use App\Client\Contracts\UserClientInterface;
use App\Mailer\CreateUserMailer;
use App\Message\UserEmailNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class UserEmailNotificationHandler
{
    public function __construct(
        protected readonly UserClientInterface $userClient,
        protected readonly CreateUserMailer $createUserMailer,
    ){}

    public function __invoke(UserEmailNotification $message)
    {
        $userId = $message->userId;
        $user = $this->userClient->findById($userId);
        $this->createUserMailer->sendMail($user);
    }
}
