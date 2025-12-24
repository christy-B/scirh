<?php

namespace App\ApiResource\User;

use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\ApiResource;
use App\DTO\User\RegisterInputDTO;
use App\DTO\User\RegisterOutputDTO;
use App\Entity\User;
use App\State\User\RegisterProcessor;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/auth/register',
            input: RegisterInputDTO::class,
            output: RegisterOutputDTO::class,
            processor: RegisterProcessor::class,
            security: "is_granted('PUBLIC_ACCESS')"
        )
    ]
)]
final class Register
{
}
