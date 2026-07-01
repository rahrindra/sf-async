<?php

namespace App\Client\Contracts;

use App\Entity\EmailQueue;

interface EmailQueueClientInterface
{
    public function save(EmailQueue $emailQueue): void;

    public function userCreated(EmailQueue $emailQueue): void;

    /**
     * @return array<EmailQueue>
     */
    public function getEmailQueues(array $criteria = []): array;
}
