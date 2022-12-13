<?php

namespace App\Entity;

use App\Repository\GymRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GymRepository::class)]
class Gym
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 1024, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'gyms')]
    private ?Plan $plan = null;

    #[ORM\OneToMany(mappedBy: 'gym', targetEntity: GymUser::class)]
    private Collection $gymUsers;

    public function __construct()
    {
        $this->gymUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPlan(): ?Plan
    {
        return $this->plan;
    }

    public function setPlan(?Plan $plan): self
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * @return Collection<int, GymUser>
     */
    public function getGymUsers(): Collection
    {
        return $this->gymUsers;
    }

    public function addGymUser(GymUser $gymUser): self
    {
        if (!$this->gymUsers->contains($gymUser)) {
            $this->gymUsers->add($gymUser);
            $gymUser->setGym($this);
        }

        return $this;
    }

    public function removeGymUser(GymUser $gymUser): self
    {
        if ($this->gymUsers->removeElement($gymUser)) {
            // set the owning side to null (unless already changed)
            if ($gymUser->getGym() === $this) {
                $gymUser->setGym(null);
            }
        }

        return $this;
    }
}
