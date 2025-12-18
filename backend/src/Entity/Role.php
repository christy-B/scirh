<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $role_attribut = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $role_description = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $role_created_at = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $role_updated_at = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'roles')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleAttribut(): ?string
    {
        return $this->role_attribut;
    }

    public function setRoleAttribut(string $role_attribut): static
    {
        $this->role_attribut = $role_attribut;

        return $this;
    }

    public function getRoleDescription(): ?string
    {
        return $this->role_description;
    }

    public function setRoleDescription(?string $role_description): static
    {
        $this->role_description = $role_description;

        return $this;
    }

    public function getRoleCreatedAt(): ?\DateTimeImmutable
    {
        return $this->role_created_at;
    }

    public function setRoleCreatedAt(\DateTimeImmutable $role_created_at): static
    {
        $this->role_created_at = $role_created_at;

        return $this;
    }

    public function getRoleUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->role_updated_at;
    }

    public function setRoleUpdatedAt(?\DateTimeImmutable $role_updated_at): static
    {
        $this->role_updated_at = $role_updated_at;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addRole($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeRole($this);
        }

        return $this;
    }
}
