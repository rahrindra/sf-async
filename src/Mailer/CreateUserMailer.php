<?php

namespace App\Mailer;

use App\Entity\EmailQueue;
use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
class CreateUserMailer
{
    public function __construct(
        private readonly MailerInterface $mailer,
    ) {}

    public function sendMail(EmailQueue $emailQueue): void
    {
        $email = (new TemplatedEmail())
            ->from('no-reply@monsite.fr')
            ->to($emailQueue->getRecipient())
            ->subject($emailQueue->getSubject())
            ->htmlTemplate($emailQueue->getTemplate())
            ->context([
                'user' => $emailQueue->getUser(),
            ]);;

        $this->mailer->send($email);
    }
}
