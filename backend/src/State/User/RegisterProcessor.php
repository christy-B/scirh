<?php

namespace App\State\User;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\User;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\DTO\User\RegisterOutputDTO;

final class RegisterProcessor implements ProcessorInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $hasher,
        private RoleRepository $roleRepository
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): RegisterOutputDTO
    {
        /** @var RegisterInputDTO $data */

        $user = new User();
        $user->setUserFirstname($data->firstname);
        $user->setUserLastname($data->lastname);
        $user->setUserEmail($data->email);
        $user->setUserAvatar($data->avatar);
        $user->setUserIsActif(true);
        $user->setUserCreatedAt(new \DateTimeImmutable());

        // HASHAGE
        $hashedPassword = $this->hasher->hashPassword($user, $data->password);
        $user->setPassword($hashedPassword);

        // Récupérer le rôle ROLE_USER depuis la base de données
        $defaultRole = $this->roleRepository->findOneBy(['role_attribut' => 'ROLE_USER']);

        // Lier l'utilisateur au rôle ROLE_USER
        if ($defaultRole) {
            $user->addRole($defaultRole);
        }

    
        $this->em->persist($user);
        $this->em->flush();

        // Création du DTO de sortie
        $output = new RegisterOutputDTO();
        $output->id = $user->getId();
        $output->firstname = $user->getUserFirstname();
        $output->lastname  = $user->getUserLastname();
        $output->email = $user->getUserEmail();
        $output->avatar = $user->getUserAvatar();
        $output->roles = $user->getRoles();
        $output->createdAt = $user->getUserCreatedAt();

    return $output;
    }
}
