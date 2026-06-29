<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class User
{
    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;
    public ?string $firstname = null;

    #[Assert\NotBlank]
    public string $name;
}
