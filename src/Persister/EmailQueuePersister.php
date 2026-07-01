<?php

namespace App\Persister;

use App\Client\Contracts\EmailQueueClientInterface;
use App\Entity\EmailQueue;
use App\Entity\User;
use App\Enum\EmailStatus;
use App\Event\UserEvent;

class EmailQueuePersister
{
    public function __construct(
        protected readonly EmailQueueClientInterface $emailQueueClient
    ) {
    }

    public function userCreated(User $user): void
    {
        $emailQueue = new EmailQueue();
        $emailQueue->setRecipient($user->getEmail())
            ->setUser($user)
            ->setSubject('Votre compte a été créé')
            ->setTemplate('emails/user_created.html.twig')
            ->setEvent(UserEvent::USER_CREATED);
        ;

        $this->emailQueueClient->userCreated($emailQueue);
    }

    public function updateEmailQueueStatus(EmailQueue $emailQueue, EmailStatus $emailStatus): void
    {
        $emailQueue->setStatus($emailStatus);
        $this->emailQueueClient->save($emailQueue);
    }
}
