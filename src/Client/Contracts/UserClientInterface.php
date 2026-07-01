<?php

namespace App\Client\Contracts;

use App\Entity\User;

interface UserClientInterface
{
    public function create(User $user): void;

    public function findById(int $id): ?User;
}
