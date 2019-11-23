<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlertRepository")
 */
class Alert
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxPrice;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $postalCode;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="criteriaList")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Activity", inversedBy="Critere")
     */
    private $activity;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\BienHermes", inversedBy="alerts")
     */
    private $bien;

    public function __construct()
    {
        $this->bien = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(int $maxPrice): self
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

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

    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(?Activity $activity): self
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * @return Collection|BienHermes[]
     */
    public function getBien(): Collection
    {
        return $this->bien;
    }

    public function addBien(BienHermes $bien): self
    {
        if (!$this->bien->contains($bien)) {
            $this->bien[] = $bien;
        }

        return $this;
    }

    public function removeBien(BienHermes $bien): self
    {
        if ($this->bien->contains($bien)) {
            $this->bien->removeElement($bien);
        }

        return $this;
    }
}
