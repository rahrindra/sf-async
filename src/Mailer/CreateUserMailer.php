<?php

namespace App\Mailer;

use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
class CreateUserMailer
{
    public function __construct(
        private readonly MailerInterface $mailer,
    ) {}

    public function sendMail(User $user)
    {
        $email = (new TemplatedEmail())
            ->from('no-reply@monsite.fr')
            ->to($user->getEmail())
            ->subject('Votre compte a été créé')
            ->htmlTemplate('emails/user_created.html.twig')
            ->context([
                'user' => $user,
            ]);;

        $this->mailer->send($email);
    }
}
