<?php

namespace App\Command;

use App\Event\UserEvent;
use App\Mailer\CreateUserMailer;
use App\Provider\EmailQueueProvider;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;


#[AsCommand(name: 'app:email-worker', description: 'Send emails in the queue')]
class EmailWorkerCommand extends Command
{
    public function __construct(
        private readonly EmailQueueProvider $emailQueueProvider,
        private readonly CreateUserMailer $createUserMailer,
    ) {
        parent::__construct();
    }

    public function __invoke(OutputInterface $output): int
    {
        $emailQueues = $this->emailQueueProvider->getPendingEmailQueues();

        foreach ($emailQueues as $emailQueue) {
            if ($emailQueue->getEvent() === USerEvent::USER_CREATED) {
                $this->createUserMailer->sendMail($emailQueue);
            }
        }

        $output->writeln('<info>Emails sent.</info>');

        return Command::SUCCESS;
    }
}
