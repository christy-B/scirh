<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $user_firstname = null;

    #[ORM\Column(length: 100)]
    private ?string $user_lastname = null;

    #[ORM\Column(length: 100)]
    private ?string $user_email = null;

    #[ORM\Column(length: 255)]
    private ?string $user_avatar = null;

    #[ORM\Column(length: 255)]
    private ?string $user_password = null;

    #[ORM\Column]
    private ?bool $user_is_actif = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $user_created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $user_updated_at = null;

    /**
     * @var Collection<int, Role>
     */
    #[ORM\ManyToMany(targetEntity: Role::class, inversedBy: 'users')]
    private Collection $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserFirstname(): ?string
    {
        return $this->user_firstname;
    }

    public function setUserFirstname(string $user_firstname): static
    {
        $this->user_firstname = $user_firstname;

        return $this;
    }

    public function getUserLastname(): ?string
    {
        return $this->user_lastname;
    }

    public function setUserLastname(string $user_lastname): static
    {
        $this->user_lastname = $user_lastname;

        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->user_email;
    }
    public function getUserEmail(): ?string
    {
        return $this->user_email;
    }

    public function setUserEmail(string $user_email): static
    {
        $this->user_email = $user_email;

        return $this;
    }

    public function getUserAvatar(): ?string
    {
        return $this->user_avatar;
    }

    public function setUserAvatar(string $user_avatar): static
    {
        $this->user_avatar = $user_avatar;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->user_password;
    }

    public function setPassword(string $user_password): static
    {
        $this->user_password = $user_password;

        return $this;
    }

    public function eraseCredentials(): void {}


    public function isUserIsActif(): ?bool
    {
        return $this->user_is_actif;
    }

    public function setUserIsActif(bool $user_is_actif): static
    {
        $this->user_is_actif = $user_is_actif;

        return $this;
    }

    public function getUserCreatedAt(): ?\DateTimeImmutable
    {
        return $this->user_created_at;
    }

    public function setUserCreatedAt(\DateTimeImmutable $user_created_at): static
    {
        $this->user_created_at = $user_created_at;

        return $this;
    }

    public function getUserUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->user_updated_at;
    }

    public function setUserUpdatedAt(?\DateTimeImmutable $user_updated_at): static
    {
        $this->user_updated_at = $user_updated_at;

        return $this;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        $roles = []; 
        foreach ($this->roles as $role) {
            $roles[] = $role->getRoleAttribut();
        }


        return array_unique($roles);
    }

    public function addRole(Role $role): static
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
        }

        return $this;
    }

    public function removeRole(Role $role): static
    {
        $this->roles->removeElement($role);

        return $this;
    }
}
