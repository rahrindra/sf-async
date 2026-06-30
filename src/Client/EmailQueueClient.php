<?php

namespace App\Client;

use App\Client\Contracts\EmailQueueClientInterface;
use App\Entity\EmailQueue;
use App\Repository\EmailQueueRepository;
use Doctrine\ORM\EntityManagerInterface;

class EmailQueueClient implements EmailQueueClientInterface
{
    public function __construct(
        protected readonly EntityManagerInterface $entityManager,
        protected readonly EmailQueueRepository $emailQueueRepository,
    ) {
    }

    public function userCreated(EmailQueue $emailQueue): void
    {
        $this->entityManager->persist($emailQueue);
        $this->entityManager->flush();
    }

    /**
     * @param array $criteria
     *
     * @return list<EmailQueue>
     */
    public function getEmailQueues(array $criteria = []): array
    {
        return $this->emailQueueRepository->findBy($criteria);
    }
}
