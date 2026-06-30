<?php

namespace App\Client\Contracts;

use App\Entity\EmailQueue;

interface EmailQueueClientInterface
{
    public function userCreated(EmailQueue $emailQueue): void;

    /**
     * @return array<EmailQueue>
     */
    public function getEmailQueues(array $criteria = []): array;
}
