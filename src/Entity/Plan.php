<?php

namespace App\Entity;

use App\Repository\PlanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanRepository::class)]
class Plan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 1024)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $monthly_price = null;

    #[ORM\Column]
    private ?float $yearly_price = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\OneToMany(mappedBy: 'plan', targetEntity: Gym::class)]
    private Collection $gyms;

    public function __construct()
    {
        $this->gyms = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMonthlyPrice(): ?float
    {
        return $this->monthly_price;
    }

    public function setMonthlyPrice(float $monthly_price): self
    {
        $this->monthly_price = $monthly_price;

        return $this;
    }

    public function getYearlyPrice(): ?float
    {
        return $this->yearly_price;
    }

    public function setYearlyPrice(float $yearly_price): self
    {
        $this->yearly_price = $yearly_price;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection<int, Gym>
     */
    public function getGyms(): Collection
    {
        return $this->gyms;
    }

    public function addGym(Gym $gym): self
    {
        if (!$this->gyms->contains($gym)) {
            $this->gyms->add($gym);
            $gym->setPlan($this);
        }

        return $this;
    }

    public function removeGym(Gym $gym): self
    {
        if ($this->gyms->removeElement($gym)) {
            // set the owning side to null (unless already changed)
            if ($gym->getPlan() === $this) {
                $gym->setPlan(null);
            }
        }

        return $this;
    }
}
