<?php

namespace App\Entity;

use App\Repository\GymUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GymUserRepository::class)]
class GymUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'gymUsers')]
    private ?Gym $gym = null;

    #[ORM\ManyToOne(inversedBy: 'gymUsers')]
    private ?User $user = null;

    #[ORM\Column]
    private ?bool $admin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGym(): ?Gym
    {
        return $this->gym;
    }

    public function setGym(?Gym $gym): self
    {
        $this->gym = $gym;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function isAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): self
    {
        $this->admin = $admin;

        return $this;
    }
}
