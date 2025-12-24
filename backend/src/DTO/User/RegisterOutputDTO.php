<?php

namespace App\DTO\User;


final class RegisterOutputDTO
{
    public int $id;
    public string $firstname;
    public string $lastname;
    public string $email;
    public array $roles;
    public string $avatar;
    public \DateTimeImmutable $createdAt;
}
