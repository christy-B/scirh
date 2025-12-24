<?php

namespace App\DTO\User;

use Symfony\Component\Validator\Constraints as Assert;

final class RegisterInputDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 100)]
    public string $firstname;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 100)]
    public string $lastname;

    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\Length(min: 8)]
    public string $password;

    #[Assert\Url]
    #[Assert\Length(max: 255)]
    public string $avatar;
}
