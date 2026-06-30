<?php

namespace App\Provider;

use App\Client\Contracts\EmailQueueClientInterface;
use App\Entity\EmailQueue;
use App\Enum\EmailStatus;

class EmailQueueProvider
{
    public function __construct(
        protected readonly EmailQueueClientInterface $emailQueueClient
    ) {
    }

    /**
     * @return list<EmailQueue>
     */
    public function getPendingEmailQueues(): array
    {
        $criteria = ['status' => EmailStatus::Pending];

        return $this->emailQueueClient->getEmailQueues($criteria);
    }
}
