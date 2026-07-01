<?php

namespace App\Message;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage('async')]
class UserEmailNotification
{
    public function __construct(
        public string $userId
    ) {
    }

}
