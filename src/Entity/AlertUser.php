<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlertUserRepository")
 */
class AlertUser
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Activity", inversedBy="alertUSers")
     */
    private $idActivity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="alertUSers")
     */
    private $idUser;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PropertyAlert", mappedBy="alertUser")
     */
    private $propertyAlerts;

    public function __construct()
    {
        $this->propertyAlerts = new ArrayCollection();
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

    public function getIdActivity(): ?Activity
    {
        return $this->idActivity;
    }

    public function setIdActivity(?Activity $idActivity): self
    {
        $this->idActivity = $idActivity;

        return $this;
    }

    /**
     * @return User
     */
    public function getIdUser(): User
    {
        return $this->idUser;
    }


    /**
     * @param User|null $idUser
     * @return $this
     */
    public function setIdUser(User $idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * @return Collection|PropertyAlert[]
     */
    public function getPropertyAlerts(): Collection
    {
        return $this->propertyAlerts;
    }

    public function addPropertyAlert(PropertyAlert $propertyAlert): self
    {
        if (!$this->propertyAlerts->contains($propertyAlert)) {
            $this->propertyAlerts[] = $propertyAlert;
            $propertyAlert->setAlertUser($this);
        }

        return $this;
    }

    public function removePropertyAlert(PropertyAlert $propertyAlert): self
    {
        if ($this->propertyAlerts->contains($propertyAlert)) {
            $this->propertyAlerts->removeElement($propertyAlert);
            // set the owning side to null (unless already changed)
            if ($propertyAlert->getAlertUser() === $this) {
                $propertyAlert->setAlertUser(null);
            }
        }

        return $this;
    }
}
